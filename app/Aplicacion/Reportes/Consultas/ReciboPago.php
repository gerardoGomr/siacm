<?php
namespace Siacme\Aplicacion\Reportes\Consultas;

use Siacme\Aplicacion\Reportes\ReporteConsultorio;
use Siacme\Dominio\Consultas\Consulta;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Aplicacion\Fecha;

/**
 * Class ReciboPago
 * @package Siacme\Aplicacion\Reportes\Consultas
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class ReciboPago extends ReporteConsultorio
{
    /**
     * @var Expediente
     */
    private $expediente;

    /**
     * @var Consulta
     */
    private $consulta;

    /**
     * ReciboPago constructor.
     * @param mixed $expediente
     * @param $consulta
     */
    public function __construct(Expediente $expediente, Consulta $consulta)
    {
        $this->expediente = $expediente;
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
        $this->SetTitle('Interconsulta');
        $this->AddPage();
        $this->SetFont('helvetica', '', 12);

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
                <td width="410">' . $this->expediente->getPaciente()->nombreCompleto() . '</td>
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
        </table>';

        $this->WriteHTML($html, true);

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
                <td colspan="2" bgcolor="#48BECE"><strong>DESGLOSE DE COBRO</strong></td>
            </tr>
            <tr>
                <td width="410" bgcolor="#48BECE"><strong>Descripción</strong></td>
                <td width="100" bgcolor="#48BECE"><strong>Monto</strong></td>
            </tr>
        ';

        foreach ($this->consulta->getCostos() as $costoConsulta) {
            $html .= '<tr>
                <td>' . $costoConsulta->getConcepto() . '</td>
                <td>' . $costoConsulta->costo() . '</td>
            </tr>
            ';
        }

        $html .= '<tr>
            <td align="right" bgcolor="#48BECE"><strong>Total:</strong></td>
            <td>' . $this->consulta->costoRealFormateado() . '</td>
        </tr>
        ';

        $html .= '</table>';
        $this->WriteHTML($html, true);

        $this->Ln(5);
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 5, 'OTROS COSTOS:', false, true);
        $this->SetFont('helvetica', '', 12);
        $html = '<p>' . $this->consulta->getOtrosCostos() . '</p>';
        $this->WriteHTML($html, true);

        if (strlen($this->consulta->getComentario())) {
            $this->Ln(4);
            $this->SetFont('helvetica', 'I', 8);
            $this->Cell(0, 4, $this->consulta->getComentario(), '');
        }

        $this->Output('Recibo de pago', 'I');
    }
}