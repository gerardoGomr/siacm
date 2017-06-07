<?php
namespace Siacme\Aplicacion\Reportes\Consultas;

use Siacme\Aplicacion\Reportes\ReporteConsultorio;
use Siacme\Aplicacion\Reportes\ReporteJohanna;
use Siacme\Dominio\Consultas\Consulta;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Aplicacion\Fecha;

/**
 * Class ReciboPago
 * @package Siacme\Aplicacion\Reportes\Consultas
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class ReciboPago extends ReporteJohanna
{
    /**
     * @var Consulta
     */
    private $consulta;

    /**
     * ReciboPago constructor.
     * @param mixed $expediente
     * @param $consulta
     */
    public function __construct(Consulta $consulta)
    {
        $this->consulta   = $consulta;
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
                <td width="410">' . $this->consulta->getExpediente()->getPaciente()->nombreCompleto() . '</td>
            </tr>
            <tr>
                <td><strong>Fecha:</strong></td>
                <td>' . Fecha::convertir($this->consulta->getFecha()) . '</td>
            </tr>
            <tr>
                <td><strong>Monto a pagar:</strong></td>
                <td color="#ff0000"><b>' . $this->consulta->costoFormateado() . '</b></td>
            </tr>
            <tr>
                <td><strong>Forma de pago:</strong></td>
                <td>' . $this->consulta->getCobroConsulta()->formaPago() . '</td>
            </tr>
            <tr>
                <td><strong>Pago:</strong></td>
                <td>$' . number_format($this->consulta->getCobroConsulta()->getPago(), 2) . '</td>
            </tr>
            <tr>
                <td><strong>Cambio:</strong></td>
                <td>$' . number_format($this->consulta->getCobroConsulta()->getCambio(), 2) . '</td>
            </tr>
            <tr>
                <td><strong>Fecha de pago:</strong></td>
                <td>' . Fecha::convertir($this->consulta->getCobroConsulta()->getFechaPago()->format('Y-m-d')) . '</td>
            </tr>
        </table>';

        $this->WriteHTML($html, true);

        if (strlen($this->consulta->getComentario())) {
            $this->Ln(4);
            $this->SetFont('dejavusans', 'I', 8);
            $this->Cell(0, 4, $this->consulta->getComentario(), '');
        }

        $this->Output('Recibo de pago', 'I');
    }
}