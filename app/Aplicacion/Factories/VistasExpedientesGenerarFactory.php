<?php
namespace Siacme\Aplicacion\Factories;

use Siacme\Dominio\Pacientes\Paciente;
use Siacme\Dominio\Usuarios\Usuario;
use App;
use Siacme\Infraestructura\Expedientes\DoctrinePadecimientosRepositorio;

/**
 * Class VistasExpedientesGenerarFactory
 * @package Siacme\Aplicacion\Factories
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class VistasExpedientesGenerarFactory
{
    /**
     * generar la vista para el registro de nuevo expediente
     * @param Paciente $paciente
     * @param Usuario $medico
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public static function make(Paciente $paciente, Usuario $medico)
    {
        $vista = null;

        switch($medico->getId()) {
            // johanna
            case 2:
                // repositorios
                $padecimientoRepositorio = new DoctrinePadecimientosRepositorio(App::make('Doctrine\ORM\EntityManagerInterface'));
                //$trastornosRepositorio   = new DoctrineTrastornosRepositorio(App::make('Doctrine\ORM\EntityManagerInterface'));

                // catálogos
                $padecimientos = $padecimientoRepositorio->obtenerTodos();

                $vista = view('expedientes.expediente_johanna_registrar', compact('paciente', 'medico', 'padecimientos'));
                break;
        }

        return $vista;
    }
}