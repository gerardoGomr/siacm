<?php
namespace Siacme\Aplicacion\Reportes\Consultas;

use DateTime;
use Siacme\Aplicacion\Fecha;
use Siacme\Aplicacion\Reportes\ReporteJohanna;
use Siacme\Dominio\Consultas\HigieneDentalConsulta;
use Siacme\Dominio\Expedientes\Expediente;

/**
 * Class HigieneDentalJohanna
 *
 * @package Siacme\Aplicacion\Reportes\Consultas
 * @category Reporte
 * @author Gerardo Gómez <gerardo.gomr@gmail.com>
 */
class HigieneDentalJohanna extends ReporteJohanna
{
    /**
     * @var Expediente
     */
    private $expediente;

    /**
     * @var HigieneDentalConsulta
     */
    private $higieneDentalConsulta;

    /**
     * HigieneDentalJohanna constructor.
     *
     * @param Expediente $expediente
     * @param HigieneDentalConsulta $higieneDentalConsulta
     */
    public function __construct(Expediente $expediente, HigieneDentalConsulta $higieneDentalConsulta)
    {
        $this->expediente            = $expediente;
        $this->higieneDentalConsulta = $higieneDentalConsulta;

        parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    }


    public function generar()
    {
        $peso  = $this->expediente->tieneConsultas() ? $this->expediente->getConsultas()->last()->getExploracionFisica()->getPeso() : '--';
        $fecha = (new DateTime())->format('Y-m-d');
        // TODO: Implement generar() method.
        $this->SetTitle('Indicaciones Higiene Bucodental');
        $this->AddPage();
        $this->SetFont('dejavusans', '', 9);
        $this->Cell(0, 10, Fecha::convertir($fecha), 0, 1, 'R');
        $this->Ln(5);

        $html = '<p><strong>Nombre:</strong> ' . $this->expediente->getPaciente()->nombreCompleto() . '</p>
                <p><strong>Edad:</strong> ' . $this->expediente->getPaciente()->edadCompleta() . '</p>
                <p><strong>Peso:</strong> ' . $peso . ' Kg.</p><hr>';

        $this->WriteHTML($html, true);

        $this->Ln(5);
        $this->WriteHTML('<p><b>Indicaciones:</b></p>', true);
        $this->MultiCell(0, 5, ($this->higieneDentalConsulta->getIndicaciones() . "\n"));
        $this->Ln(5);

        $this->Output('Higiene Bucodental', 'I');
    }
}