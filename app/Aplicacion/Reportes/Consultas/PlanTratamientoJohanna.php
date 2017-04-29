<?php
namespace Siacme\Aplicacion\Reportes\Consultas;

use Siacme\Aplicacion\Reportes\ReporteJohanna;
use Siacme\Dominio\Expedientes\Diente;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Expedientes\Odontograma;
use Siacme\Dominio\Listas\IColeccion;

/**
 * Class PlanTratamientoJohanna
 *
 * @package Siacme\Aplicacion\Reportes\Consultas
 * @category Reporte
 * @author Gerardo Adrián Gómez Ruiz <gerardo.gomr@gmail.com>
 */
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

    /**
     * la lista de dientes
     *
     * @var array
     */
    private static $ordenRows = [
        [18, 0],
        [17, 0],
        [16, 0],
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
        [26, 0],
        [27, 0],
        [28, 0],
        [38, 0],
        [37, 0],
        [36, 0],
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
        [46, 0],
        [47, 0],
        [48, 0]
    ];

    /**
     * @var array
     */
    protected $dientes;

    /**
     * PlanTratamientoJohanna constructor.
     *
     * @param Odontograma $odontograma
     * @param Expediente $expediente
     */
    public function __construct(Odontograma $odontograma, Expediente $expediente)
    {
        $this->expediente  = $expediente;
        $this->odontograma = $odontograma;
        parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        foreach (static::$ordenRows as $row) {
            foreach ($row as $rowActual) {
                $this->dientes[] = new Diente($rowActual);
            }
        }
    }

    /**
     * generar Plan de Tratamiento en PDF
     *
     * @return void
     */
    public function generar()
    {
        // TODO: Implement generar() method.
        $this->SetTitle('Plan de tratamiento');
        $this->AddPage();
        $this->SetFont('helvetica', '', 12);
        $this->SetFillColor(178, 178, 178);
        $this->Cell(0, 10, 'Plan de tratamiento', 0, 1, '',1);
        $this->Ln(5);
        $this->Cell(0, 5, 'Yo, '. $this->odontograma->dirigidoA(), 0, 1);
        $this->Cell(0, 5, 'Legal o familiar del niño (a): '. $this->expediente->getPaciente()->nombreCompleto(), 0, 1);
        $this->Ln(5);
        $this->SetFont('helvetica', '', 10);
        $this->writeHTML('<style>#declaro { background: #cccccc; padding: 3px; margin: 3px; }</style><p id="declaro">DECLARO: Que la E. OP Johanna Joselyn Vázquez Hernández me ha explicado que necesito los siguientes tratamientos especificados en la historia clínica y su respectivo costo</p>');
        $this->Ln(5);
        $this->SetFont('helvetica', '', 8);

        $html = '
            <style>
            table {
                border-collapse: collapse;
            }

            table, td, th {
                border: 1px solid black;
                padding: 3px;
                text-align: center;
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
            $bgColorTemporal = '#2f4f4f';

            $odontogramaDiente = $this->odontograma->getOdontogramaDiente($row[0]);
            if (is_null($odontogramaDiente)) {
                $odontogramaDiente = $this->odontograma->getOdontogramaDiente($row[1]);

                if (is_null($odontogramaDiente)) {
                    if ($row[1] !== 0) {
                        $bgColorTemporal = '#CEEBE2';
                    }
                    $html .= '<tr>
                        <td bgcolor="#dcdcdc">&nbsp;</td>
                        <td bgcolor="' . $bgColorTemporal . '">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>';
                } else {
                    $html .= $this->dienteEncontrado($odontogramaDiente);
                }
            } else {
                $html .= $this->dienteEncontrado($odontogramaDiente);
            }
        }

        $otrosTratamientos = '';
        foreach ($this->odontograma->getOtrosTratamientos() as $otroTratamiento) {
            $otrosTratamientos .= $otroTratamiento->getOtroTratamiento()->getTratamiento() . '(' . $otroTratamiento->getOtroTratamiento()->costo() . ') - ';
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
            $bgColorTemporal        = '#2f4f4f';
            $numeroDienteTemporal   = $odontogramaDiente->getDiente()->getNumero();
        }

        if ($odontogramaDiente->getDiente()->esPermanente()) {
            $bgColorTemporal        = '#CEEBE2';
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