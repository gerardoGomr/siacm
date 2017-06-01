<?php
namespace Siacme\Aplicacion\Reportes\Consultas;

use DateTime;
use Siacme\Aplicacion\Fecha;
use Siacme\Aplicacion\Reportes\ReporteJohanna;
use Siacme\Dominio\Expedientes\TratamientoOdontologia;


/**
 * Class ReporteTratamientoOdontologia
 *
 * @package Siacme\Aplicacion\Reportes\Consultas
 * @category Reporte
 * @author Gerardo Adrián Gómez Ruiz
 */
class ReporteTratamientoOdontologia extends ReporteJohanna
{
    /**
     * @var TratamientoOdontologia
     */
    private $tratamientoOdontologia;

    /**
     * RecetaJohanna Constructor
     * @param TratamientoOdontologia $tratamientoOdontologia
     */
    public function __construct(TratamientoOdontologia $tratamientoOdontologia)
    {
        $this->tratamientoOdontologia = $tratamientoOdontologia;
        parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    }

    /**
     * generar reporte para impresión
     */
    public function generar()
    {
        $fecha = (new DateTime())->format('Y-m-d');
        // TODO: Implement generar() method.
        $this->SetTitle('Tratamiento de ortopedia / ortodoncia');
        $this->AddPage();
        $this->SetFont('helvetica', '', 12);
        $this->Cell(0, 10, Fecha::convertir($fecha), 0, 1, 'R');
        $this->Ln(5);

        $html = '<p><strong>Nombre:</strong> ' . $this->tratamientoOdontologia->getExpedienteEspecialidad()->getExpediente()->getPaciente()->nombreCompleto() . '</p>
                <p><strong>Edad:</strong> ' . $this->tratamientoOdontologia->getExpedienteEspecialidad()->getExpediente()->getPaciente()->edadCompleta() . '</p>';
        $this->WriteHTML($html);
        $this->Ln(10);
        $this->SetFont('helvetica', '', 12);
        $this->WriteHTML($this->tratamientoOdontologia->getDx());
        $this->Ln(10);
        $this->WriteHTML($this->tratamientoOdontologia->getObservaciones());
        $this->Ln(10);
        $this->WriteHTML($this->tratamientoOdontologia->getTx());
        $this->Ln(10);
        $html = '<b>Tiempo aproximado de uso:</b> ' . $this->tratamientoOdontologia->getDuracion() . ' años';
        $this->WriteHTML($html);
        $this->Ln(10);
        $html = '<b>Costo del tratamiento ortopédico:</b> $' . number_format($this->tratamientoOdontologia->getCosto(), 2);
        $this->WriteHTML($html);
        $this->Ln(10);
        $html = '<b>Mensualidades:</b> $' . number_format($this->tratamientoOdontologia->getMensualidades());
        $this->WriteHTML($html);
        $this->Ln(15);
        $html = '<b>Forma de Pago:</b> 50% Toma de impresión o colocación de brackets, 50% 1er mes';
        $this->WriteHTML($html);
        $this->Output('Tratamiento de odontología', 'I');
    }
}