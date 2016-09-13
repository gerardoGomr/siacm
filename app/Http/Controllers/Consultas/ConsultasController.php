<?php
namespace Siacme\Http\Controllers\Consultas;

use DateTime;
use \Exception;
use Illuminate\Http\Request;
use Siacme\Aplicacion\ColeccionArray;
use Siacme\Aplicacion\Factories\VistasConsultasFactory;
use Siacme\Aplicacion\Servicios\Expedientes\DibujadorOdontogramas;
use Siacme\Dominio\Expedientes\PlanTratamiento;
use Siacme\Dominio\Expedientes\Odontograma;
use Siacme\Dominio\Expedientes\Repositorios\DienteTratamientosRepositorio;
use Siacme\Dominio\Expedientes\Repositorios\OtrosTratamientosRepositorio;
use Siacme\Dominio\Pacientes\Repositorios\PacientesRepositorio;
use Siacme\Http\Requests;
use Siacme\Http\Controllers\Controller;
use Siacme\Dominio\Citas\Repositorios\CitasRepositorio;
use Siacme\Dominio\Expedientes\Repositorios\ExpedientesRepositorio;
use Siacme\Dominio\Expedientes\Repositorios\DientePadecimientosRepositorio;
use Siacme\Dominio\Usuarios\Repositorios\UsuariosRepositorio;
use Siacme\Aplicacion\Servicios\Expedientes\DibujadorPlanTratamiento;

/**
 * Class ConsultasController
 * @package Siacme\Http\Controllers\Consultas
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class ConsultasController extends Controller
{
    /**
     * repositorio de citas
     * @var CitasRepositorio
     */
    protected $citasRepositorio;

    /**
     * @var UsuariosRepositorio
     */
    protected $usuariosRepositorio;

    /**
     * @var ExpedientesRepositorio
     */
    protected $expedientesRepositorio;

    /**
     * ConsultasController constructor.
     * @param CitasRepositorio $citasRepositorio
     * @param UsuariosRepositorio $usuariosRepositorio
     * @param ExpedientesRepositorio $expedientesRepositorio
     */
    public function __construct(CitasRepositorio $citasRepositorio, UsuariosRepositorio $usuariosRepositorio, ExpedientesRepositorio $expedientesRepositorio)
    {
        $this->citasRepositorio       = $citasRepositorio;
        $this->usuariosRepositorio    = $usuariosRepositorio;
        $this->expedientesRepositorio = $expedientesRepositorio;
    }

    /**
     * obtener la lista de citas del medico seleccionado
     * por default las del día
     * @param string $medicoId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($medicoId)
    {
        $medicoId = (int)base64_decode($medicoId);
        if(is_null($medico = $this->usuariosRepositorio->obtenerPorId($medicoId))) {
            return view('error');
        }

        $citas = $this->citasRepositorio->obtenerPorMedico($medico, (new DateTime())->format('Y-m-d'));

        return view('consultas.consultas', compact('citas', 'medico'));
    }

    /**
     * obtener una lista de citas dependiendo el dia seleccionado
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Throwable
     */
    public function verCitasDelDia(Request $request)
    {
        $fecha     = $request->get('fecha');
        $medicoId  = (int)base64_decode($request->get('medicoId'));

        $medico = $this->usuariosRepositorio->obtenerPorId($medicoId);
        $citas  = $this->citasRepositorio->obtenerPorMedico($medico, $fecha);

        $respuesta = [
            'estatus' => 'OK',
            'html'    => view('consultas.consultas_lista_citas', compact('citas', 'fecha'))->render()
        ];

        return response()->json($respuesta);
    }

    /**
     * revisar el detalle de la cita
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Throwable
     */
    public function citaDetalle(Request $request)
    {
        $citaId = (int)base64_decode($request->get('citaId'));
        $cita   = $this->citasRepositorio->obtenerPorId($citaId);

        $respuesta = [
            'estatus' => 'OK',
            'html'    => view('consultas.consultas_citas_detalle', compact('cita'))->render()
        ];

        return response()->json($respuesta);
    }

    /**
     * construir la vista de consulta dependiendo el médico
     * @param string $pacienteId
     * @param string $medicoId
     * @param string $citaId
     * @param PacientesRepositorio $pacientesRepositorio
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function capturar($pacienteId, $medicoId, $citaId, PacientesRepositorio $pacientesRepositorio)
    {
        $pacienteId = (int)base64_decode($pacienteId);
        $medicoId   = (int)base64_decode($medicoId);
        $citaId     = (int)base64_decode($citaId);

        $paciente   = $pacientesRepositorio->obtenerPorId($pacienteId);
        $medico     = $this->usuariosRepositorio->obtenerPorId($medicoId);
        $expediente = $this->expedientesRepositorio->obtenerPorPacienteMedico($paciente, $medico);

        // guardar la cita en sesión para su posterior procesamiento
        if (!request()->session()->has('citaId')) {
            request()->session()->put('citaId', $citaId);
        }

        return VistasConsultasFactory::make($paciente, $medico, $expediente);
    }

    /**
     * agrega padecimientos al diente
     * @param Request $request
     * @param DientePadecimientosRepositorio $padecimientosRepositorio
     * @return \Illuminate\Http\JsonResponse
     */
    public function agregaDientePadecimiento(Request $request, DientePadecimientosRepositorio $padecimientosRepositorio)
    {
        $numeroDiente = (int)$request->get('diente');
        $odontograma  = $request->session()->get('odontograma');
        $respuesta    = [];

        $odontograma->removerPadecimientosADiente($numeroDiente);

        foreach ($request->get('padecimientos') as $padecimientos) {
            // alimentar la lista de estatus
            $padecimiento = $padecimientosRepositorio->obtenerPorId($padecimientos);

            try {
                $odontograma->agregarPadecimientoADiente($numeroDiente, $padecimiento);

            } catch (Exception $e) {
                $respuesta['estatus'] = 'fail';
                $respuesta['error']   = $e->getMessage();
            }
        }

        $dibujadorOdontograma = new DibujadorOdontogramas($odontograma);

        $respuesta['estatus'] = 'OK';
        $respuesta['html']    = $dibujadorOdontograma->dibujar();

        // $request->session()->put('odontograma', $odontograma);

        return response()->json($respuesta);
    }

    public function verPlan(Request $request, OtrosTratamientosRepositorio $otrosTratamientosRepositorio, DienteTratamientosRepositorio $dienteTratamientosRepositorio)
    {
        $respuesta   = [];
        $odontograma = $request->session()->get('odontograma');

        if(!($request->session()->has('plan'))) {
            $odontograma->borrarDientesTratamientos();

            // obtener primeros dos otros tratamientos para el plan
            $otroTratamiento1 = $otrosTratamientosRepositorio->obtenerPorId(1);
            $otroTratamiento2 = $otrosTratamientosRepositorio->obtenerPorId(2);

            // obtener plan
            $plan = new PlanTratamiento(new ColeccionArray());
            $plan->agregarOtroTratamiento($otroTratamiento1);
            $plan->agregarOtroTratamiento($otroTratamiento2);

            $plan->generarDeOdontograma($odontograma);

        } else {
            $plan = $request->session()->get('plan');
        }

        $dienteTratamientos = $dienteTratamientosRepositorio->obtenerTodos();
        $dibujadorPlan      = new DibujadorPlanTratamiento($plan, $dienteTratamientos);

        $respuesta['estatus'] = 'OK';
        $respuesta['html']    = $dibujadorPlan->dibujar();

        return response()->json($respuesta);
    }
}