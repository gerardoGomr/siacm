<?php
namespace Siacme\Aplicacion\Factories;

use App;
use Siacme\Aplicacion\ColeccionArray;
use Siacme\Aplicacion\Servicios\Expedientes\DibujadorOdontogramas;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Pacientes\Paciente;
use Siacme\Dominio\Usuarios\Usuario;
use Siacme\Infraestructura\Consultas\DoctrineConsultaCostosRepositorio;
use Siacme\Infraestructura\Consultas\DoctrineRecetasRepositorio;
use Siacme\Infraestructura\Interconsultas\DoctrineMedicosReferenciaRepositorio;
use Siacme\Infraestructura\Expedientes\DoctrineAtmsRepositorio;
use Siacme\Infraestructura\Expedientes\DoctrineComportamientosFranklRepositorio;
use Siacme\Infraestructura\Expedientes\DoctrineConvexividadesFacialesRepositorio;
use Siacme\Infraestructura\Expedientes\DoctrineMorfologiasCraneofacialesRepositorio;
use Siacme\Infraestructura\Expedientes\DoctrineMorfologiasFacialesRepositorio;
use Siacme\Infraestructura\Expedientes\DoctrineDientePadecimientosRepositorio;
use Siacme\Infraestructura\Expedientes\DoctrineDienteTratamientosRepositorio;
use Siacme\Infraestructura\Expedientes\DoctrineOtrosTratamientosRepositorio;

/**
 * Class VistasConsultasFactory
 * @package Siacme\Aplicacion\Factories
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class VistasConsultasFactory
{
    /**
     * devolver la vista correcta dependiendo el médico
     * @param Paciente $paciente
     * @param Usuario $medico
     * @param Expediente $expediente
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|null
     */
    public static function make(Paciente $paciente, Usuario $medico, Expediente $expediente)
    {
        $vista = null;

        switch($medico->getId()) {
            // johanna
            case Usuario::JOHANNA:
                $comportamientosFranklRepositorio     = new DoctrineComportamientosFranklRepositorio(App::getInstance()['em']);
                $morfologiasCraneofacialesRepositorio = new DoctrineMorfologiasCraneofacialesRepositorio(App::getInstance()['em']);
                $morfologiasFacialesRepositorio       = new DoctrineMorfologiasFacialesRepositorio(App::getInstance()['em']);
                $convexividadesFacialesRepositorio    = new DoctrineConvexividadesFacialesRepositorio(App::getInstance()['em']);
                $atmsRepositorio                      = new DoctrineAtmsRepositorio(App::getInstance()['em']);
                $dientePadecimientosRepositorio       = new DoctrineDientePadecimientosRepositorio(App::getInstance()['em']);
                $otrosTratamientosRepositorio         = new DoctrineOtrosTratamientosRepositorio(App::getInstance()['em']);
                $recetasRepositorio                   = new DoctrineRecetasRepositorio(App::getInstance()['em']);
                $medicosReferenciaRepositorio         = new DoctrineMedicosReferenciaRepositorio(App::getInstance()['em']);
                $consultaCostosRepositorio            = new DoctrineConsultaCostosRepositorio(App::getInstance()['em']);

                $comportamientosFrankl     = $comportamientosFranklRepositorio->obtenerTodos();
                $morfologiasCraneofaciales = $morfologiasCraneofacialesRepositorio->obtenerTodos();
                $morfologiasFaciales       = $morfologiasFacialesRepositorio->obtenerTodos();
                $convexividadesFaciales    = $convexividadesFacialesRepositorio->obtenerTodos();
                $atms                      = $atmsRepositorio->obtenerTodos();
                $dientePadecimientos       = $dientePadecimientosRepositorio->obtenerTodos();
                $otrosTratamientos         = $otrosTratamientosRepositorio->obtenerTodos();
                $recetas                   = $recetasRepositorio->obtenerTodos();
                $medicosReferencia         = $medicosReferenciaRepositorio->obtenerTodos();
                $consultaCostos            = $consultaCostosRepositorio->obtenerTodos();

                if ($expediente->getExpedienteEspecialidad()->primeraVez()) {
                    // construir y generar odontograma
                    $odontograma = OdontogramaFactory::crear();

                    $dibujadorOdontograma  = new DibujadorOdontogramas($odontograma);
                }

                if (!request()->session()->has('odontograma')) {
                    request()->session()->put('odontograma', $odontograma);
                }

                $vista = view('consultas.consultas_johanna', compact('paciente', 'medico', 'expediente', 'comportamientosFrankl', 'morfologiasCraneofaciales', 'morfologiasFaciales', 'convexividadesFaciales', 'atms', 'dientePadecimientos', 'dibujadorOdontograma', 'otrosTratamientos', 'recetas', 'medicosReferencia', 'consultaCostos'));
                break;
        }

        return $vista;
    }
}