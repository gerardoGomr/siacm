<?php
namespace Siacme\Aplicacion\Reportes;

use DateTime;
use Siacme\Aplicacion\Fecha;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\PlanCirugia as PCirugia;

/**
 * Class PlanCirugia
 *
 * @package Siacme\Aplicacion\Reportes
 * @category Reporte
 * @author Gerardo Gómez <gerardo.gomr@gmail.com>
 */
class PlanCirugia extends ReporteJohanna
{
    /**
     * @var Expediente
     */
    private $expediente;

    private $planCirugia;

    /**
     * HigieneDentalJohanna constructor.
     *
     * @param Expediente $expediente
     * @param PCirugia $planCirugia
     */
    public function __construct(Expediente $expediente, PCirugia $planCirugia)
    {
        $this->expediente  = $expediente;
        $this->planCirugia = $planCirugia;

        parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    }

    /**
     * Generar el contenido del formato
     *
     * @return void
     */
    public function generar()
    {
        $fecha = (new DateTime())->format('Y-m-d');
        
        $this->SetTitle('Indicaciones');
        $this->AddPage();
        $this->SetFont('dejavusans', '', 9);
        $this->Cell(0, 10, Fecha::convertir($fecha), 0, 1, 'R');
        $this->Ln(5);

        $html = '<style>
                    table {
                        border-collapse: collapse;
                    }
                    table, td {
                        border: 1px solid #aaa;
                        padding: 5px;
                    }
                </style>

                <p><strong>Nombre:</strong> ' . $this->expediente->getPaciente()->nombreCompleto() . '</p>
                <p><strong>Edad:</strong> ' . $this->expediente->getPaciente()->edadCompleta() . '</p>
                <p><strong>Cirugía:</strong> ' . $this->expediente->getPaciente()->edadCompleta() . '</p>
                <br>
                <p>Cotización otorgada al paciente</p>
                <br>
                <table>
                    <tr>
                        <td><b>HONORARIOS MÉDICOS</b></td>
                        <td>$</td>
                        <td><b>EQUIPO ADICIONAL</b></td>
                        <td>$</td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>EQUIPO MÉDICO</b></td>
                        <td><b>DESCRIPCIÓN DEL EQUIPO</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Cirujano Otorrinolaringólogo/Otoneurólogo</td>
                        <td>Dr. Rigoberto García</td>
                        <td>$</td>
                    </tr>
                    <tr>
                        <td colspan="2">Cirujano 1er Ayudante</td>
                        <td></td>
                        <td>$</td>
                    </tr>
                    <tr>
                        <td colspan="2">Anestesiólogo</td>
                        <td></td>
                        <td>$</td>
                    </tr>
                    <tr>
                        <td colspan="2">Instrumentista</td>
                        <td></td>
                        <td>$</td>
                    </tr>
                    <tr>
                        <td colspan="2">Otros</td>
                        <td></td>
                        <td>$</td>
                    </tr>
                </table>
                <p>El presupuesto no incluye gastos de hospitalización.</p>
                <p>Anexo un aproximado de los gastos requeridos de hospitalización que usted pagará directamente al hospital.</p>
                <p>Gastos de quirófano, habitación con clima, sala de quirófano, medicamento, suero, gasas, etc.</p>
                <br>
                <p>Hospital Sugerido:</p>
                <br>
                <p>Días aproximados de hospitalización:</p>
                <br>
                <p>Monto aproximado:</p>
                <br>
                <br>
                <p><b>Términos y condiciones</b></p>
                <p>Esta cotización tiene una validez de 2 meses.</p>';

        $this->WriteHTML($html, true);

        $this->Output('Indicación', 'I');
    }
}