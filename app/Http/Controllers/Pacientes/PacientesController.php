<?php
namespace Siacme\Http\Controllers\Pacientes;

use DateTime;
use Exception;
use File;
use Illuminate\Http\Request;
use LaravelDoctrine\ORM\Facades\EntityManager;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Response;
use Siacme\Aplicacion\ColeccionArray;
use Siacme\Aplicacion\Factories\PacientesVistaFactory;
use Siacme\Aplicacion\Reportes\Consultas\PlanTratamientoJohanna;
use Siacme\Aplicacion\Reportes\Consultas\RecetaJohanna;
use Siacme\Aplicacion\Reportes\Consultas\ReciboPago;
use Siacme\Aplicacion\Reportes\Expedientes\TratamientosOdontologia\ReciboPago as ReciboPagoOtros;
use Siacme\Aplicacion\Reportes\Consultas\ReporteTratamientoOdontologia;
use Siacme\Aplicacion\Reportes\Interconsultas\InterconsultaJohanna;
use Siacme\Aplicacion\Servicios\Expedientes\AnexosUploader;
use Siacme\Dominio\Cobros\CobroTratamientoOdontologia;
use Siacme\Dominio\Consultas\CobroConsulta;
use Siacme\Dominio\Consultas\Repositorios\ConsultasRepositorio;
use Siacme\Dominio\Consultas\Repositorios\RecetasRepositorio;
use Siacme\Dominio\Expedientes\Anexo;
use Siacme\Dominio\Expedientes\Repositorios\ExpedientesRepositorio;
use Siacme\Dominio\Expedientes\Repositorios\TratamientosOdontologiaRepositorio;
use Siacme\Dominio\Expedientes\TratamientoOdontologia;
use Siacme\Dominio\Interconsultas\Repositorios\InterconsultasRepositorio;
use Siacme\Dominio\Usuarios\Repositorios\UsuariosRepositorio;
use Siacme\Exceptions\SiacmeLogger;
use Siacme\Http\Controllers\Controller;


/**
 * @package Siacme\Http\Controllers\Pacientes;
 * @author Gerardo Adrián Gómez Ruiz
 */
class PacientesController extends Controller
{
    /**
     * @var UsuariosRepositorio
     */
    private $usuariosRepositorio;

    /**
     * @var ExpedientesRepositorio
     */
    private $expedientesRepositorio;

    /**
     * PacientesController constructor.
     * @param UsuariosRepositorio $usuariosRepositorio
     * @param ExpedientesRepositorio $expedientesRepositorio
     */
    public function __construct(UsuariosRepositorio $usuariosRepositorio, ExpedientesRepositorio $expedientesRepositorio)
    {
        $this->usuariosRepositorio    = $usuariosRepositorio;
        $this->expedientesRepositorio = $expedientesRepositorio;
    }

    /**
     * Mostrar vista para busqueda de pacientes y ver detalles
     * @param string $medicoId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($medicoId)
    {
        // obtener el medico
        if(is_null($medico = $this->usuariosRepositorio->obtenerPorId((int)base64_decode($medicoId)))) {
            return view('error');
        }

        return view('pacientes.pacientes', compact('medico'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function buscar(Request $request)
    {
        $dato     = $request->get('paciente');
        $medicoId = (int)base64_decode($request->get('medicoId'));

        $medico      = $this->usuariosRepositorio->obtenerPorId($medicoId);
        $expedientes = $this->expedientesRepositorio->obtenerPor(['dato' => $dato]);

        return response()->json([
            'html' => view('pacientes.pacientes_lista', compact('expedientes'))->render()
        ]);
    }

    /**
     * ver el detalle de un paciente
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function detalle(Request $request)
    {
        $medicoId     = (int)base64_decode($request->get('medicoId'));
        $expedienteId = (int)base64_decode($request->get('expedienteId'));
        $medico       = $this->usuariosRepositorio->obtenerPorId($medicoId);
        $expediente   = $this->expedientesRepositorio->obtenerPorId($expedienteId);

        $anexoUploader = new AnexosUploader((string)$expediente->getId());
        $expediente->asignarAnexos($anexoUploader->asignar(), new ColeccionArray());

        return response()->json([
            'html' => PacientesVistaFactory::make($medico, $expediente, $anexoUploader)->render()
        ]);
    }

    /**
     * guardar un anexo del paciente
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function agregarAnexo(Request $request)
    {
        $respuesta     = [];
        $anexo         = new Anexo($request->get('nombreAnexo'));
        $anexoUploader = new AnexosUploader(base64_decode($request->get('expedienteId')));

        try {
            $anexoUploader->guardar($request->file('anexo')->getPathName(), $anexo);
            $respuesta['estatus'] = 'OK';

        } catch (Exception $e) {
            $respuesta['estatus'] = 'fail';
            $respuesta['mensaje'] = $e->getMessage();

            $logger = new SiacmeLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/exceptions/exc_' . date('Y-m-d') . '.log', Logger::ERROR));
            $logger->log($e);

        } finally {
            return response()->json($respuesta);
        }
    }

    /**
     * eliminar un anexo
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function eliminarAnexo(Request $request)
    {
        $expedienteId = (int)base64_decode($request->get('expedienteId'));
        $anexo        = base64_decode($request->get('anexo'));

        $anexoUploader = new AnexosUploader($expedienteId);

        if(!$anexoUploader->eliminar(new Anexo($anexo))) {
            return response()->json([
                'estatus' => 'fail'
            ]);
        }

        return response()->json([
            'estatus' => 'OK'
        ]);
    }

    /**
     * ver el anexo en el browser
     * @param $expedienteId
     * @param $nombre
     * @return \Illuminate\Http\Response
     */
    public function verAnexo($expedienteId, $nombre)
    {
        $anexoUploader = new AnexosUploader($expedienteId);
        $archivo       = File::get($anexoUploader->rutaBase() . $nombre);
        $response      = Response::make($archivo, 200);

        $response->header('Content-Type', 'application/pdf');

        return $response;
    }

    /**
     * anexar un nuevo tratamiento de odontología (ortopedia, ortodoncia o ambos)
     *
     * @param Request $request
     * @param ExpedientesRepositorio $expedientesRepositorio
     * @return \Illuminate\Http\JsonResponse
     */
    public function agregarTratamiento(Request $request, ExpedientesRepositorio $expedientesRepositorio)
    {
        $ortopedia     = $request->get('ortopedia') ? true : false;
        $ortodoncia    = $request->get('ortodoncia') ? true : false;
        $observaciones = $request->get('observaciones');
        $tx            = $request->get('tx');
        $expedienteId  = (int)$request->get('expedienteId');
        $expediente    = $expedientesRepositorio->obtenerPorId($expedienteId);
        $fechaInicio   = DateTime::createFromFormat('Y-m-d', $request->get('fechaInicio'));
        $fechaTermino  = DateTime::createFromFormat('Y-m-d', $request->get('fechaTermino'));

        $tratamiento = new TratamientoOdontologia($request->get('dx'),
            $tx,
            $observaciones,
            (double)$request->get('costo'),
            $fechaInicio,
            $fechaTermino,
            (int)$request->get('mensualidades'),
            $expediente->getExpedienteEspecialidad(),
            new ColeccionArray()
        );

        $tratamiento->generarTratamientos($ortopedia, $ortodoncia);

        if (is_null($expediente->getExpedienteEspecialidad()->getOtrosTratamientos())) {
            $expediente->getExpedienteEspecialidad()->inicializarOtrosTratamientos(new ColeccionArray());
        }
        $expediente->getExpedienteEspecialidad()->asignarOtroTratamiento($tratamiento);

        $respuesta = ['estatus' => 'OK'];
        if (!$expedientesRepositorio->persistir($expediente)) {
            $respuesta['estatus'] = 'fail';
        }

        return response()->json($respuesta);
    }

    public function editarTratamiento(Request $request, TratamientosOdontologiaRepositorio $tratamientosOdontologiaRepositorio)
    {
        $respuesta     = ['estatus' => 'OK'];
        $ortopedia     = $request->get('ortopedia') ? true : false;
        $ortodoncia    = $request->get('ortodoncia') ? true : false;
        $observaciones = $request->get('observaciones');
        $tx            = $request->get('tx');
        $fechaInicio   = DateTime::createFromFormat('Y-m-d', $request->get('fechaInicio'));
        $fechaTermino  = DateTime::createFromFormat('Y-m-d', $request->get('fechaTermino'));

        $tratamientoOdontologia = $tratamientosOdontologiaRepositorio->obtenerPorId((int) $request->get('otroTratamientoId'));
        $tratamientoOdontologia->actualizar($request->get('dx'), $observaciones, $tx, (double)$request->get('costo'), $fechaInicio, $fechaTermino, (int)$request->get('mensualidades'));
        $tratamientoOdontologia->generarTratamientos($ortopedia, $ortodoncia);

        if (!$tratamientosOdontologiaRepositorio->persistir($tratamientoOdontologia)) {
            $respuesta['estatus'] = 'fail';
            $respuesta['mensaje'] = 'Error al actualizar en la base de datos';
        }

        return response()->json($respuesta);
    }

    /**
     * abrir reporte de tratamiento de ortopedia ortodoncia en pdf
     *
     * @param string $otroTratamientoId
     * @param TratamientosOdontologiaRepositorio $tratamientosOdontologiaRepositorio
     */
    public function otroTratamientoPdf($otroTratamientoId, TratamientosOdontologiaRepositorio $tratamientosOdontologiaRepositorio)
    {
        $tratamientoOdontologia = $tratamientosOdontologiaRepositorio->obtenerPorId((int) base64_decode($otroTratamientoId));
        $reporte = new ReporteTratamientoOdontologia($tratamientoOdontologia);
        $reporte->SetHeaderMargin(10);
        $reporte->SetAutoPageBreak(true, 20);
        $reporte->SetMargins(15, 60);
        $reporte->generar();
    }

    /**
     * generar receta en PDF
     * @param string $recetaId
     * @param string $expedienteId
     * @param ExpedientesRepositorio $expedientesRepositorio
     * @param RecetasRepositorio $recetasRepositorio
     */
    public function generarReceta($recetaId, $expedienteId, ExpedientesRepositorio $expedientesRepositorio, RecetasRepositorio $recetasRepositorio)
    {
        $recetaId     = (int)base64_decode($recetaId);
        $expedienteId = (int)base64_decode($expedienteId);

        $expediente = $expedientesRepositorio->obtenerPorId($expedienteId);
        $receta     = $recetasRepositorio->obtenerPorId($recetaId);

        $reporte = new RecetaJohanna($receta, $expediente);
        $reporte->SetHeaderMargin(10);
        $reporte->SetAutoPageBreak(true, 20);
        $reporte->SetMargins(15, 60);
        $reporte->generar();
    }

    /**
     * generar la interconsulta en PDF
     * @param string $interconsultaId
     * @param string $expedienteId
     * @param ExpedientesRepositorio $expedientesRepositorio
     * @param InterconsultasRepositorio $interconsultasRepositorio
     */
    public function generarInterconsulta($interconsultaId, $expedienteId, ExpedientesRepositorio $expedientesRepositorio, InterconsultasRepositorio $interconsultasRepositorio)
    {
        $interconsultaId = (int)base64_decode($interconsultaId);
        $expedienteId    = (int)base64_decode($expedienteId);
        $expediente      = $expedientesRepositorio->obtenerPorId($expedienteId);
        $interconsulta   = $interconsultasRepositorio->obtenerPorId($interconsultaId);

        $reporte = new InterconsultaJohanna($interconsulta, $expediente);
        $reporte->SetHeaderMargin(10);
        $reporte->SetAutoPageBreak(true, 20);
        $reporte->SetMargins(15, 50);
        $reporte->generar();
    }

    /**
     * generar Odontograma en PDF
     * @param string $odontogramaId
     * @param string $expedienteId
     * @param ExpedientesRepositorio $expedientesRepositorio
     */
    public function generarPlan($odontogramaId, $expedienteId, ExpedientesRepositorio $expedientesRepositorio)
    {
        $odontogramaId = (int)base64_decode($odontogramaId);
        $expedienteId  = (int)base64_decode($expedienteId);
        $expediente    = $expedientesRepositorio->obtenerPorId($expedienteId);

        foreach ($expediente->getExpedienteEspecialidad()->odontogramas() as $odontograma) {
            if ($odontograma->getId() === $odontogramaId) {
                $reporte = new PlanTratamientoJohanna($odontograma, $expediente);
                break;
            }
        }

        $reporte->SetHeaderMargin(0);
        $reporte->SetAutoPageBreak(true, 20);
        $reporte->SetMargins(15, 5);
        $reporte->generar();
    }

    /**
     * se marca la consulta como pagada y se especifica la forma de pago
     *
     * @param Request $request
     * @param ConsultasRepositorio $consultasRepositorio
     * @return \Illuminate\Http\JsonResponse
     */
    public function cobrarConsulta(Request $request, ConsultasRepositorio $consultasRepositorio)
    {
        $respuesta    = [];
        $consultaId   = (int)base64_decode($request->get('consultaId'));
        $formaPago    = (int)$request->get('formaPago');
        $pago         = (double)$request->get('pago');

        $consulta = $consultasRepositorio->obtenerPorId($consultaId);

        $cobroConsulta = new CobroConsulta($consulta->getCosto(), $pago, $formaPago, new DateTime());

        try {
            $consulta->registrarPago($cobroConsulta);

        } catch (Exception $e) {
            if (!isset($logger)) {
                $logger = new SiacmeLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/exceptions/exc_' . date('Y-m-d') . '.log', Logger::ERROR));
            }

            $logger->log($e);

            $respuesta['mensaje'] = $e->getMessage();
            $respuesta['estatus'] = 'fail';

            return response()->json($respuesta);
        }

        $respuesta['estatus'] = 'OK';
        if (!$consultasRepositorio->persistir($consulta)) {
            $respuesta['estatus'] = 'fail';
            $respuesta['mensaje'] = 'Ocurrió un error al persistir en la base de datos';
        }

        return response()->json($respuesta);
    }

    /**
     * genera el recibo de pago en PDF
     *
     * @param string $consultaId
     * @param string $expedienteId
     * @return \Illuminate\Http\JsonResponse
     */
    public function generarReciboPago($consultaId = null, ConsultasRepositorio $consultasRepositorio)
    {
        $this->validarQueryString($consultaId);

        $consultaId = (int)base64_decode($consultaId);
        $consulta   = $consultasRepositorio->obtenerPorId($consultaId);

        $reporte = new ReciboPago($consulta);
        $reporte->SetHeaderMargin(10);
        $reporte->SetAutoPageBreak(true, 20);
        $reporte->SetMargins(15, 60);
        $reporte->generar();
    }

    /**
     * registrar el cobro del tratamiento odontologia
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cobrarOtroTratamiento(Request $request)
    {
        $respuesta                = [];
        $expedienteId             = (int)$request->get('expedienteId');
        $tratamientoOdontologiaId = (int)$request->get('otroTratamientoId');
        $formaPago                = (int)$request->get('formaPago');
        $abono                    = (double)$request->get('abono');
        $pago                     = (double)$request->get('pago');

        $expediente      = $this->expedientesRepositorio->obtenerPorId($expedienteId);
        $otroTratamiento = $expediente->getExpedienteEspecialidad()->obtenerOtroTratamiento($tratamientoOdontologiaId);

        $cobroOtroTratamiento = new CobroTratamientoOdontologia($abono, $pago, $formaPago, new DateTime(), $otroTratamiento);

        try {
            $otroTratamiento->registrarPago($cobroOtroTratamiento);

        } catch (Exception $e) {
            if (!isset($logger)) {
                $logger = new SiacmeLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/exceptions/exc_' . date('Y-m-d') . '.log', Logger::ERROR));
            }

            $logger->log($e);

            $respuesta['mensaje'] = $e->getMessage();
            $respuesta['estatus'] = 'fail';

            return response()->json($respuesta);
        }

        $respuesta['estatus'] = 'OK';
        if (!$this->expedientesRepositorio->persistir($expediente)) {
            $respuesta['estatus'] = 'fail';
        }

        $respuesta['id'] = $cobroOtroTratamiento->getId();
        return response()->json($respuesta);
    }

    /**
     * generar PDF de cobro de otros tratamientos
     *
     * @param string $cobroOtroTratamientoId
     * @return mixed
     */
    public function generarReciboPagoOtros($cobroOtroTratamientoId)
    {
        $cobroOtroTratamiento = EntityManager::getRepository(CobroTratamientoOdontologia::class)->find((int) $cobroOtroTratamientoId);

        $reporte = new ReciboPagoOtros($cobroOtroTratamiento);
        $reporte->SetHeaderMargin(10);
        $reporte->SetAutoPageBreak(true, 20);
        $reporte->SetMargins(15, 60);
        $reporte->generar();
    }
}
