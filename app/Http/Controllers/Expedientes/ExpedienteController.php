<?php
namespace Siacme\Http\Controllers\Expedientes;

use Exception;
use Illuminate\Http\Request;
use Siacme\Aplicacion\Factories\ExpedientesAgregarDatosConsultaFactory;
use Siacme\Aplicacion\Factories\ExpedientesFactory;
use Siacme\Aplicacion\Factories\ExpedientesEditarFactory;
use Siacme\Aplicacion\Factories\ExpedientesPDFFactoy;
use Siacme\Aplicacion\Factories\VistasExpedientesGenerarFactory;
use Siacme\Aplicacion\Factories\VistasExpedientesMostrarFactory;
use Siacme\Dominio\Expedientes\FotografiaPaciente;
use Siacme\Dominio\Pacientes\Repositorios\PacientesRepositorio;
use Siacme\Dominio\Citas\Repositorios\CitasRepositorio;
use Siacme\Http\Controllers\Controller;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Expedientes\Repositorios\ExpedientesRepositorio;
use Siacme\Dominio\Usuarios\Repositorios\UsuariosRepositorio;
use Siacme\Http\Requests\RegistrarExpedienteRequest;

/**
 * Class ExpedienteController
 * @package Siacme\Http\Controllers\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class ExpedienteController extends Controller
{
	/**
	 * @var UsuariosRepositorio
	 */
	protected $usuariosRepositorio;

	/**
	 * @var ExpedientesRepositorio
	 */
	protected $expedientesRepositorio;

	/**
	 * @var PacientesRepositorio
	 */
	protected $pacientesRepositorio;

	/**
	 * ExpedienteController constructor.
	 * @param UsuariosRepositorio $usuariosRepositorio
	 * @param PacientesRepositorio $pacientesRepositorio
	 * @param ExpedientesRepositorio $expedientesRepositorio
	 */
	public function __construct(UsuariosRepositorio $usuariosRepositorio, PacientesRepositorio $pacientesRepositorio, ExpedientesRepositorio $expedientesRepositorio)
	{
		$this->usuariosRepositorio    = $usuariosRepositorio;
		$this->expedientesRepositorio = $expedientesRepositorio;
		$this->pacientesRepositorio   = $pacientesRepositorio;
	}

	/**
	 * generar la vista para el registro de expedientes
	 * @param string $pacienteId
	 * @param string $medicoId
	 * @param string $citaId
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
	 */
	public function registrar($pacienteId, $medicoId, $citaId = null)
	{
		$pacienteId = (int)base64_decode($pacienteId);
		$medicoId   = (int)base64_decode($medicoId);
		$citaId     = (int)base64_decode($citaId);

		$paciente   = $this->pacientesRepositorio->obtenerPorId($pacienteId);
		$medico     = $this->usuariosRepositorio->obtenerPorId($medicoId);
		$expediente = $this->expedientesRepositorio->obtenerPorPacienteMedico($paciente, $medico);

		// guardar la cita en sesión para su posterior procesamiento
		if (!is_null($citaId)) {
			request()->session()->put('citaId', $citaId);
		}

		return VistasExpedientesGenerarFactory::make($paciente, $medico, $expediente);
	}

	/**
	 * guardar la fotografía tomada, guardarla en un directorio temporal y asignarla al paciente actual
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
	 */
	public function capturarFoto()
	{
		$respuesta = [];

		// obtener la foto adjuntada
		if($_FILES['webcam']['error'] !== UPLOAD_ERR_OK) {
			$respuesta['estatus'] = 'fail';
			return response()->json($respuesta);
		}

		$fotografia = new FotografiaPaciente($_FILES['webcam']['tmp_name']);
		$nombreFoto = request()->session()->getId();

		if(!$fotografia->moverATemporal($nombreFoto, 200, 200)) {
			$respuesta['estatus'] = 'fail';
			return response()->json($respuesta);
		}

		return response(view('expedientes.paciente_foto_temporal', compact('fotografia')));
	}

	/**
	 * cambiar de tamaño la foto especificada
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 * @throws \Throwable
	 */
	public function recortarFoto(Request $request)
	{
		$x     = $request->get('x');
		$y     = $request->get('y');
		$ancho = $request->get('w');
		$alto  = $request->get('h');
		$url   = $request->get('urlFoto');

		$respuesta  = [];

        try {
            $fotografia = new FotografiaPaciente($url);
            $fotografia->cambiarTamanio($x, $y, $ancho, $alto);
        } catch (Exception $e) {
            $respuesta['estatus'] = 'fail';
            $respuesta['mensaje'] = $e->getMessage();
            return response()->json($respuesta);
        }

		$respuesta['estatus'] = 'OK';
		$respuesta['html']    = view('expedientes.paciente_foto_temporal', compact('fotografia'))->render();

		return response()->json($respuesta);
	}

	/**
	 * anexar fotografía a carpeta temporal
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 * @throws \Throwable
	 */
	public function anexarFoto(Request $request)
	{
		$respuesta  = [];

		// obtener la foto adjuntada
		if($_FILES['fotoAdjuntada']['error'] !== UPLOAD_ERR_OK) {
			$respuesta['estatus'] = 'fail';
			return response()->json($respuesta);
		}

        try {
            $fotografia = new FotografiaPaciente($_FILES['fotoAdjuntada']['tmp_name']);
            $fotografia->moverATemporal($request->session()->getId());

        } catch (Exception $e) {
            $respuesta['estatus'] = 'fail';
            $respuesta['mensaje'] = $e->getMessage();
            return response()->json($respuesta);
        }

		$respuesta['estatus'] = 'OK';
		$respuesta['html']    = view('expedientes.paciente_foto_temporal', compact('fotografia'))->render();

		return response()->json($respuesta);
	}

	/**
	 * registrar un nuevo expediente en la base de datos
	 * @param RegistrarExpedienteRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function registrarExpediente(RegistrarExpedienteRequest $request)
	{
		$respuesta = [];

		$pacienteId = (int)base64_decode($request->get('pacienteId'));
		$paciente   = $this->expedientesRepositorio->obtenerPacientePorId($pacienteId);

		$medicoId = (int)base64_decode($request->get('medicoId'));
		$medico   = $this->usuariosRepositorio->obtenerPorId($medicoId);

		// intentar obtener el expediente
		$expediente = $this->expedientesRepositorio->obtenerPorPacienteMedico($paciente, $medico);

		if (!is_null($expediente)) {
            // si existe, actualizar datos
            // actualizar también los otros datos que se capturan en la consulta siempre y cuando el expediente
			// no sea de primera vez
            if (!$expediente->getExpedienteEspecialidad()->primeraVez()) {
				ExpedientesAgregarDatosConsultaFactory::agregar($medico, $expediente, $request);
			}
			ExpedientesEditarFactory::update($medico, $expediente, $request);

		} else {
			// no existe, es nuevo
			// collect request variables and perform business rules
			$expediente = ExpedientesFactory::create($medico, $paciente, $request);
		}

		if (!$this->expedientesRepositorio->persistir($expediente)) {
			// error
			$respuesta['estatus'] = 'fail';
			return response()->json($respuesta);
		}

		// guardar foto de paciente
        if($request->get('capturada') === '1') {
            $url = $request->get('foto');
            // foto temporal
            $fotografia = new FotografiaPaciente($url);

            // renombrar foto y adjuntar a la carpeta de fotos
            $fotografia->guardar($expediente->getId());
        }

		$respuesta['estatus'] = 'OK';
		return response()->json($respuesta);
	}

	/**
	 * mostrar la vista de detalle del expediente
	 * @param string $pacienteId
	 * @param string $medicoId
	 * @param string|null $citaId
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
	 */
	public function ver($pacienteId, $medicoId, $citaId = null)
	{
		$pacienteId = base64_decode($pacienteId);
		$medicoId   = base64_decode($medicoId);

		$paciente   = $this->pacientesRepositorio->obtenerPorId($pacienteId);
		$medico     = $this->usuariosRepositorio->obtenerPorId($medicoId);
		$expediente = $this->expedientesRepositorio->obtenerPorPacienteMedico($paciente, $medico);

		// guardar la cita en sesión para su posterior procesamiento
		if (!is_null($citaId)) {
			$citaId = base64_decode($citaId);
			request()->session()->put('citaId', $citaId);
		}

		return VistasExpedientesMostrarFactory::make($medico, $expediente);
	}

	/**
	 * cambiar el estatus de expediente a revisado
	 * @param Request $request
	 * @param CitasRepositorio $citasRepositorio
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function firmar(Request $request, CitasRepositorio $citasRepositorio)
	{
		$pacienteId = base64_decode($request->get('pacienteId'));
		$medicoId   = base64_decode($request->get('medicoId'));
		$respuesta  = [];

		$paciente   = $this->pacientesRepositorio->obtenerPorId($pacienteId);
		$medico     = $this->usuariosRepositorio->obtenerPorId($medicoId);
		$expediente = $this->expedientesRepositorio->obtenerPorPacienteMedico($paciente, $medico);

		$expediente->revisadoPorPaciente();

		$respuesta['estatus'] = 'OK';
		if (!$this->expedientesRepositorio->persistir($expediente)) {
			// error
			$respuesta['estatus'] = 'fail';
		}

		// actualizar la cita
		$citaId = session('citaId');
		$cita   = $citasRepositorio->obtenerPorId($citaId);
		$cita->enEsperaDeConsulta();
		$citasRepositorio->actualizar($cita);
		$request->session()->forget('citaId');

		return response()->json($respuesta);
	}

    /**
     * generar expediente en PDF
     * @param string $expedienteId
     * @param string $medicoId
     */
    public function generarExpedientePDF($expedienteId, $medicoId)
    {
        $expedienteId = (int)base64_decode($expedienteId);
        $medicoId     = (int)base64_decode($medicoId);
        $expediente   = $this->expedientesRepositorio->obtenerPorId($expedienteId);
        $medico       = $this->usuariosRepositorio->obtenerPorId($medicoId);

        $reporte = ExpedientesPDFFactoy::make($medico, $expediente);
        $reporte->SetHeaderMargin(10);
        $reporte->SetAutoPageBreak(true, 20);
        $reporte->SetMargins(15, 55);
        $reporte->generar();
    }
}