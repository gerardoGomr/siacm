<?php
namespace Siacme\Http\Controllers\Consultas;

use DateTime;
use Exception;
use Illuminate\Http\Request;
use Siacme\Aplicacion\ColeccionArray;
use Siacme\Aplicacion\Factories\VistasConsultasFactory;
use Siacme\Aplicacion\Reportes\Consultas\PlanTratamientoJohanna;
use Siacme\Aplicacion\Reportes\Consultas\RecetaJohanna;
use Siacme\Aplicacion\Reportes\Interconsultas\InterconsultaJohanna;
use Siacme\Aplicacion\Servicios\Expedientes\DibujadorOdontogramas;
use Siacme\Dominio\Consultas\Consulta;
use Siacme\Dominio\Consultas\ExploracionFisica;
use Siacme\Dominio\Expedientes\ComportamientoFrankl;
use Siacme\Dominio\Expedientes\DientePlan;
use Siacme\Dominio\Expedientes\PlanTratamiento;
use Siacme\Dominio\Consultas\Receta;
use Siacme\Dominio\Expedientes\Repositorios\ComportamientosFranklRepositorio;
use Siacme\Dominio\Interconsultas\Interconsulta;
use Siacme\Dominio\Expedientes\Repositorios\DienteTratamientosRepositorio;
use Siacme\Dominio\Expedientes\Repositorios\OtrosTratamientosRepositorio;
use Siacme\Dominio\Pacientes\Repositorios\PacientesRepositorio;
use Siacme\Exceptions\OtroTratamientoNoExisteEnPlanActualException;
use Siacme\Exceptions\OtroTratamientoYaHaSidoAgregadoAPlanActualException;
use Siacme\Http\Requests;
use Siacme\Http\Controllers\Controller;
use Siacme\Dominio\Citas\Repositorios\CitasRepositorio;
use Siacme\Dominio\Expedientes\Repositorios\ExpedientesRepositorio;
use Siacme\Dominio\Expedientes\Repositorios\DientePadecimientosRepositorio;
use Siacme\Dominio\Interconsultas\Repositorios\MedicosReferenciaRepositorio;
use Siacme\Dominio\Usuarios\Repositorios\UsuariosRepositorio;
use Siacme\Aplicacion\Servicios\Expedientes\DibujadorPlanTratamiento;
use Siacme\Http\Requests\RegistrarConsultaRequest;

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

    /**
     * construir el plan de tratamiento
     * @param Request $request
     * @param OtrosTratamientosRepositorio $otrosTratamientosRepositorio
     * @param DienteTratamientosRepositorio $dienteTratamientosRepositorio
     * @return \Illuminate\Http\JsonResponse
     */
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
            $request->session()->put('plan', $plan);

        } else {
            $plan = $request->session()->get('plan');
        }

        $respuesta['estatus']    = 'OK';
        $respuesta['html']       = $this->dibujarPlan($plan, $dienteTratamientosRepositorio);
        $respuesta['planValido'] = $plan->todosLosDientesTienenTratamientos() ? '1' : '0';

        return response()->json($respuesta);
    }

    /**
     * agregar otro tratamiento al plan actual
     * @param Request $request
     * @param OtrosTratamientosRepositorio $otrosTratamientosRepositorio
     * @param DienteTratamientosRepositorio $dienteTratamientosRepositorio
     * @return \Illuminate\Http\JsonResponse
     */
    public function agregarOtroTratamiento(Request $request, OtrosTratamientosRepositorio $otrosTratamientosRepositorio, DienteTratamientosRepositorio $dienteTratamientosRepositorio)
    {
        $respuesta          = [];
        $otroTratamientoId  = (int)$request->get('otroTratamientoId');
        $plan               = $request->session()->get('plan');
        $otroTratamiento    = $otrosTratamientosRepositorio->obtenerPorId($otroTratamientoId);

        try {
            $plan->agregarOtroTratamiento($otroTratamiento);
            $respuesta['estatus'] = 'OK';
            $respuesta['html']    = $this->dibujarPlan($plan, $dienteTratamientosRepositorio);

            return response()->json($respuesta);

        } catch(OtroTratamientoYaHaSidoAgregadoAPlanActualException $e) {
            $respuesta['estatus'] = 'fail';
            $respuesta['mensaje'] = $e->getMessage();

            return response()->json($respuesta);
        }
    }

    /**
     * eliminar el tratamiento especificado del plan
     * @param Request $request
     * @param OtrosTratamientosRepositorio $otrosTratamientosRepositorio
     * @param DienteTratamientosRepositorio $dienteTratamientosRepositorio
     * @return \Illuminate\Http\JsonResponse
     */
    public function eliminarOtroTratamiento(Request $request, OtrosTratamientosRepositorio $otrosTratamientosRepositorio, DienteTratamientosRepositorio $dienteTratamientosRepositorio)
    {
        $respuesta          = [];
        $otroTratamientoId  = (int)$request->get('otroTratamientoId');
        $plan               = $request->session()->get('plan');
        $otroTratamiento    = $otrosTratamientosRepositorio->obtenerPorId($otroTratamientoId);

        try {
            $plan->quitarOtroTratamiento($otroTratamiento);

            $respuesta['estatus'] = 'OK';
            $respuesta['html']    = $this->dibujarPlan($plan, $dienteTratamientosRepositorio);

            return response()->json($respuesta);

        } catch(OtroTratamientoNoExisteEnPlanActualException $e) {
            $respuesta['estatus'] = 'fail';
            $respuesta['mensaje'] = $e->getMessage();

            return response()->json($respuesta);
        }
    }

    /**
     * dibujar la representación del plan de tratamiento
     * @param PlanTratamiento $plan
     * @param DienteTratamientosRepositorio $dienteTratamientosRepositorio
     * @return string
     */
    private function dibujarPlan(PlanTratamiento $plan, DienteTratamientosRepositorio $dienteTratamientosRepositorio)
    {
        $dienteTratamientos = $dienteTratamientosRepositorio->obtenerTodos();
        $dibujadorPlan      = new DibujadorPlanTratamiento($plan, $dienteTratamientos);

        return $dibujadorPlan->dibujar();
    }

    /**
     * agregar un tratamiento al diente seleccionado
     * @param Request $request
     * @param DienteTratamientosRepositorio $dienteTratamientosRepositorio
     * @return \Illuminate\Http\JsonResponse
     */
    public function agregarTratamiento(Request $request, DienteTratamientosRepositorio $dienteTratamientosRepositorio)
    {
        $numeroDiente   = (int)$request->get('numeroDiente');
        $tratamientoId  = (int)$request->get('tratamientoId');
        $respuesta      = [];

        $dienteTratamiento = $dienteTratamientosRepositorio->obtenerPorId($tratamientoId);
        $plan              = $request->session()->get('plan');

        try {
            $plan->agregarTratamiento($numeroDiente, new DientePlan($dienteTratamiento));

            $respuesta['estatus']    = 'OK';
            $respuesta['html']       = $this->dibujarPlan($plan, $dienteTratamientosRepositorio);
            $respuesta['planValido'] = $plan->todosLosDientesTienenTratamientos() ? '1' : '0';

        } catch (Exception $e) {
            $respuesta['estatus'] = 'fail';
            $respuesta['mensaje'] = $e->getMessage();

        } finally {
            return response()->json($respuesta);
        }
    }

    /**
     * eliminar el tratamiento del diente seleccionado
     * @param Request $request
     * @param DienteTratamientosRepositorio $dienteTratamientosRepositorio
     * @return \Illuminate\Http\JsonResponse
     */
    public function eliminarTratamiento(Request $request, DienteTratamientosRepositorio $dienteTratamientosRepositorio)
    {
        $numeroDiente   = (int)$request->get('numeroDiente');
        $tratamientoId  = (int)$request->get('tratamientoId');
        $respuesta      = [];

        $dienteTratamiento = $dienteTratamientosRepositorio->obtenerPorId($tratamientoId);
        $plan              = $request->session()->get('plan');

        try {
            $plan->eliminarTratamiento($numeroDiente, $dienteTratamiento);

            $respuesta['estatus']    = 'OK';
            $respuesta['html']       = $this->dibujarPlan($plan, $dienteTratamientosRepositorio);
            $respuesta['planValido'] = $plan->todosLosDientesTienenTratamientos() ? '1' : '0';

        } catch (Exception $e) {
            $respuesta['estatus'] = 'fail';
            $respuesta['mensaje'] = $e->getMessage();

        } finally {
            return response()->json($respuesta);
        }
    }

    /**
     * generar el plan de tratamiento en PDF
     * @param string $pacienteId
     * @param PacientesRepositorio $pacientesRepositorio
     */
    public function planPDF($pacienteId, PacientesRepositorio $pacientesRepositorio)
    {
        $pacienteId = (int)base64_decode($pacienteId);

        $paciente   = $pacientesRepositorio->obtenerPorId($pacienteId);
        $expediente = $this->expedientesRepositorio->obtenerPorPacienteMedico($paciente);
        $plan       = request()->session()->get('plan');

        $reporte = new PlanTratamientoJohanna($plan, $expediente);
        $reporte->SetHeaderMargin(10);
        $reporte->SetAutoPageBreak(true, 20);
        $reporte->SetMargins(15, 60);
        $reporte->generar();
    }

    /**
     * agregar una receta al proceso actual
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function agregarReceta(Request $request)
    {
        $recetaId = (int)$request->get('recetaId');
        $receta   = base64_decode($request->get('receta'));

        $receta = new Receta($recetaId, $receta);
        $request->session()->put('receta', $receta);

        return response()->json([
            'estatus' => 'OK'
        ]);
    }

    /**
     * generar receta médica en PDF
     * @param string $pacienteId
     * @param string $medicoId
     * @param PacientesRepositorio $pacientesRepositorio
     */
    public function generarRecetaEnPDF($pacienteId, $medicoId, PacientesRepositorio $pacientesRepositorio)
    {
        $pacienteId = (int)base64_decode($pacienteId);
        $medicoId   = base64_decode($medicoId);
        $paciente   = $pacientesRepositorio->obtenerPorId($pacienteId);
        $medico     = $this->usuariosRepositorio->obtenerPorId($medicoId);
        $expediente = $this->expedientesRepositorio->obtenerPorPacienteMedico($paciente, $medico);
        $receta     = request()->session()->get('receta');

        $reporte = new RecetaJohanna($receta, $expediente);
        $reporte->SetHeaderMargin(10);
        $reporte->SetAutoPageBreak(true, 20);
        $reporte->SetMargins(15, 60);
        $reporte->generar();
    }

    /**
     * agregar interconsulta a la consulta actual
     * @param Request $request
     * @param MedicosReferenciaRepositorio $medicosReferenciaRepositorio
     * @return \Illuminate\Http\JsonResponse
     */
    public function agregarInterconsulta(Request $request, MedicosReferenciaRepositorio $medicosReferenciaRepositorio)
    {
        $medicoId         = (int)$request->get('medicoId');
        $referencia       = base64_decode($request->get('referencia'));
        $medicoReferencia = $medicosReferenciaRepositorio->obtenerPorId($medicoId);
        $interconsulta    = new Interconsulta($medicoReferencia, $referencia);

        $request->session()->put('interconsulta', $interconsulta);

        return response()->json([
            'estatus' => 'OK'
        ]);
    }

    /**
     * generar el envío a interconsulta en PDF
     * @param $pacienteId
     * @param $medicoId
     * @param PacientesRepositorio $pacientesRepositorio
     */
    public function generarInterconsultaEnPDF($pacienteId, $medicoId, PacientesRepositorio $pacientesRepositorio)
    {
        $pacienteId    = (int)base64_decode($pacienteId);
        $medicoId      = base64_decode($medicoId);
        $paciente      = $pacientesRepositorio->obtenerPorId($pacienteId);
        $medico        = $this->usuariosRepositorio->obtenerPorId($medicoId);
        $expediente    = $this->expedientesRepositorio->obtenerPorPacienteMedico($paciente, $medico);
        $interconsulta = request()->session()->get('interconsulta');

        $reporte = new InterconsultaJohanna($interconsulta, $expediente);
        $reporte->SetHeaderMargin(10);
        $reporte->SetAutoPageBreak(true, 20);
        $reporte->SetMargins(15, 50);
        $reporte->generar();
    }

    public function guardarConsulta(RegistrarConsultaRequest $request, ComportamientosFranklRepositorio $comportamientosFranklRepositorio, PacientesRepositorio $pacientesRepositorio)
    {
        // como se va a almacenar la consulta
        $medicoId                       = (int)base64_decode($request->get('medicoId'));
        $pacienteId                     = (int)base64_decode($request->get('pacienteId'));
        $padecimientoActual             = $request->get('padecimiento');
        $interrogatorioAparatosSistemas = $request->get('interrogatorio');
        $peso                           = $request->get('peso');
        $talla                          = $request->get('talla');
        $pulso                          = $request->get('pulso');
        $temperatura                    = $request->get('temperatura');
        $tensionArterial                = $request->get('tension');
        $notaMedica                     = $request->get('nota');
        $comportamientoFranklId         = (int)$request->get('comportamientoFrankl');
        $costoConsulta                  = $request->get('costoAsignadoConsulta');
        $exploracion                    = new ExploracionFisica($peso, $talla, $pulso, $temperatura, $tensionArterial);
        $comportamiento                 = $comportamientosFranklRepositorio->obtenerPorId($comportamientoFranklId);
        $medico                         = $this->usuariosRepositorio->obtenerPorId($medicoId);
        $paciente                       = $pacientesRepositorio->obtenerPorId($pacienteId);
        $expediente                     = $this->expedientesRepositorio->obtenerPorPacienteMedico($paciente);
        $citaId                         = $request->session()->get('citaId');
        $cita                           = $this->citasRepositorio->obtenerPorId($citaId);

        $consulta                       = new Consulta($padecimientoActual, $interrogatorioAparatosSistemas, $exploracion, $notaMedica, $comportamiento, $costoConsulta, new DateTime(), $medico);

        // atender cita
        $cita->atender();

        // crear objetos propios de cada especialidad
        // si es de johanna se deben crear plan de tratamiento, odontograma
        if ((int)$request->get('primeraVez') === 1) {
            // es de primera vez


        } else {
            //es subsecuente
        }

        // verificar si se mandaron a crear receta e interconsulta
        // interconsulta es propio de expediente
        if ($request->has('interconsulta')) {
            $interconsulta = $request->get('interconsulta');
            $expediente->agregarInterconsulta($interconsulta);
        }

        // receta es propio de consulta
        if ($request->has('receta')) {
            $receta = $request->get('receta');
            $consulta->agregarReceta($receta);
        }

        // si es de primera vez se debe considerar la creación del complemento al expediente
        // dependiendo del médico

    }
}