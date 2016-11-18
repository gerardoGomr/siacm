<?php
namespace Siacme\Aplicacion\Factories;

use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Pacientes\Paciente;
use Siacme\Dominio\Usuarios\Usuario;
use App;
use Siacme\Infraestructura\Expedientes\DoctrineAtmsRepositorio;
use Siacme\Infraestructura\Expedientes\DoctrineComportamientosFranklRepositorio;
use Siacme\Infraestructura\Expedientes\DoctrineConvexividadesFacialesRepositorio;
use Siacme\Infraestructura\Expedientes\DoctrineMorfologiasCraneofacialesRepositorio;
use Siacme\Infraestructura\Expedientes\DoctrineMorfologiasFacialesRepositorio;
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
     * @param Expediente $expediente
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public static function make(Paciente $paciente, Usuario $medico, Expediente $expediente = null)
    {
        $vista = null;

        switch($medico->getId()) {
            // johanna
            case Usuario::JOHANNA:
                $padecimientoRepositorio = new DoctrinePadecimientosRepositorio(App::getInstance()['em']);
                $padecimientos = $padecimientoRepositorio->obtenerTodos();

                if (isset($expediente) && $expediente->tieneConsultas()) {
                    $morfologiasCraneofacialesRepositorio = new DoctrineMorfologiasCraneofacialesRepositorio(App::getInstance()['em']);
                    $morfologiasFacialesRepositorio       = new DoctrineMorfologiasFacialesRepositorio(App::getInstance()['em']);
                    $convexividadesFacialesRepositorio    = new DoctrineConvexividadesFacialesRepositorio(App::getInstance()['em']);
                    $atmsRepositorio                      = new DoctrineAtmsRepositorio(App::getInstance()['em']);

                    $morfologiasCraneofaciales = $morfologiasCraneofacialesRepositorio->obtenerTodos();
                    $morfologiasFaciales       = $morfologiasFacialesRepositorio->obtenerTodos();
                    $convexividadesFaciales    = $convexividadesFacialesRepositorio->obtenerTodos();
                    $atms                      = $atmsRepositorio->obtenerTodos();

                    $vista = view('expedientes.expediente_johanna_registrar', compact('paciente', 'medico', 'padecimientos', 'expediente', 'morfologiasCraneofaciales', 'morfologiasFaciales', 'convexividadesFaciales', 'atms'));

                } else {
                    $vista = view('expedientes.expediente_johanna_registrar', compact('paciente', 'medico', 'padecimientos', 'expediente'));
                }

                break;
        }

        return $vista;
    }
}