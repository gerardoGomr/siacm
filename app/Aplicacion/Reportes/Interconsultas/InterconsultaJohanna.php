<?php
namespace Siacme\Aplicacion\Reportes\Interconsultas;

use Siacme\Aplicacion\Reportes\ReporteJohanna;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Interconsultas\Interconsulta;

/**
 * Class InterconsultaJohanna
 * @package Siacme\Aplicacion\Reportes\Consultas
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class InterconsultaJohanna extends ReporteJohanna
{
    /**
     * @var Interconsulta
     */
    private $interconsulta;

    /**
     * @var Expediente
     */
    private $expediente;

    /**
     * InterconsultaJohanna constructor
     * @param Interconsulta $interconsulta
     * @param Expediente $expediente
     */
    public function __construct(Interconsulta $interconsulta, Expediente $expediente)
    {
        $this->interconsulta = $interconsulta;
        $this->expediente    = $expediente;
        parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    }

    /**
     * Generar el cuerpo de la interconsulta
     * 
     * @return void
     */
    public function generar()
    {
        $telefono = $celular = $dato = '';
        if ($this->interconsulta->getMedico()->tieneTelefono())
            $telefono = $this->interconsulta->getMedico()->getTelefono();

        if ($this->interconsulta->getMedico()->tieneCelular())
            $celular = $this->interconsulta->getMedico()->getCelular();

        if (strlen($telefono) && strlen($celular))
            $dato = "$telefono | $celular";
        elseif (strlen($telefono))
            $dato = $telefono;
        elseif (strlen($celular))
            $dato = $celular;

        $this->SetTitle('Interconsulta');
        $this->AddPage();
        $this->SetFont('dejavusans', '', 12);
        $this->Cell(0, 10, $this->interconsulta->getFechaInterconsulta(date('Y-m-d')), 0, 1, 'R');
        $this->Ln(5);
        $html = '<p><strong>Nombre:</strong> ' . $this->interconsulta->getMedico()->nombreCompleto() . '</p>
                <p><strong>Dirección:</strong> ' . $this->interconsulta->getMedico()->getDireccion() . '</p>
                <p><strong>Teléfono(s):</strong> ' . $dato . '</p>';

        $this->WriteHTML($html, true);

        $this->Ln(20);

        $html = '<p style="text-align: right;"><strong>Nombre:</strong> ' . $this->expediente->getPaciente()->nombreCompleto() . '</p>
                <p style="text-align: right;"><strong>Edad:</strong> ' . $this->expediente->getPaciente()->edadCompleta() . '</p>';

        $this->WriteHTML($html, true);

        $this->Ln(10);

        $this->WriteHTML('<p style="text-align: justify">' . $this->interconsulta->getReferencia() . '</p>', true);;

        $this->Ln(15);

        $this->SetFont('dejavusans', 'B', 12);
        $this->Cell(0, 5, ('Dra. Johanna Joselyn Vázquez Hernández'), 0, 1, 'C');
        $this->Cell(0, 5, 'Odontopediatra', 0, 1, 'C');

        $this->Output('Interconsulta', 'I');
    }
}