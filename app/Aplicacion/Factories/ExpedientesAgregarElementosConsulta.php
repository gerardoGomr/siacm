<?php
namespace Siacme\Aplicacion\Factories;

use Illuminate\Http\Request;
use Siacme\Aplicacion\ColeccionArray;
use Siacme\Dominio\Consultas\Consulta;
use Siacme\Dominio\Consultas\ExploracionOtorrino;
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
                self::addDetallesJohanna($expediente, $request, $dientePadecimientosRepositorio, $dienteTratamientosRepositorio, $otrosTratamientosRepositorio, $dientesRepositorio, $consulta);
                break;

            case Usuario::RIGOBERTO:
                self::addDetallesRigoberto($expediente, $request, $consulta);
                break;
        }
    }

    private static function addDetallesJohanna(Expediente $expediente, Request $request, DientePadecimientosRepositorio $dientePadecimientosRepositorio, DienteTratamientosRepositorio $dienteTratamientosRepositorio, OtrosTratamientosRepositorio $otrosTratamientosRepositorio, DientesRepositorio $dientesRepositorio, Consulta $consulta = null)
    {
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
    }

    /**
     * Agrega la exploración obtenida en otorrino
     * 
     * @param Expediente $expediente
     * @param Request $request
     * @param Consulta $consulta
     */
    private static function addDetallesRigoberto(Expediente $expediente, Request $request, Consulta $consulta = null)
    {
        $conductoDerecho   = $request->input('conductoDerecho');
        $conductoIzquierdo = $request->input('conductoIzquierdo');
        $membranaDerecha   = $request->input('membranaDerecha');
        $membranaIzquierda = $request->input('membranaIzquierda');
        $piramideNasal     = $request->input('piramideNasal');
        $septumNasal       = $request->input('septumNasal');
        $cornetes          = $request->input('cornetesNasales');
        $amigdalas         = $request->input('amigdalas');
        $pared             = $request->input('paredOrofaringe');

        $exploracionOtorrino = new ExploracionOtorrino();
        $exploracionOtorrino->addConductores($conductoDerecho, $conductoIzquierdo)
            ->addMembranas($membranaDerecha, $membranaIzquierda)
            ->addOtrosDatos($piramideNasal, $septumNasal, $cornetes, $amigdalas, $pared);

        $consulta->addExploracionOtorrino($exploracionOtorrino);

        // marcar primera vez = false
        if ($expediente->getExpedienteRigoberto()->primeraVez()) {
            $expediente->getExpedienteRigoberto()->marcarComoSubsecuente();
        }
    }
}
