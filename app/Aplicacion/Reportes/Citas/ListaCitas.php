<?php
namespace Siacme\Aplicacion\Reportes\Citas;

use Siacme\Aplicacion\Fecha;
use Siacme\Aplicacion\Reportes\ReporteJohanna;
use Siacme\Dominio\Expedientes\Repositorios\ExpedientesRepositorio;
use Siacme\Dominio\Usuarios\Usuario;

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
     * @var Usuario
     */
    private $medico;

    /**
     * @var ExpedientesRepositorio
     */
    private $expedientesRepositorio;

    /**
     * @var string
     */
    private $html;

    /**
     * ListaCitas constructor.
     * @param array $citas
     * @param string $fecha
     */
    public function __construct($citas, $fecha, Usuario $medico, ExpedientesRepositorio $repositorio)
    {
        $this->citas                  = $citas;
        $this->fecha                  = $fecha;
        $this->medico                 = $medico;
        $this->expedientesRepositorio = $repositorio;

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
        $this->SetFont('dejavusans', '', 7);
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
                        <th width="45"><strong>Horario</strong></th>
                        <th width="50"><strong>Duración</strong></th>
                        <th width="105"><strong>Paciente</strong></th>
                        <th width="80"><strong>Edad</strong></th>
                        <th width="150"><strong>A Realizar</strong></th>
                        <th width="60"><strong>Costo</strong></th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($this->citas as $cita) {
            $expediente = $this->expedientesRepositorio->obtenerPorPacienteMedico($cita->getPaciente(), $this->medico);
            $aRealizar  = !is_null($expediente) && $expediente->tieneConsultas() ? $expediente->getConsultas()->last()->getARealizarEnProximaCita() : '--';
            $costo      = !is_null($expediente) && $expediente->tieneConsultas() ? '$' . number_format($expediente->getConsultas()->last()->getCosto(), 2) : '--';
            $duracion = !is_null($expediente) && $expediente->tieneConsultas()
                ? (strlen($expediente->getConsultas()->last()->getDuracionAproximada()) > 0
                    ? $expediente->getConsultas()->last()->getDuracionAproximada() . ' min.'
                    : '-')
                : '-';
            $this->html .= '
                <tr>
                    <td width="45">' . substr($cita->getHora(), 0, 5) . '</td>
                    <td width="50">' . $duracion . '</td>
                    <td width="105">' . $cita->getPaciente()->nombreCompleto() . '</td>
                    <td width="80">' . $cita->getPaciente()->edadCompleta() . '</td>
                    <td width="150">' . $aRealizar . '</td>
                    <td width="60" align="right">' . $costo . '</td>
                </tr>';
        }

        $this->html .= '</tbody></table>';
    }
}