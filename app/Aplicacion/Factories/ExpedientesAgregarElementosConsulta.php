<?php
namespace Siacme\Aplicacion\Factories;

use EntityManager;
use Illuminate\Http\Request;
use Siacme\Aplicacion\ColeccionArray;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Expedientes\Repositorios\DientePadecimientosRepositorio;
use Siacme\Dominio\Expedientes\Repositorios\DienteTratamientosRepositorio;
use Siacme\Dominio\Expedientes\Repositorios\OtrosTratamientosRepositorio;
use Siacme\Dominio\Usuarios\Usuario;

/**
 * Class ExpedientesAgregarElementosConsulta
 * @package Siacme\Aplicacion\Factories
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class ExpedientesAgregarElementosConsulta
{
    /**
     * generar los elementos de consulta
     * @param Usuario $medico
     * @param Expediente $expediente
     * @param Request $request
     * @param DientePadecimientosRepositorio $dientePadecimientosRepositorio
     * @param DienteTratamientosRepositorio $dienteTratamientosRepositorio
     * @param OtrosTratamientosRepositorio $otrosTratamientosRepositorio
     */
    public static function crear(Usuario $medico, Expediente $expediente, Request $request, DientePadecimientosRepositorio $dientePadecimientosRepositorio, DienteTratamientosRepositorio $dienteTratamientosRepositorio, OtrosTratamientosRepositorio $otrosTratamientosRepositorio)
    {
        switch ($medico->getId()) {
            case Usuario::JOHANNA:
                $expediente->getExpedienteEspecialidad()->inicializarTemp(new ColeccionArray(), new ColeccionArray());
                if(is_null($expediente->getExpedienteEspecialidad()->obtenerPlanActivo())) {
                    // odontograma y plan de tratamiento
                    if ($request->session()->has('odontograma')) {
                        $odontograma = $request->session()->get('odontograma');
                        $odontograma  = EntityManager::merge($odontograma);

                        // refetch para que doctrine los tome como ya existentes
                        foreach ($odontograma->getDientes() as $diente) {
                            foreach ($diente->getPadecimientos() as $padecimiento) {
                                $padecimiento = $dientePadecimientosRepositorio->obtenerPorId($padecimiento->getId());
                            }

                            foreach ($diente->getTratamientos() as $dientePlan) {
                                $tratamiento = $dientePlan->getDienteTratamiento();
                                $tratamiento = $dienteTratamientosRepositorio->obtenerPorId($tratamiento->getId());
                            }
                        }

                        foreach ($odontograma->getOtrosTratamientos() as $otroTratamiento) {
                            $otroTratamiento = $otrosTratamientosRepositorio->obtenerPorId($otroTratamiento->getId());
                        }

                        $expediente->getExpedienteEspecialidad()->agregarOdontograma($odontograma);
                        $odontograma->asignadoA($expediente->getExpedienteEspecialidad());
                    }
                }

                break;
        }
    }
}