<?php
namespace Siacme\Http\Controllers\Pacientes;

use DateTime;
use Exception;
use File;
use Illuminate\Http\Request;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Response;
use Siacme\Aplicacion\Factories\PacientesVistaFactory;
use Siacme\Aplicacion\Reportes\Consultas\PlanTratamientoJohanna;
use Siacme\Aplicacion\Reportes\Consultas\RecetaJohanna;
use Siacme\Aplicacion\Reportes\Consultas\ReciboPago;
use Siacme\Aplicacion\Reportes\Interconsultas\InterconsultaJohanna;
use Siacme\Dominio\Consultas\CobroConsulta;
use Siacme\Dominio\Consultas\Repositorios\RecetasRepositorio;
use Siacme\Dominio\Expedientes\Repositorios\ExpedientesRepositorio;
use Siacme\Dominio\Expedientes\TratamientoOdontologia;
use Siacme\Dominio\Interconsultas\Repositorios\InterconsultasRepositorio;
use Siacme\Dominio\Expedientes\Anexo;
use Siacme\Dominio\Usuarios\Repositorios\UsuariosRepositorio;
use Siacme\Exceptions\SiacmeLogger;
use Siacme\Http\Controllers\Controller;
use Siacme\Aplicacion\Servicios\Expedientes\AnexosUploader;
use Siacme\Aplicacion\ColeccionArray;

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
     * anexar un nuevo tratamiento de odontología
     * @param Request $request
     * @param ExpedientesRepositorio $expedientesRepositorio
     * @return \Illuminate\Http\JsonResponse
     */
    public function agregarTratamiento(Request $request, ExpedientesRepositorio $expedientesRepositorio)
    {
        $ortopedia    = $request->get('ortopedia') ? true : false;
        $ortodoncia   = $request->get('ortodoncia') ? true : false;
        $expedienteId = (int)base64_decode($request->get('expedienteId'));
        $expediente   = $expedientesRepositorio->obtenerPorId($expedienteId);

        $tratamiento = new TratamientoOdontologia($request->get('dx'), (double)$request->get('costo'), (int)$request->get('duracion'), (int)$request->get('mensualidades'), $expediente->getExpedienteEspecialidad(), new ColeccionArray());
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

        $reporte->SetHeaderMargin(10);
        $reporte->SetAutoPageBreak(true, 20);
        $reporte->SetMargins(15, 60);
        $reporte->generar();
    }

    /**
     * se marca la consulta como pagada y se especifica la forma de pago
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cobrarConsulta(Request $request)
    {
        $respuesta    = [];
        $consultaId   = (int)base64_decode($request->get('consultaId'));
        $expedienteId = (int)base64_decode($request->get('expedienteId'));
        $formaPago    = (int)$request->get('formaPago');
        $pago         = (double)$request->get('pago');

        $expediente = $this->expedientesRepositorio->obtenerPorId($expedienteId);

        try {
            $consulta = $expediente->obtenerConsulta($consultaId);

        } catch (Exception $e) {
            $logger = new SiacmeLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/exceptions/exc_' . date('Y-m-d') . '.log', Logger::ERROR));
            $logger->log($e);

            $respuesta['mensaje'] = $e->getMessage();
            $respuesta['estatus'] = 'fail';

            return response()->json($respuesta);
        }

        $cobroConsulta = new CobroConsulta($formaPago, new DateTime());
        if ($cobroConsulta->enEfectivo()) {
            $cobroConsulta->montoPago($pago);
        }

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
        if (!$this->expedientesRepositorio->persistir($expediente)) {
            $respuesta['estatus'] = 'fail';
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
    public function generarReciboPago($consultaId, $expedienteId)
    {
        $consultaId   = (int)base64_decode($consultaId);
        $expedienteId = (int)base64_decode($expedienteId);

        $expediente = $this->expedientesRepositorio->obtenerPorId($expedienteId);

        try {
            $consulta = $expediente->obtenerConsulta($consultaId);

        } catch (Exception $e) {
            $logger = new SiacmeLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/exceptions/exc_' . date('Y-m-d') . '.log', Logger::ERROR));
            $logger->log($e);

            return response()->json([]);
        }

        $reporte = new ReciboPago($expediente, $consulta);
        $reporte->SetHeaderMargin(10);
        $reporte->SetAutoPageBreak(true, 20);
        $reporte->SetMargins(15, 60);
        $reporte->generar();
    }
}
