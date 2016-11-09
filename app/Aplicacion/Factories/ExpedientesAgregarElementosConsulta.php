<?php
namespace Siacme\Aplicacion\Factories;

use Illuminate\Http\Request;
use Siacme\Aplicacion\ColeccionArray;
use Siacme\Dominio\Consultas\Consulta;
use Siacme\Dominio\Expedientes\DientePlan;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Expedientes\Repositorios\DientePadecimientosRepositorio;
use Siacme\Dominio\Expedientes\Repositorios\DientesRepositorio;
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
     * @param DientesRepositorio $dientesRepositorio
     * @param Consulta $consulta
     */
    public static function crear(Usuario $medico, Expediente $expediente, Request $request, DientePadecimientosRepositorio $dientePadecimientosRepositorio, DienteTratamientosRepositorio $dienteTratamientosRepositorio, OtrosTratamientosRepositorio $otrosTratamientosRepositorio, DientesRepositorio $dientesRepositorio, Consulta $consulta = null)
    {
        switch ($medico->getId()) {
            case Usuario::JOHANNA:
                if(is_null($expediente->getExpedienteEspecialidad()->obtenerOdontogramaActivo())) {
                    // odontograma y plan de tratamiento
                    if ($request->session()->has('odontograma')) {
                        $odontograma = $request->session()->get('odontograma');

                        $odontogramaDientes = $odontograma->getOdontogramaDientes();

                        // refetch para que doctrine los tome como ya existentes
                        foreach ($odontogramaDientes as $odontogramaDiente) {
                            $diente = $odontogramaDiente->getDiente();

                            $odontogramaDiente->removerDiente();
                            $diente = $dientesRepositorio->obtenerPorNumero($diente->getNumero());
                            $odontogramaDiente->agregarDiente($diente);

                            $padecimientos = $odontogramaDiente->getPadecimientos();
                            foreach ($padecimientos as $padecimiento) {
                                $odontogramaDiente->removerPadecimiento($padecimiento);
                                $padecimiento = $dientePadecimientosRepositorio->obtenerPorId($padecimiento->getId());
                                $odontogramaDiente->agregarPadecimiento($padecimiento);
                            }

                            foreach ($odontogramaDiente->getTratamientos() as $dientePlan) {
                                $tratamiento = $dientePlan->getDienteTratamiento();
                                $odontogramaDiente->eliminarTratamiento($tratamiento);
                                $tratamiento = $dienteTratamientosRepositorio->obtenerPorId($tratamiento->getId());

                                $dientePlan = new DientePlan($tratamiento);
                                $dientePlan->asignarOdontogramaDiente($odontogramaDiente);
                                $odontogramaDiente->agregarTratamiento($dientePlan);
                            }
                        }

                        foreach ($odontograma->getOtrosTratamientos() as $otroTratamiento) {
                            $odontograma->quitarOtroTratamiento($otroTratamiento);
                            $otroTratamiento = $otrosTratamientosRepositorio->obtenerPorId($otroTratamiento->getId());
                            $odontograma->agregarOtroTratamiento($otroTratamiento);
                        }

                        $expediente->getExpedienteEspecialidad()->agregarOdontograma($odontograma);
                        $odontograma->asignadoA($expediente->getExpedienteEspecialidad());
                    }

                } else {
                    // se obtiene el odontograma activo
                    $odontograma = $expediente->getExpedienteEspecialidad()->obtenerOdontogramaActivo();

                    // checar los tratamientos atendidos y marcarlos
                    foreach ($request->get('otroTratamientoAtendido') as $otroTratamientoAtendido) {
                        $otroTratamiento = $otrosTratamientosRepositorio->obtenerPorId((int)$otroTratamientoAtendido);

                        $odontogramaOtroTratamiento = $odontograma->obtenerOtroTratamiento($otroTratamiento);

                        $odontogramaOtroTratamiento->atender();

                        $otroCosto = $otroTratamiento->getTratamiento() . ':  ' . $otroTratamiento->costo() . "\n";
                        $consulta->agregarOtrosCostos($otroCosto);
                    }

                    // checar los tratamientos por diente y marcarlos
                    foreach ($request->get('dienteAtendido') as $dienteAtendido) {
                        $odontogramaDiente = $odontograma->obtenerOdontogramaDiente((int)$dienteAtendido);

                        $odontogramaDiente->atenderTratamientos();

                        $otroCosto = $odontogramaDiente->descripcionTratamientos();
                        $consulta->agregarOtrosCostos($otroCosto);
                    }

                    $odontograma->verificarSiYaEstaTodoAtendido();
                }

                break;
        }
    }
}