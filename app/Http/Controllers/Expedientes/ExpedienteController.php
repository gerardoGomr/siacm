<?php
namespace Siacme\Http\Controllers\Expedientes;

use Illuminate\Http\Request;
use Siacme\Aplicacion\Factories\ExpedientesFactory;
use Siacme\Aplicacion\Factories\ExpedientesEditarFactory;
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
	public function registrar($pacienteId, $medicoId, $citaId)
	{
		if (request()->session()->has('expediente')) {
			request()->session()->forget('expediente');
		}

		$pacienteId = (int)base64_decode($pacienteId);
		$medicoId   = (int)base64_decode($medicoId);
		$citaId     = (int)base64_decode($citaId);

		$paciente   = $this->pacientesRepositorio->obtenerPorId($pacienteId);
		$medico     = $this->usuariosRepositorio->obtenerPorId($medicoId);
		$expediente = $this->expedientesRepositorio->obtenerPorPacienteMedico($paciente, $medico);

		// guardar la cita en sesión para su posterior procesamiento
		request()->session()->put('citaId', $citaId);

		return VistasExpedientesGenerarFactory::make($paciente, $medico, $expediente);
	}

	/**
	 * guardar la fotografía tomada, guardarla en un directorio temporal y asignarla al paciente actual
	 * @param string $pacienteId
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
	 */
	public function capturarFoto($pacienteId)
	{
		$respuesta = [];

		// obtener la foto adjuntada
		if($_FILES['webcam']['error'] !== UPLOAD_ERR_OK) {
			$respuesta['estatus'] = 'fail';
			return response()->json($respuesta);
		}

		$pacienteId = (int)base64_decode($pacienteId);

		$paciente   = $this->pacientesRepositorio->obtenerPorId($pacienteId);
		$fotografia = new FotografiaPaciente($_FILES['webcam']['tmp_name']);
		$nombreFoto = request()->session()->getId();

		if(!$fotografia->moverATemporal($nombreFoto, 200, 300)) {
			$respuesta['estatus'] = 'fail';
			return response()->json($respuesta);
		}

		$expediente = request()->session()->has('expediente') ? request()->session()->get('expediente') : new Expediente($paciente);
		$expediente->asignarFoto($fotografia);

		request()->session()->put('expediente', $expediente);

		/*$respuesta['estatus'] = 'OK';
		$respuesta['html']    = view('expedientes.paciente_foto', compact('expediente'))->render();*/

		return response(view('expedientes.paciente_foto', compact('expediente')));
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
		$x          = $request->get('x');
		$y          = $request->get('y');
		$ancho      = $request->get('w');
		$alto       = $request->get('h');
		$url        = $request->get('urlFoto');
		$pacienteId = (int)base64_decode($request->get('pacienteId'));
		$paciente   = $this->pacientesRepositorio->obtenerPorId($pacienteId);
		$respuesta  = [];

		$fotografia = new FotografiaPaciente($url);

		if(!$fotografia->cambiarTamanio($x, $y, $ancho, $alto)) {
			$respuesta['estatus'] = 'fail';
			return response()->json($respuesta);
		}

		$expediente = $request->session()->has('expediente') ? $request->session()->get('expediente') : new Expediente($paciente);
		$expediente->asignarFoto($fotografia);

		$respuesta['estatus'] = 'OK';
		$respuesta['html']    = view('expedientes.paciente_foto', compact('expediente'))->render();

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

		$pacienteId = (int)base64_decode($request->get('pacienteId'));
		$paciente   = $this->pacientesRepositorio->obtenerPorId($pacienteId);
		$fotografia = new FotografiaPaciente($_FILES['fotoAdjuntada']['tmp_name']);

		if(!$fotografia->moverATemporal($request->session()->getId())) {
			$respuesta['estatus'] = 'fail';
			return response()->json($respuesta);
		}

		$expediente = $request->session()->has('expediente') ? $request->session()->get('expediente') : new Expediente($paciente);
		$expediente->asignarFoto($fotografia);

		$request->session()->put('expediente', $expediente);

		$respuesta['estatus'] = 'OK';
		$respuesta['html']    = view('expedientes.paciente_foto', compact('expediente'))->render();

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
		$paciente   = $this->pacientesRepositorio->obtenerPorId($pacienteId);

		$medicoId = (int)base64_decode($request->get('medicoId'));
		$medico   = $this->usuariosRepositorio->obtenerPorId($medicoId);

		// intentar obtener el expediente
		$expediente = $this->expedientesRepositorio->obtenerPorPacienteMedico($paciente, $medico);

		// si existe, actualizar datos
		if (!is_null($expediente)) {
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

		// $this->pacientesRepositorio->persistir($paciente);

		// guardar foto de paciente
        if($request->get('capturada') === '1') {
            $url = $request->get('foto');
            // foto temporal
            $fotografia = new FotografiaPaciente($url);

            // renombrar foto y adjuntar a la carpeta de fotos
            $fotografia->guardar($expediente->getId());
        }

		// success
		if ($request->session()->has('expediente')) {
			$request->session()->forget('expediente');
		}

		$respuesta['estatus'] = 'OK';
		return response()->json($respuesta);
	}

	/**
	 * mostrar la vista de detalle del expediente
	 * @param string $pacienteId
	 * @param string $medicoId
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
	 */
	public function ver($pacienteId, $medicoId)
	{
		$pacienteId = base64_decode($pacienteId);
		$medicoId   = base64_decode($medicoId);

		$paciente   = $this->pacientesRepositorio->obtenerPorId($pacienteId);
		$medico     = $this->usuariosRepositorio->obtenerPorId($medicoId);
		$expediente = $this->expedientesRepositorio->obtenerPorPacienteMedico($paciente, $medico);

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
		$citaId = $request->session()->get('citaId');
		$cita   = $citasRepositorio->obtenerPorId($citaId);
		$cita->enEsperaDeConsulta();
		$citasRepositorio->actualizar($cita);
		$request->session()->forget('citaId');

		return response()->json($respuesta);
	}
}