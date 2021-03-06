<?php
namespace Siacme\Aplicacion\Factories;

use App;
use EntityManager;
use Siacme\Aplicacion\ColeccionArray;
use Siacme\Aplicacion\Servicios\Expedientes\AnexosUploader;
use Siacme\Aplicacion\Servicios\Consultas\DibujadorOdontogramasAtencion;
use Siacme\Aplicacion\Servicios\Expedientes\DibujadorOdontogramas;
use Siacme\Dominio\Consultas\HigieneDental;
use Siacme\Dominio\Consultas\Indicacion;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Pacientes\Paciente;
use Siacme\Dominio\Usuarios\Usuario;
use Siacme\Infraestructura\Consultas\DoctrineConsultaCostosRepositorio;
use Siacme\Infraestructura\Consultas\DoctrineRecetasRepositorio;
use Siacme\Infraestructura\Expedientes\DoctrineAtmsRepositorio;
use Siacme\Infraestructura\Expedientes\DoctrineComportamientosFranklRepositorio;
use Siacme\Infraestructura\Expedientes\DoctrineConvexividadesFacialesRepositorio;
use Siacme\Infraestructura\Expedientes\DoctrineDientePadecimientosRepositorio;
use Siacme\Infraestructura\Expedientes\DoctrineMorfologiasCraneofacialesRepositorio;
use Siacme\Infraestructura\Expedientes\DoctrineMorfologiasFacialesRepositorio;
use Siacme\Infraestructura\Expedientes\DoctrineOtrosTratamientosRepositorio;
use Siacme\Infraestructura\Interconsultas\DoctrineMedicosReferenciaRepositorio;

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
    public static function make(Paciente $paciente, Usuario $medico, Expediente $expediente, $anexos)
    {
        $vista                        = null;
        $medicosReferenciaRepositorio = new DoctrineMedicosReferenciaRepositorio(App::getInstance()['em']);
        $medicosReferencia            = $medicosReferenciaRepositorio->obtenerTodos();

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

                $comportamientosFrankl     = $comportamientosFranklRepositorio->obtenerTodos();
                $morfologiasCraneofaciales = $morfologiasCraneofacialesRepositorio->obtenerTodos();
                $morfologiasFaciales       = $morfologiasFacialesRepositorio->obtenerTodos();
                $convexividadesFaciales    = $convexividadesFacialesRepositorio->obtenerTodos();
                $atms                      = $atmsRepositorio->obtenerTodos();
                $dientePadecimientos       = $dientePadecimientosRepositorio->obtenerTodos();
                $otrosTratamientos         = $otrosTratamientosRepositorio->obtenerTodos();
                $recetas                   = $recetasRepositorio->obtenerTodos();
                $higieneDentalIndicaciones = EntityManager::getRepository(HigieneDental::class)->findAll(); // obtiene la lista de indicaciones
                $indicaciones              = EntityManager::getRepository(Indicacion::class)->findAll();

                if ($expediente->getExpedienteEspecialidad()->primeraVez() || $expediente->getExpedienteEspecialidad()->dadoDeAlta() || !$expediente->getExpedienteEspecialidad()->tieneOdontogramas()) {
                    // construir y generar odontograma
                    $odontograma = OdontogramaFactory::crear();

                    $dibujadorOdontograma  = new DibujadorOdontogramas($odontograma);

                    if (!request()->session()->has('odontograma')) {
                        //EntityManager::detach($odontograma);
                        request()->session()->put('odontograma', $odontograma);
                    }
                } else {
                    // odontograma activo
                    $odontograma = $expediente->getExpedienteEspecialidad()->obtenerOdontogramaActivo();
                    !is_null($odontograma) ? $dibujadorOdontograma = new DibujadorOdontogramasAtencion($odontograma) : $dibujadorOdontograma = null;
                }

                $vista = view('consultas.consultas_johanna', compact('paciente', 'medico', 'expediente', 'comportamientosFrankl', 'morfologiasCraneofaciales', 'morfologiasFaciales', 'convexividadesFaciales', 'atms', 'dientePadecimientos', 'dibujadorOdontograma', 'otrosTratamientos', 'recetas', 'medicosReferencia', 'dibujadorOdontograma', 'higieneDentalIndicaciones', 'indicaciones', 'anexoUploader', 'anexos'));
                break;

            case Usuario::RIGOBERTO:
                $vista = view('consultas.consultas_rigoberto', compact('paciente', 'medico', 'expediente', 'medicosReferencia'));
                break;
        }

        return $vista;
    }
}
