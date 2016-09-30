<?php
namespace Siacme\Aplicacion\Reportes\Consultas;

use Siacme\Aplicacion\Reportes\ReporteJohanna;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Expedientes\PlanTratamiento;
use Siacme\Dominio\Listas\IColeccion;

class PlanTratamientoJohanna extends ReporteJohanna
{
    /**
     * @var Expediente
     */
    private $expediente;

    /**
     * @var PlanTratamiento
     */
    private $plan;

    public function __construct($plan, $expediente)
    {
        $this->expediente = $expediente;
        $this->plan       = $plan;
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
        $this->Cell(0, 5, 'Legal o familiar del niño (a): '. $this->expediente->getPaciente()->nombreCompleto(), 0, 1);
        $this->Ln(5);
        $this->MultiCell(0, 5, ('DECLARO: Que la E. OP Johanna Joselyn Vázquez Hernández me ha explicado que necesito los siguientes tratamientos especificados en la historia clínica y su respectivo costo'), 'L', 0, 1, 1);
        $this->Ln(5);
        $this->SetFont('helvetica', '', 8);

        $otrosTratamientos = '';
        foreach ($this->plan->getOtrosTratamientos() as $otroTratamiento) {
            $otrosTratamientos .= $otroTratamiento->getTratamiento() . ' ($' . (string)number_format($otroTratamiento->getCosto(), 2) . ') - ';
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
            <p style="font-size: 13pt;"><strong>Costo total:</strong> <span style="color: #ff0000">$ '.(string) number_format($this->plan->costo(), 2).'</span></p>
            <p style="font-size: 13pt;"><strong>Otros:</strong> <em>' . $otrosTratamientos . '</em></p>
            <table>
                <thead>
                    <tr style="text-align: center">
                        <th bgcolor="gray" color="white">Diente</th>
                        <th bgcolor="gray" color="white">Padecimiento</th>
                        <th bgcolor="gray" color="white">Tratamientos</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($this->plan->getDientes() as $diente) {

            $html .= '
                <tr>
                    <td>' . $diente->getNumero() . '</td>
                    <td>' . $this->dibujarPadecimientos($diente->getPadecimientos()) . '</td>
                    <td>' . $this->dibujarCostosTratamientos($diente->getTratamientos()) . '</td>
                </tr>
            ';
        }

        $html .= '</tbody></table>';

        $this->writeHTML($html, true, 0, true, 0);

        $this->Output('Plan de tratamiento', 'I');
    }

    /**
     * dibujar padecimientos
     * @param IColeccion $padecimientos
     * @return string
     */
    private function dibujarPadecimientos(IColeccion $padecimientos)
    {
        $html     = '<ul>';

        foreach ($padecimientos as $padecimiento) {
            $html .= '<li>' . $padecimiento->getNombre() . '</li>';
        }

        $html .= '</ul>';

        return $html;
    }

    /**
     * presenta los costos de los tratamientos
     * @param IColeccion $tratamientos
     * @return string
     */
    private function dibujarCostosTratamientos(IColeccion $tratamientos = null)
    {
        if ($tratamientos->count() === 0) {
            return '';
        }

        $html = '<ul>';

        foreach ($tratamientos as $dientePlan) {
            $html .= '<li>' . $dientePlan->getDienteTratamiento()->getTratamiento() . '-- $' . (string) number_format($dientePlan->getDienteTratamiento()->getCosto(), 2) . '</li>';
        }

        $html .= '</ul>';

        return $html;
    }
}