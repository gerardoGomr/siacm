<?php
namespace Siacme\Aplicacion\Reportes\Expedientes\TratamientosOdontologia;

use DateTime;
use Siacme\Aplicacion\Fecha;
use Siacme\Aplicacion\Reportes\ReporteJohanna;
use Siacme\Dominio\Expedientes\TratamientoOdontologia;

/**
 * Class ReporteCobrosOtrosTratamientos
 *
 * @package Siacme\Aplicacion\Reportes\TratamientosOdontologia
 * @category Reporte
 * @author  Gerardo Adrián Gómez Ruiz <gerardo.gomr@gmail.com>
 */
class ReporteCobrosOtrosTratamientos extends ReporteJohanna
{
    /**
     * el tratamiento actual
     *
     * @var TratamientoOdontologia
     */
    private $tratamiento;

    /**
     * ReporteCobrosOtrosTratamientos Constructor
     *
     * @param TratamientoOdontologia $tratamiento
     */
    public function __construct(TratamientoOdontologia $tratamiento)
    {
        $this->tratamiento = $tratamiento;

        parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    }

    /**
     * genera el reporte
     *
     * @return void
     */
    public function generar()
    {
        $fecha = new DateTime;
        $this->SetTitle('Cobros de tratamientos de ortopedia / ortodoncia');
        $this->AddPage();
        $this->SetFont('dejavusans', '', 12);
        $this->Cell(0, 10, Fecha::convertir($fecha->format('Y-m-d')), 0, 1, 'R');
        $this->Ln(5);

        $html = '<p><strong>Nombre:</strong> ' . $this->tratamiento->getExpedienteEspecialidad()->getExpediente()->getPaciente()->nombreCompleto() . '</p>
                <p><strong>Edad:</strong> ' . $this->tratamiento->getExpedienteEspecialidad()->getExpediente()->getPaciente()->edadCompleta() . '</p>';
        $this->WriteHTML($html);
        $this->Ln(10);

        $this->SetFont('dejavusans', 'B', 12);
        $this->Cell(0, 10, 'Reporte de cobros de ortopedia / ortodoncia', 0, 1, 'C');
        $this->SetFont('dejavusans', '', 9);
        $this->Ln(5);
        $html = '
            <p><b>Tratamiento: </b>' . $this->tratamiento->descripcionTratamientos() . '</p>
            <p><b>Costo Total: </b>' . $this->tratamiento->costo() . '</p>
            <p><b>Adeudo:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $this->tratamiento->saldoFormateado() . '</p>
            <br><br><br><br>';
        $this->WriteHTML($html);

        $html = '<style>
                table {
                    border-collapse: collapse;
                }

                table, td, th {
                    border: 1px solid black;
                    padding: 2px;
                    text-align: center;
                }

                table th {
                    font-weight: bold;
                }
            </style>
            <table>
                <thead>
                    <tr style="text-align: center">
                        <th bgcolor="gray" color="white" width="160">Fecha de pago</th>
                        <th bgcolor="gray" color="white" width="130">Forma de pago</th>
                        <th bgcolor="gray" color="white" width="70">Abono</th>
                        <th bgcolor="gray" color="white" width="70">Pago</th>
                        <th bgcolor="gray" color="white" width="70">Cambio</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($this->tratamiento->getPagos() as $pago) {
            $html .= '<tr>
                <td width="160">' . Fecha::convertir($pago->getFechaPago()->format('Y-m-d')) . '</td>
                <td width="130">' . $pago->formaPago() . '</td>
                <td width="70">$' . number_format($pago->getAbono(), 2) . '</td>
                <td width="70">$' . number_format($pago->getPago(), 2) . '</td>
                <td width="70">$' . number_format($pago->getCambio(), 2) . '</td>
                </tr>';
        }

        $html .= '</tbody></table>';
        $this->setListIndentWidth(2);
        $this->writeHTML($html, true, 0, true, 0);
        $this->Output('Tratamiento de odontología', 'I');
    }
}