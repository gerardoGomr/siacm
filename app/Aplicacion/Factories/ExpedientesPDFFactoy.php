<?php
namespace Siacme\Aplicacion\Factories;

use Siacme\Aplicacion\Reportes\Expedientes\ExpedienteJohannaPDF;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Usuarios\Usuario;

/**
 * Class ExpedientesPDFFactoy
 * @package Siacme\Aplicacion\Factories
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class ExpedientesPDFFactoy
{
    /**
     * crea una nueva instancia de reporte de expediente
     * @param Usuario $medico
     * @param Expediente $expediente
     * @return null|ExpedienteJohannaPDF
     */
    public static function make(Usuario $medico, Expediente $expediente)
    {
        $expedientePDF = null;

        switch($medico->getId()) {
            // johanna
            case Usuario::JOHANNA:
                $expedientePDF = new ExpedienteJohannaPDF($expediente);
                break;
        }

        return $expedientePDF;
    }
}