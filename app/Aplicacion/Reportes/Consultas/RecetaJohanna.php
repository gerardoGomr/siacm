<?php
namespace Siacme\Aplicacion\Reportes\Consultas;

use DateTime;
use Siacme\Aplicacion\Fecha;
use Siacme\Aplicacion\Reportes\ReporteJohanna;
use Siacme\Dominio\Consultas\RecetaConsulta;
use Siacme\Dominio\Expedientes\Expediente;

/**
 * Class RecetaJohanna
 * @package Siacme\Aplicacion\Reportes\Consultas
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class RecetaJohanna extends ReporteJohanna
{
    /**
     * @var RecetaConsulta
     */
    private $receta;

    /**
     * @var Expediente
     */
    private $expediente;

    /**
     * RecetaJohanna Constructor
     * @param RecetaConsulta $receta
     * @param Expediente $expediente
     */
    public function __construct(RecetaConsulta $receta, Expediente $expediente)
    {
        $this->receta     = $receta;
        $this->expediente = $expediente;
        parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    }

    /**
     * generar receta médica PDF
     */
    public function generar()
    {
        $peso  = $this->expediente->tieneConsultas() ? $this->expediente->getConsultas()->last()->getExploracionFisica()->getPeso() : '--';
        $fecha = (new DateTime())->format('Y-m-d');
        // TODO: Implement generar() method.
        $this->SetTitle('Receta');
        $this->AddPage();
        $this->SetFont('dejavusans', '', 12);
        $this->Cell(0, 10, Fecha::convertir($fecha), 0, 1, 'R');
        $this->Ln(5);

        $html = '<p><strong>Nombre:</strong> ' . $this->expediente->getPaciente()->nombreCompleto() . '</p>
                <p><strong>Edad:</strong> ' . $this->expediente->getPaciente()->edadCompleta() . '</p>
                <p><strong>Peso:</strong> ' . $peso . ' Kg.</p><hr>';

        $this->WriteHTML($html, true);

        $this->Ln(5);
        $this->SetFont('dejavusans', '', 10);
        $this->MultiCell(0, 5, ($this->receta->getCuerpo() . "\n"));
        $this->Ln(5);

        $this->Output('Receta médica', 'I');
    }
}