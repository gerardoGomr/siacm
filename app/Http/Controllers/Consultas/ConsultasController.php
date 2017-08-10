<?php
namespace Siacme\Http\Controllers\Consultas;

use DateTime;
use Exception;
use Illuminate\Http\Request;
use Siacme\Aplicacion\ColeccionArray;
use Siacme\Aplicacion\Factories\ExpedientesAgregarDatosConsultaFactory;
use Siacme\Aplicacion\Factories\ExpedientesAgregarElementosConsulta;
use Siacme\Aplicacion\Factories\VistasConsultasFactory;
use Siacme\Aplicacion\Reportes\Consultas\PlanTratamientoJohanna;
use Siacme\Aplicacion\Reportes\Consultas\RecetaJohanna;
use Siacme\Aplicacion\Reportes\Interconsultas\InterconsultaJohanna;
use Siacme\Aplicacion\Reportes\Interconsultas\NotaMedicaJohanna;
use Siacme\Aplicacion\Servicios\Expedientes\DibujadorOdontogramas;
use Siacme\Aplicacion\Servicios\Expedientes\DibujadorPlanTratamiento;
use Siacme\Dominio\Citas\Repositorios\CitasRepositorio;
use Siacme\Dominio\Consultas\Consulta;
use Siacme\Dominio\Consultas\ExploracionFisica;
use Siacme\Dominio\Consultas\RecetaConsulta;
use Siacme\Dominio\Consultas\Repositorios\ConsultaCostosRepositorio;
use Siacme\Dominio\Expedientes\DientePlan;
use Siacme\Dominio\Expedientes\Odontograma;
use Siacme\Dominio\Expedientes\OdontogramaOtroTratamiento;
use Siacme\Dominio\Expedientes\Repositorios\ComportamientosFranklRepositorio;
use Siacme\Dominio\Expedientes\Repositorios\DientePadecimientosRepositorio;
use Siacme\Dominio\Expedientes\Repositorios\DienteTratamientosRepositorio;
use Siacme\Dominio\Expedientes\Repositorios\DientesRepositorio;
use Siacme\Dominio\Expedientes\Repositorios\ExpedientesRepositorio;
use Siacme\Dominio\Expedientes\Repositorios\OtrosTratamientosRepositorio;
use Siacme\Dominio\Interconsultas\Interconsulta;
use Siacme\Dominio\Interconsultas\Repositorios\MedicosReferenciaRepositorio;
use Siacme\Dominio\Pacientes\Repositorios\PacientesRepositorio;
use Siacme\Dominio\Usuarios\Repositorios\UsuariosRepositorio;
use Siacme\Exceptions\OtroTratamientoNoExisteEnPlanActualException;
use Siacme\Exceptions\OtroTratamientoYaHaSidoAgregadoAPlanActualException;
use Siacme\Http\Controllers\Controller;
use Siacme\Http\Requests;
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
        if(request()->session()->has('odontograma')) {
            request()->session()->forget('odontograma');
        }

        $pacienteId = (int)base64_decode($pacienteId);
        $medicoId   = (int)base64_decode($medicoId);
        $citaId     = (int)base64_decode($citaId);

        $paciente   = $pacientesRepositorio->obtenerPorId($pacienteId);
        $medico     = $this->usuariosRepositorio->obtenerPorId($medicoId);
        $expediente = $this->expedientesRepositorio->obtenerPorPacienteMedico($paciente, $medico);

        // guardar la cita en sesión para su posterior procesamiento
        request()->session()->put('citaId', $citaId);

        return VistasConsultasFactory::make($paciente, $medico, $expediente);
    }

    /**
     * agrega padecimientos al diente
     * @param Request $request
     * @param DientePadecimientosRepositorio $dientePadecimientosRepositorio
     * @return \Illuminate\Http\JsonResponse
     */
    public function agregaDientePadecimiento(Request $request, DientePadecimientosRepositorio $dientePadecimientosRepositorio)
    {
        $numeroDiente = (int)$request->get('diente');
        $odontograma  = $request->session()->get('odontograma');
        $respuesta    = [];

        $odontograma->removerPadecimientosADiente($numeroDiente);

        foreach ($request->get('padecimientos') as $padecimientos) {
            // alimentar la lista de estatus
            $padecimiento = $dientePadecimientosRepositorio->obtenerPorId($padecimientos);

            try {
                $odontograma->agregarPadecimientoADiente($numeroDiente, $padecimiento);

                $odontogramaDiente = $odontograma->obtenerOdontogramaDiente($numeroDiente);

                foreach ($odontogramaDiente->getPadecimientos() as $padecimientoActual) {
                    if ($padecimientoActual->getNombre() === 'Sano' || $padecimientoActual->getNombre() === 'En erupción') {
                        $odontogramaDiente->removerPadecimientos();
                        $padecimiento = $padecimientoActual;
                        // agregando sano nuevamente
                        $odontograma->agregarPadecimientoADiente($numeroDiente, $padecimiento);
                    }
                }

            } catch (Exception $e) {
                $respuesta['estatus'] = 'fail';
                $respuesta['error']   = $e->getMessage();

                return response()->json($respuesta);
            }
        }

        $dibujadorOdontograma = new DibujadorOdontogramas($odontograma);

        $respuesta['estatus'] = 'OK';
        $respuesta['html']    = $dibujadorOdontograma->dibujar();

        return response()->json($respuesta);
    }

    /**
     * remover padecimientos al diente seleccionado
     *
     * @param Request $request
     * @return Illuminate\Response\JsonResponse
     */
    public function removerDientePadecimiento(Request $request)
    {
        $numeroDiente = (int)$request->get('diente');
        $odontograma  = $request->session()->get('odontograma');
        $respuesta    = [];

        $odontograma->removerPadecimientosADiente($numeroDiente);
        $dibujadorOdontograma = new DibujadorOdontogramas($odontograma);

        $respuesta['estatus'] = 'OK';
        $respuesta['html']    = $dibujadorOdontograma->dibujar();

        return response()->json($respuesta);
    }

    /**
     * construir el plan de tratamiento
     * @param Request $request
     * @param OtrosTratamientosRepositorio $otrosTratamientosRepositorio
     * @param DienteTratamientosRepositorio $dienteTratamientosRepositorio
     * @return \Illuminate\Http\JsonResponse
     */
    public function generarPlanTratamiento(Request $request, OtrosTratamientosRepositorio $otrosTratamientosRepositorio, DienteTratamientosRepositorio $dienteTratamientosRepositorio)
    {
        $respuesta   = [];
        $odontograma = $request->session()->get('odontograma');
        if (!$odontograma->tieneOtrosTratamientos()) {
            // obtener primeros dos otros tratamientos para el plan
            $otroTratamiento1 = $otrosTratamientosRepositorio->obtenerPorId(1);
            $otroTratamiento2 = $otrosTratamientosRepositorio->obtenerPorId(2);

            // obtener plan
            // se inicializan los otros tratamientos
            $odontograma->agregarOtroTratamiento(new OdontogramaOtroTratamiento($odontograma, $otroTratamiento1));
            $odontograma->agregarOtroTratamiento(new OdontogramaOtroTratamiento($odontograma, $otroTratamiento2));
        }

        $respuesta['estatus']    = 'OK';
        $respuesta['html']       = $this->dibujarPlan($odontograma, $dienteTratamientosRepositorio);
        $respuesta['planValido'] = $odontograma->todosLosDientesTienenTratamientos() ? '1' : '0';

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
        $odontograma        = $request->session()->get('odontograma');
        $otroTratamiento    = $otrosTratamientosRepositorio->obtenerPorId($otroTratamientoId);

        try {
            $odontograma->agregarOtroTratamiento(new OdontogramaOtroTratamiento($odontograma, $otroTratamiento));
            $respuesta['estatus'] = 'OK';
            $respuesta['html']    = $this->dibujarPlan($odontograma, $dienteTratamientosRepositorio);

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
        $odontograma        = $request->session()->get('odontograma');
        $otroTratamiento    = $otrosTratamientosRepositorio->obtenerPorId($otroTratamientoId);

        try {
            $odontograma->quitarOtroTratamiento($otroTratamiento);

            $respuesta['estatus'] = 'OK';
            $respuesta['html']    = $this->dibujarPlan($odontograma, $dienteTratamientosRepositorio);

        } catch(OtroTratamientoNoExisteEnPlanActualException $e) {
            $respuesta['estatus'] = 'fail';
            $respuesta['mensaje'] = $e->getMessage();

        } finally {
            return response()->json($respuesta);
        }
    }

    /**
     * dibujar la representación del plan de tratamiento
     * @param Odontograma $odontograma
     * @param DienteTratamientosRepositorio $dienteTratamientosRepositorio
     * @return string
     */
    private function dibujarPlan(Odontograma $odontograma, DienteTratamientosRepositorio $dienteTratamientosRepositorio)
    {
        $dienteTratamientos = $dienteTratamientosRepositorio->obtenerTodos();
        $dibujadorPlan      = new DibujadorPlanTratamiento($odontograma, $dienteTratamientos);

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
        $odontograma       = $request->session()->get('odontograma');

        try {
            $odontograma->agregarTratamiento($numeroDiente, new DientePlan($dienteTratamiento));

            $respuesta['estatus']    = 'OK';
            $respuesta['html']       = $this->dibujarPlan($odontograma, $dienteTratamientosRepositorio);
            $respuesta['planValido'] = $odontograma->todosLosDientesTienenTratamientos() ? '1' : '0';

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
        $odontograma       = $request->session()->get('odontograma');

        try {
            $odontograma->eliminarTratamiento($numeroDiente, $dienteTratamiento);

            $respuesta['estatus']    = 'OK';
            $respuesta['html']       = $this->dibujarPlan($odontograma, $dienteTratamientosRepositorio);
            $respuesta['planValido'] = $odontograma->todosLosDientesTienenTratamientos() ? '1' : '0';

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

        $paciente    = $pacientesRepositorio->obtenerPorId($pacienteId);
        $expediente  = $this->expedientesRepositorio->obtenerPorPacienteMedico($paciente);
        $odontograma = request()->session()->get('odontograma');

        $reporte = new PlanTratamientoJohanna($odontograma, $expediente);
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
        //$recetaId = (int)$request->get('recetaId'); // id
        $receta   = utf8_encode(base64_decode($request->get('receta'))); // cuerpo de la receta

        $receta = new RecetaConsulta($receta);
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
        $referencia       = utf8_encode(base64_decode($request->get('referencia')));
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

    /**
     * se guarda una nueva consulta. Se generan también los elementos adicionales de la consulta, pertenecientes
     * al médico que atiende. Se guardan también los datos de expediente si el paciente que ingresa a consulta es
     * de primera vez
     *
     * @param RegistrarConsultaRequest $request
     * @param ComportamientosFranklRepositorio $comportamientosFranklRepositorio
     * @param PacientesRepositorio $pacientesRepositorio
     * @param DientePadecimientosRepositorio $dientePadecimientosRepositorio
     * @param DienteTratamientosRepositorio $dienteTratamientosRepositorio
     * @param OtrosTratamientosRepositorio $otrosTratamientosRepositorio
     * @param DientesRepositorio $dientesRepositorio
     * @param MedicosReferenciaRepositorio $medicosReferenciaRepositorio
     * @return \Illuminate\Http\JsonResponse
     * @throws \Siacme\Exceptions\CostoYaHaSidoAgregadoAConsultaException
     */
    public function guardarConsulta(RegistrarConsultaRequest $request, ComportamientosFranklRepositorio $comportamientosFranklRepositorio, PacientesRepositorio $pacientesRepositorio, DientePadecimientosRepositorio $dientePadecimientosRepositorio, DienteTratamientosRepositorio $dienteTratamientosRepositorio, OtrosTratamientosRepositorio $otrosTratamientosRepositorio, DientesRepositorio $dientesRepositorio, MedicosReferenciaRepositorio $medicosReferenciaRepositorio)
    {
        $respuesta = [];
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
        $aRealizarEnProximaCita         = $request->get('aRealizarEnProximaCita');
        $comportamientoFranklId         = (int)$request->get('comportamientoFrankl');
        $costoConsulta                  = (double)$request->get('costoAsignadoConsulta');
        $comportamiento                 = $comportamientosFranklRepositorio->obtenerPorId($comportamientoFranklId);
        $medico                         = $this->usuariosRepositorio->obtenerPorId($medicoId);
        $paciente                       = $pacientesRepositorio->obtenerPorId($pacienteId);
        $expediente                     = $this->expedientesRepositorio->obtenerPorPacienteMedico($paciente);
        $citaId                         = $request->session()->get('citaId');
        $cita                           = $this->citasRepositorio->obtenerPorId($citaId);

        // objetos de consulta
        $exploracion = new ExploracionFisica($peso, $talla, $pulso, $temperatura, $tensionArterial);
        $consulta    = new Consulta($padecimientoActual, $interrogatorioAparatosSistemas, $exploracion, $notaMedica, $comportamiento, $costoConsulta, $aRealizarEnProximaCita, new DateTime(), new ColeccionArray(), $medico);

        // atender cita
        $cita->atender();

        // crear objetos propios de cada especialidad
        // si es de johanna se deben crear plan de tratamiento, odontograma
        ExpedientesAgregarElementosConsulta::crear($medico, $expediente, $request, $dientePadecimientosRepositorio, $dienteTratamientosRepositorio, $otrosTratamientosRepositorio, $dientesRepositorio, $consulta);

        // verificar si se mandaron a crear receta e interconsulta
        // interconsulta es propio de expediente
        if ($request->session()->has('interconsulta')) {
            $interconsulta = $request->session()->get('interconsulta');

            $medicoReferencia = $interconsulta->getMedico();
            $interconsulta->removerMedico();
            $medicoReferencia = $medicosReferenciaRepositorio->obtenerPorId($medicoReferencia->getId());
            $interconsulta->agregarMedico($medicoReferencia);

            // asignación bilateral
            $expediente->inicializarInterconsulta(new ColeccionArray(), new ColeccionArray());
            $expediente->agregarInterconsulta($interconsulta);
            $interconsulta->generadaPara($expediente);
        }

        // receta es propio de consulta
        if ($request->session()->has('receta')) {
            $receta = $request->session()->get('receta');
            $consulta->agregarReceta($receta);
        }

        // agrega un comentario de costo
        $consulta->agregarComentario();

        // si es de primera vez se debe considerar la creación del complemento al expediente
        // dependiendo del médico
        if ($request->get('primeraVez') === '1') {
            ExpedientesAgregarDatosConsultaFactory::agregar($medico, $expediente, $request);
        }

        // asignación bilateral
        $expediente->agregarConsulta($consulta);
        $consulta->generadaPara($expediente);

        if (!$this->expedientesRepositorio->persistir($expediente)) {
            $respuesta['estatus'] = 'fail';
        }

        $this->citasRepositorio->persistir($cita);

        $respuesta['estatus'] = 'OK';
        if ($request->session()->has('odontograma')) {
            $respuesta['odontogramaId'] = base64_encode($expediente->getExpedienteEspecialidad()->odontogramas()->last()->getId());
            $respuesta['expedienteId']  = base64_encode($expediente->getId());
        }

        $request->session()->forget('citaId');

        return response()->json($respuesta);
    }

    /**
     * generar la nota médica en PDF
     * 
     * @param string $consultaId
     * @param string $expedienteId
     */
    public function notaMedicaPDF($consultaId, $expedienteId)
    {
        $expediente = $this->expedientesRepositorio->obtenerPorId((int)base64_decode($expedienteId));
        $consulta   = $expediente->obtenerConsulta((int)base64_decode($consultaId));

        $reporte = new NotaMedicaJohanna($consulta, $expediente);
        $reporte->SetHeaderMargin(0);
        $reporte->SetAutoPageBreak(true, 20);
        $reporte->SetMargins(15, 50);
        $reporte->generar();
    }
}
