<?php
namespace Siacme\Aplicacion\Factories;

use Siacme\Aplicacion\Servicios\Expedientes\AnexosUploader;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Usuarios\Usuario;

/**
 * Class PacientesVistaFactory
 * @package Siacme\Aplicacion\Factories
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class PacientesVistaFactory
{
    public static function make(Usuario $medico, Expediente $expediente, AnexosUploader $anexosUploader)
    {
        $vista = '';

        switch($medico->getId()) {
            // johanna
            case Usuario::JOHANNA:
                $vista = view('pacientes.pacientes_johanna_detalle', compact('expediente', 'medico', 'anexosUploader'));
                break;
        }

        return $vista;
    }
}