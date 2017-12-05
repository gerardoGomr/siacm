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
use Siacme\Dominio\Expedientes\OdontogramaOtroTratamiento;
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
                        $dirigidoA   = $request->get('dirigidoA');

                        $odontogramaDientes = $odontograma->getOdontogramaDientes();

                        // refetch para que doctrine los tome como ya existentes
                        foreach ($odontogramaDientes as $odontogramaDiente) {
                            if (!$odontogramaDiente->tienePadecimientos()) {
                                $odontograma->removerOdontogramaDiente($odontogramaDiente);

                            } else {
                                $numero = $odontogramaDiente->getDiente()->getNumero();

                                $odontogramaDiente->removerDiente();
                                $diente = $dientesRepositorio->obtenerPorNumero($numero);
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
                        }

                        foreach ($odontograma->getOtrosTratamientos() as $otroTratamiento) {
                            $odontograma->quitarOtroTratamiento($otroTratamiento->getOtroTratamiento());
                            $otroTratamiento = $otrosTratamientosRepositorio->obtenerPorId($otroTratamiento->getOtroTratamiento()->getId());
                            $odontograma->agregarOtroTratamiento(new OdontogramaOtroTratamiento($odontograma, $otroTratamiento));
                        }

                        $expediente->getExpedienteEspecialidad()->agregarOdontograma($odontograma);
                        $odontograma->asignadoA($expediente->getExpedienteEspecialidad());
                        $odontograma->establecerAQuienVaDirigido($dirigidoA);
                    }

                } else {
                    // se verifica que tenga un odontograma activo
                    if (!$expediente->getExpedienteEspecialidad()->odontogramasAtendidos()) {
                        // se obtiene el odontograma activo
                        $odontograma = $expediente->getExpedienteEspecialidad()->obtenerOdontogramaActivo();

                        // checar los tratamientos atendidos y marcarlos
                        if ($request->has('otroTratamientoAtendido')) {
                            foreach ($request->get('otroTratamientoAtendido') as $otroTratamientoAtendido) {
                                $otroTratamiento = $otrosTratamientosRepositorio->obtenerPorId((int)$otroTratamientoAtendido);

                                $odontogramaOtroTratamiento = $odontograma->obtenerOtroTratamiento($otroTratamiento);

                                $odontogramaOtroTratamiento->atender();

                                $otroCosto = $otroTratamiento->getTratamiento() . ':  ' . $otroTratamiento->costo() . "\n";
                                $consulta->agregarOtrosCostos($otroCosto);
                            }
                        }

                        // checar los tratamientos por diente y marcarlos
                        if ($request->has('dienteAtendido')) {
                            foreach ($request->get('dienteAtendido') as $dienteAtendido) {
                                $odontogramaDiente = $odontograma->obtenerOdontogramaDiente((int)$dienteAtendido);

                                $odontogramaDiente->atenderTratamientos();

                                $otroCosto = $odontogramaDiente->descripcionTratamientos();
                                $consulta->agregarOtrosCostos($otroCosto);
                            }
                        }

                        $odontograma->verificarSiYaEstaTodoAtendido();
                    }
                }

                // se verifica que no tenga otros tratamientos
                if ($expediente->getExpedienteEspecialidad()->tieneOtrosTratamientos()) {
                    if (!$expediente->getExpedienteEspecialidad()->otrosTratamientosAtendidos()) {
                        if ($request->has('otroTratamientoOdontologiaAtendido')) {
                            // marcar al otro tratamiento como atendido
                            $otroTratamiento = $expediente->getExpedienteEspecialidad()->obtenerOtroTratamientoActivo();

                            $otroTratamiento->finalizarAtencion();
                        }
                    }
                }

                break;
        }
    }
}
