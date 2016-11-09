<?php
namespace Siacme\Aplicacion\Reportes;

use TCPDF;

/**
 * Class ReporteConsultorio
 * @package Siacme\Aplicacion\Reportes
 * @author  Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
abstract class ReporteConsultorio extends TCPDF
{
    /**
     * encabezado de reporte
     */
    public function Header() {
        // Set font
        $this->SetFont('helvetica', 'BI', 20);
        $this->SetTextColor(72, 190, 206);
        $this->Cell(0, 10, 'Dra. Johanna Joselyn Vázquez Hernández', false, true, 'R');
        $this->Cell(0, 10, 'Dr. Rigoberto García López', false, true, 'R');
        $this->SetFont('helvetica', 'I', 12);
        $this->Cell(0, 10, '16 poniente norte, Médica Diamante', false, true, 'R');

        // imagen
        $this->Image(asset('img/boka2.jpg'), 10, 10, 26);
        $this->Image(asset('img/orl.jpg'), 10, 23, 25);
        $this->Line(10, 50, 200, 50);
        $this->Ln(25);
    }

    /**
     * pie de reporte, mostrar numero de hojas
     */
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

    /**
     * generar el reporte
     * @return string
     */
    abstract public function generar();
}