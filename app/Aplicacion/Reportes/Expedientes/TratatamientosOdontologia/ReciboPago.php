<?php
namespace Siacme\Aplicacion\Reportes\Expedientes\TratamientosOdontologia;

use Siacme\Aplicacion\Fecha;
use Siacme\Aplicacion\Reportes\ReporteConsultorio;
use Siacme\Aplicacion\Reportes\ReporteJohanna;
use Siacme\Dominio\Cobros\CobroTratamientoOdontologia;
use Siacme\Dominio\Expedientes\TratamientoOdontologia;

/**
 * Class ReciboPago
 *
 * @package Siacme\Aplicacion\Reportes\Expedientes\TratamientosOdontologia
 * @category Report
 * @author Gerardo Adrián Gómez Ruiz
 */
class ReciboPago extends ReporteJohanna
{
    /**
     * @var CobroTratamientoOdontologia
     */
    private $cobroTratamientoOdontologia;

    /**
     * ReciboPago constructor.
     *
     * @param CobroTratamientoOdontologia $cobroTratamientoOdontologia
     */
    public function __construct(CobroTratamientoOdontologia $cobroTratamientoOdontologia)
    {
        $this->cobroTratamientoOdontologia   = $cobroTratamientoOdontologia;
        parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    }

    /**
     * generar el reporte
     *
     * @return string
     */
    public function generar()
    {
        // TODO: Implement generar() method.
        $this->SetTitle('Recibo de pago');
        $this->AddPage();
        $this->SetFont('dejavusans', '', 12);

        $html = '
        <style>
            table {
                border-collapse: collapse;
            }

            table, td, th {
                padding: 3px;
            }
        </style>
        <table>
            <tr>
                <td colspan="2" bgcolor="#48BECE"><strong>ABONO A TRATAMIENTO DE ORTOPEDIA / ORTODONCIA</strong></td>
            </tr>
            <tr>
                <td width="100"><strong>Paciente:</strong></td>
                <td width="410">' . $this->cobroTratamientoOdontologia->getTratamientoOdontologia()->getExpedienteEspecialidad()->getExpediente()->getPaciente()->nombreCompleto() . '</td>
            </tr>
            <tr>
                <td><strong>Forma de pago:</strong></td>
                <td>' . $this->cobroTratamientoOdontologia->formaPago() . '</td>
            </tr>
            <tr>
                <td><strong>Abono:</strong></td>
                <td>$' . number_format($this->cobroTratamientoOdontologia->getAbono(), 2) . '</td>
            </tr>
            <tr>
                <td><strong>Pago:</strong></td>
                <td>$' . number_format($this->cobroTratamientoOdontologia->getPago(), 2) . '</td>
            </tr>
            <tr>
                <td><strong>Cambio:</strong></td>
                <td>$' . number_format($this->cobroTratamientoOdontologia->getCambio(), 2) . '</td>
            </tr>
            <tr>
                <td><strong>Fecha de pago:</strong></td>
                <td>' . Fecha::convertir($this->cobroTratamientoOdontologia->getFechaPago()->format('Y-m-d')) . '</td>
            </tr>
        </table>';

        $this->WriteHTML($html, true);

        $this->Output('Recibo de pago', 'I');
    }
}