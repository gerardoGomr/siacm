<?php
namespace Siacme\Aplicacion\Reportes\Interconsultas;

use Siacme\Aplicacion\Fecha;
use Siacme\Aplicacion\Reportes\ReporteJohanna;
use Siacme\Dominio\Consultas\Consulta;
use Siacme\Dominio\Expedientes\Expediente;


/**
 * Class NotaMedicaJohanna
 * @package Siacme\Aplicacion\Reportes\Consultas
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
     * InterconsultaJohanna constructor
     * @param Consulta $consulta
     * @param Expediente $expediente
     */
    public function __construct(Consulta $consulta, Expediente $expediente)
    {
        $this->consulta   = $consulta;
        $this->expediente = $expediente;
        parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    }

    public function generar()
    {
        // TODO: Implement generar() method.
        $this->SetTitle('Nota médica');
        $this->AddPage();
        $this->SetFont('helvetica', '', 12);
        $this->Cell(0, 10, Fecha::convertir($this->consulta->getFecha()), 0, 1, 'R');
        $this->Ln(5);
        $html = '<p style="text-align: right;"><strong>Nombre:</strong> ' . $this->expediente->getPaciente()->nombreCompleto() . '</p>
                <p style="text-align: right;"><strong>Edad:</strong> ' . $this->expediente->getPaciente()->edadCompleta() . '</p>';

        $this->WriteHTML($html, true);

        $this->Ln(10);

        $this->MultiCell(0, 5, ($this->consulta->getNotaMedica() . "\n"), false, 'J');

        $this->Ln(15);

        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 5, ('Dra. Johanna Joselyn Vázquez Hernández'), 0, 1, 'C');
        $this->Cell(0, 5, 'Odontopediatra', 0, 1, 'C');

        $this->Output('Interconsulta', 'I');
    }
}