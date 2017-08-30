<?php
namespace Siacme\Aplicacion\Reportes\Consultas;

use Siacme\Aplicacion\Fecha;
use Siacme\Aplicacion\Reportes\ReporteConsultorio;
use Siacme\Aplicacion\Reportes\ReporteJohanna;
use Siacme\Dominio\Consultas\CobroConsulta;
use Siacme\Dominio\Expedientes\Expediente;

/**
 * Class ReciboPago
 * 
 * @package Siacme\Aplicacion\Reportes\Consultas
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class ReciboPago extends ReporteJohanna
{
    /**
     * @var CobroConsulta
     */
    private $cobroConsulta;

    /**
     * ReciboPago constructor.
     * 
     * @param CobroConsulta $cobroConsulta
     */
    public function __construct(CobroConsulta $cobroConsulta)
    {
        $this->cobroConsulta   = $cobroConsulta;
        parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    }

    /**
     * generar el reporte
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
                <td colspan="2" bgcolor="#48BECE"><strong>DATOS DE CONSULTA</strong></td>
            </tr>
            <tr>
                <td width="100"><strong>Paciente:</strong></td>
                <td width="410">' . $this->cobroConsulta->getConsulta()->getExpediente()->getPaciente()->nombreCompleto() . '</td>
            </tr>
            <tr>
                <td><strong>Fecha de pago:</strong></td>
                <td>' . Fecha::convertir($this->cobroConsulta->getFechaPago()->format('Y-m-d')) . '</td>
            </tr>
            <tr>
                <td><strong>Abono:</strong></td>
                <td color="#ff0000"><b>$' . number_format($this->cobroConsulta->getAbono(), 2) . '</b></td>
            </tr>
            <tr>
                <td><strong>Forma de pago:</strong></td>
                <td>' . $this->cobroConsulta->formaPago() . '</td>
            </tr>
            <tr>
                <td><strong>Pago:</strong></td>
                <td>$' . number_format($this->cobroConsulta->getPago(), 2) . '</td>
            </tr>
            <tr>
                <td><strong>Cambio:</strong></td>
                <td>$' . number_format($this->cobroConsulta->getCambio(), 2) . '</td>
            </tr>
            <tr>
                <td><strong>Saldo:</strong></td>
                <td>$' . number_format($this->cobroConsulta->getConsulta()->obtenerSaldo(), 2) . '</td>
            </tr>
        </table>';

        $this->WriteHTML($html, true);

        $this->Output('Recibo de pago', 'I');
    }
}