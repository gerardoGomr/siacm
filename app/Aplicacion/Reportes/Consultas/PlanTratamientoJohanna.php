<?php
namespace Siacme\Aplicacion\Reportes\Consultas;

use Siacme\Aplicacion\Reportes\ReporteJohanna;
use Siacme\Dominio\Expedientes\Diente;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Expedientes\Odontograma;
use Siacme\Dominio\Listas\IColeccion;

class PlanTratamientoJohanna extends ReporteJohanna
{
    /**
     * @var Expediente
     */
    private $expediente;

    /**
     * @var Odontograma
     */
    private $odontograma;

    private static $ordenRows = [
        [18],
        [17],
        [16],
        [15, 55],
        [14, 54],
        [13, 53],
        [12, 52],
        [11, 51],
        [21, 61],
        [22, 62],
        [23, 63],
        [24, 64],
        [25, 65],
        [26],
        [27],
        [28],
        [38],
        [37],
        [36],
        [35, 75],
        [34, 74],
        [33, 73],
        [32, 72],
        [31, 71],
        [41, 81],
        [42, 82],
        [43, 83],
        [44, 84],
        [45, 85],
        [46],
        [47],
        [48]
    ];

    /**
     * PlanTratamientoJohanna constructor.
     * @param Odontograma $odontograma
     * @param Expediente $expediente
     */
    public function __construct(Odontograma $odontograma, Expediente $expediente)
    {
        $this->expediente  = $expediente;
        $this->odontograma = $odontograma;
        parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    }

    /**
     * generar Plan de Tratamiento en PDF
     */
    public function generar()
    {
        // TODO: Implement generar() method.
        $this->SetTitle('Plan de tratamiento');
        $this->AddPage();
        //$this->Ln(30);
        $this->SetFont('helvetica', '', 12);
        $this->SetFillColor(178, 178, 178);
        $this->Cell(0, 10, 'Plan de tratamiento', 0, 1, '',1);
        $this->Ln(5);
        $this->Cell(0, 5, 'Yo, '. $this->odontograma->dirigidoA(), 0, 1);
        $this->Cell(0, 5, 'Legal o familiar del niño (a): '. $this->expediente->getPaciente()->nombreCompleto(), 0, 1);
        $this->Ln(5);
        $this->SetFillColor(206, 235, 226);
        $this->SetFont('helvetica', '', 10);
        $this->MultiCell(0, 10, ('DECLARO: Que la E. OP Johanna Joselyn Vázquez Hernández me ha explicado que necesito los siguientes tratamientos especificados en la historia clínica y su respectivo costo'), 'L', 0, 1, 1);
        $this->Ln(5);
        $this->SetFont('helvetica', '', 8);

        $otrosTratamientos = '';
        foreach ($this->odontograma->getOtrosTratamientos() as $otroTratamiento) {
            $otrosTratamientos .= $otroTratamiento->getOtroTratamiento()->getTratamiento() . '(' . $otroTratamiento->getOtroTratamiento()->costo() . ') - ';
        }

        $html = '
            <style>
            table {
                border-collapse: collapse;
            }

            table, td, th {
                border: 1px solid black;
                padding: 3px;
            }
            </style>
            <table>
                <thead>
                    <tr style="text-align: center">
                        <th bgcolor="gray" color="white">Región permanente</th>
                        <th bgcolor="gray" color="white">Región temporal</th>
                        <th bgcolor="gray" color="white">Diagnóstico</th>
                        <th bgcolor="gray" color="white">Tratamientos</th>
                        <th bgcolor="gray" color="white">Costo</th>
                    </tr>
                </thead>
                <tbody>';

        // primer renglón superior vacío
        $html .= '<tr>
            <td bgcolor="#dcdcdc">&nbsp;</td>
            <td bgcolor="#2f4f4f">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>';

        foreach (static::$ordenRows as $row) {
            foreach ($row as $rowActual) {
                $odontogramaDiente = $this->odontograma->getOdontogramaDiente($rowActual);

                if (!is_null($odontogramaDiente)) {
                    break;
                }
            }

            if (is_null($odontogramaDiente)) {
                $html .= '<tr>
                    <td bgcolor="#dcdcdc">&nbsp;</td>
                    <td bgcolor="#CEEBE2">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>';
            } else {
                $html .= $this->dienteEncontrado($odontogramaDiente);
            }
        }

        $html .= '</tbody></table><br><br><p style="font-size: 13pt;"><strong>Otros:</strong> <em>' . $otrosTratamientos . '</em></p>';

        $this->writeHTML($html, true, 0, true, 0);

        $this->Output('Plan de tratamiento', 'I');
    }

    /**
     * dibujar dientes encontrados
     *
     * @param $odontogramaDiente
     * @return string
     */
    private function dienteEncontrado($odontogramaDiente)
    {
        $html                   = '';
        $bgColorTemporal        = '';
        $numeroDienteTemporal   = '';
        $numeroDientePermanente = '';

        if ($odontogramaDiente->getDiente()->esTemporal()) {
            $bgColorTemporal        = '#CEEBE2';
            $numeroDienteTemporal   = $odontogramaDiente->getDiente()->getNumero();
        }

        if ($odontogramaDiente->getDiente()->esPermanente()) {
            $bgColorTemporal        = '#2f4f4f';
            $numeroDientePermanente = $odontogramaDiente->getDiente()->getNumero();
        }

        $html .= '
                <tr>
                    <td bgcolor="#dcdcdc">' . $numeroDientePermanente . '</td>
                    <td bgcolor="' . $bgColorTemporal . '">' . $numeroDienteTemporal . '</td>
                    <td>' . $this->dibujarPadecimientos($odontogramaDiente->getPadecimientos()) . '</td>
                    <td>' . $this->dibujarTratamientos($odontogramaDiente->getTratamientos()) . '</td>
                    <td>' . $this->dibujarCostosTratamientos($odontogramaDiente->getTratamientos()) . '</td>
                </tr>
            ';

        return $html;
    }
    /**
     * dibujar padecimientos
     *
     * @param IColeccion $padecimientos
     * @return string
     */
    private function dibujarPadecimientos($padecimientos)
    {
        $html     = '<ul>';

        foreach ($padecimientos as $padecimiento) {
            $html .= '<li>' . $padecimiento->getNombre() . '</li>';
        }

        $html .= '</ul>';

        return $html;
    }

    /**
     * presenta los tratamientos por diente
     *
     * @param IColeccion $tratamientos
     * @return string
     */
    private function dibujarTratamientos($tratamientos = null)
    {
        if ($tratamientos->count() === 0) {
            return '';
        }

        $html = '<ul>';

        foreach ($tratamientos as $dientePlan) {
            $html .= '<li>' . $dientePlan->getDienteTratamiento()->getTratamiento() . '</li>';
        }

        $html .= '</ul>';

        return $html;
    }

    /**
     * presenta los costos de los tratamientos
     *
     * @param IColeccion $tratamientos
     * @return string
     */
    private function dibujarCostosTratamientos($tratamientos = null)
    {
        if ($tratamientos->count() === 0) {
            return '';
        }

        $html = '<ul>';

        foreach ($tratamientos as $dientePlan) {
            $html .= '<li>$' . (string) number_format($dientePlan->getDienteTratamiento()->getCosto(), 2) . '</li>';
        }

        $html .= '</ul>';

        return $html;
    }
}