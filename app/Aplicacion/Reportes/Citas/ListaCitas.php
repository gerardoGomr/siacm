<?php
namespace Siacme\Aplicacion\Reportes\Citas;

use Siacme\Aplicacion\Fecha;
use Siacme\Aplicacion\Reportes\ReporteJohanna;

/**
 * Class ListaCitas
 * @package Siacme\Reportes\Citas
 * @author  Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class ListaCitas extends ReporteJohanna
{
    /**
     * @var array
     */
    private $citas;

    /**
     * @var string
     */
    private $fecha;

    /**
     * @var string
     */
    private $html;

    /**
     * ListaCitas constructor.
     * @param array $citas
     * @param string $fecha
     */
    public function __construct($citas, $fecha)
    {
        $this->citas = $citas;
        $this->fecha = $fecha;
        parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    }

    /**
     * generar el reporte
     * @return string
     */
    public function generar()
    {
        // TODO: Implement generar() method.
        $this->SetTitle('Lista de Citas');
        $this->AddPage();
        $this->Ln(30);
        $this->SetFont('dejavusans', 'B', 12);
        $this->SetTextColor(72, 190, 206);
        $this->Cell(0, 10, 'REPORTE DE PACIENTES CITADOS.- ' . strtoupper(Fecha::convertir($this->fecha)), 0, true);
        $this->SetTextColor(0);
        $this->Ln(5);
        $this->SetFont('dejavusans', '', 12);
        $this->generaTabla();
        $this->writeHTML($this->html, true, false, false);
        $this->Output('Lista de Citas', 'I');
    }

    /**
     * construye la tabla a desplegar
     * @return void
     */
    private function generaTabla()
    {
        $this->html = '
            <table border="1" style="margin: 5px;"  cellpadding="5">
                <thead>
                    <tr bgcolor="#48BECE" style="color:#ffffff" align="center">
                        <th><strong>Horario</strong></th>
                        <th><strong>Paciente</strong></th>
                        <th><strong>Edad</strong></th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($this->citas as $cita) {
            $this->html .= '
                <tr>
                    <td>' . $cita->getHora() . '</td>
                    <td>' . $cita->getPaciente()->nombreCompleto() . '</td>
                    <td>' . $cita->getPaciente()->edadCompleta() . '</td>
                </tr>';
        }

        $this->html .= '</tbody></table>';
    }
}