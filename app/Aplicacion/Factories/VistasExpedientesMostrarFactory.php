<?php
namespace Siacme\Aplicacion\Factories;

use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Pacientes\Paciente;
use Siacme\Dominio\Usuarios\Usuario;
use App;
use Siacme\Infraestructura\Expedientes\DoctrinePadecimientosRepositorio;

/**
 * Class VistasExpedientesMostrarFactory
 * @package Siacme\Aplicacion\Factories
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class VistasExpedientesMostrarFactory
{
    /**
     * generar la vista para el registro de nuevo expediente
     * @param Usuario $medico
     * @param Expediente $expediente
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public static function make(Usuario $medico, Expediente $expediente)
    {
        $vista = null;

        switch($medico->getId()) {
            // johanna
            case Usuario::JOHANNA:
                $vista = 'expedientes.expediente_johanna_ver';
                break;

            case Usuario::RIGOBERTO:
                $vista = 'expedientes.expediente_rigoberto_ver';
                break;
        }

        return view($vista, compact('expediente', 'medico'));
    }
}