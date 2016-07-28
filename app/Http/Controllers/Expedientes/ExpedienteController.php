<?php
namespace Siacme\Http\Controllers\Expedientes;

use Illuminate\Http\Request;
use Siacme\Aplicacion\Factories\ExpedientesFactory;
use Siacme\Aplicacion\Factories\VistasExpedientesGenerarFactory;
use Siacme\Dominio\Expedientes\FotografiaPaciente;
use Siacme\Dominio\Pacientes\Repositorios\PacientesRepositorio;
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
	 * @param $pacienteId
	 * @param $medicoId
	 * @param ExpedientesRepositorio $expedientesRepositorio
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
	 */
	public function registrar($pacienteId, $medicoId, ExpedientesRepositorio $expedientesRepositorio)
	{
		if (request()->session()->has('expediente')) {
			request()->session()->forget('expediente');
		}

		$pacienteId = (int)base64_decode($pacienteId);
		$medicoId   = (int)base64_decode($medicoId);

		$paciente   = $this->pacientesRepositorio->obtenerPorId($pacienteId);
		$medico     = $this->usuariosRepositorio->obtenerPorId($medicoId);
		$expediente = $expedientesRepositorio->obtenerPorPacienteMedico($paciente, $medico);

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

		$respuesta['estatus'] = 'OK';
		$respuesta['html']    = view('expedientes.paciente_foto', compact('expediente'))->render();

		return response()->json($respuesta);
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
		
		// collect request variables and perform business rules
		$expediente = ExpedientesFactory::create($medico, $paciente, $request);

		if (!$this->expedientesRepositorio->persistir($expediente)) {
			// error
			$respuesta['estatus'] = 'fail';
			return response()->json($respuesta);
		}

		// success
		if ($request->session()->has('expediente')) {
			$request->session()->forget('expediente');
		}

		$respuesta['estatus'] = 'OK';
		return response()->json($respuesta);
	}
}