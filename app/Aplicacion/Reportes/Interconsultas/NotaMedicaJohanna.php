<?php
namespace Siacme\Aplicacion\Reportes\Interconsultas;

use Siacme\Aplicacion\Fecha;
use Siacme\Aplicacion\Reportes\ReporteJohanna;
use Siacme\Dominio\Consultas\Consulta;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Usuarios\Usuario;

/**
 * Class NotaMedicaJohanna
 * 
 * @package Siacme\Aplicacion\Reportes\Consultas
 * @category Reporte
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class NotaMedicaJohanna extends ReporteJohanna
{
    /**
     * @var Consulta
     */
    private $consulta;

    /**
     * @var Expediente
     */
    private $expediente;

    /**
     * NotaMedicaJohanna constructor
     * 
     * @param Consulta $consulta
     * @param Expediente $expediente
     */
    public function __construct(Consulta $consulta, Expediente $expediente)
    {
        $this->consulta   = $consulta;
        $this->expediente = $expediente;
        parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    }

    /**
     * genera la nota médica
     * 
     * @return void
     */
    public function generar()
    {
        // TODO: Implement generar() method.
        $this->SetTitle('Nota médica');
        $this->AddPage();
        $this->SetFont('dejavusans', '', 12);
        $this->Cell(0, 10, Fecha::convertir($this->consulta->getFecha()), 0, 1, 'R');
        $this->Ln(5);
        $html = <<<EOD
            <style>
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                table, tr, td {
                    padding: 5px;
                }
            </style>
            <table>
            <tbody>
            <tr>
                <td width="130"><b>Nombre:</b></td>
                <td colspan="3">{$this->expediente->getPaciente()->nombreCompleto()}</td>
            </tr>
            <tr>
                <td><b>Edad:</b></td>
                <td colspan="3">{$this->expediente->getPaciente()->edadCompleta()}</td>
            </tr>
            <tr>
                <td><b>Padecimiento actual:</b></td>
                <td colspan="3">{$this->consulta->getPadecimientoActual()}</td>
            </tr>
            <tr>
                <td><b>Exploracion Física:</b></td>
                <td colspan="3">
                    <table>
                        <tr>
                            <td width="70"><b>Peso:</b></td>
                            <td>{$this->consulta->getExploracionFisica()->getPeso()} kg</td>
                            <td width="70"><b>Talla:</b></td>
                            <td>{$this->consulta->getExploracionFisica()->getTalla()}  m</td>
                            <td width="70"><b>Pulso:</b></td>
                            <td>{$this->consulta->getExploracionFisica()->getPulso()}</td>
                        </tr>
                        <tr>
                            <td width="70"><b>Temperatura:</b></td>
                            <td>{$this->consulta->getExploracionFisica()->getTemperatura()} °C</td>
                            <td width="70" colspan="2"><b>Tensión arterial:</b></td>
                            <td>{$this->consulta->getExploracionFisica()->getTensionArterial()}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td><b>Interrogatorio por aparatos:</b></td>
                <td colspan="3">{$this->consulta->getInterrogatorioAparatosSistemas()}</td>
            </tr>
            <tr>
                <td><b>Nota:</b></td>
                <td colspan="3">{$this->consulta->getNotaMedica()}</td>
            </tr>
            <tr>
                <td><b>A realizar en próxima cita:</b></td>
                <td colspan="3">{$this->consulta->getARealizarEnProximaCita()}</td>
            </tr>
            </tbody>
            </table>
EOD;
        //echo $html;exit;
        $this->setListIndentWidth(2);
        $this->writeHTML($html, true, false, true, false);

        $this->Ln(10);

        //$this->MultiCell(0, 5, ($this->consulta->getNotaMedica() . "\n"), false, 'J');

        $this->Ln(15);

        $this->SetFont('dejavusans', 'B', 12);

        if ($this->consulta->getMedico()->getId() == Usuario::JOHANNA) {
            $this->Cell(0, 5, ('Dra. Johanna Joselyn Vázquez Hernández'), 0, 1, 'C');
            $this->Cell(0, 5, 'Odontopediatra', 0, 1, 'C');
        }

        if ($this->consulta->getMedico()->getId() == Usuario::RIGOBERTO) {
            $this->Cell(0, 5, ('Dr. Rigoberto García López'), 0, 1, 'C');
            $this->Cell(0, 5, 'Otorrinolaringología y Neuro-Otología', 0, 1, 'C');
        }

        $this->Output('Nota médica', 'I');
    }
}