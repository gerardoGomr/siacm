<?php
namespace Siacme\Http\Controllers\Expedientes;

use Illuminate\Http\Request;
use Siacme\Dominio\Citas\CitaEstatus;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Pacientes\FotografiaPaciente;
use Siacme\Http\Requests;
use Siacme\Http\Controllers\Controller;
use Siacme\Infraestructura\Citas\CitasRepositorioInterface;
use Siacme\Infraestructura\Expedientes\ExpedientesRepositorioInterface;
use Siacme\Infraestructura\Pacientes\MarcaPastaRepositorioInterface;
use Siacme\Infraestructura\Pacientes\PadecimientoRepositorioInterface;
use Siacme\Infraestructura\Pacientes\TrastornoRepositorioInterface;
use Siacme\Infraestructura\Usuarios\UsuariosRepositorioInterface;
use Siacme\Servicios\Expedientes\FabricaExpedientesVistas;
use Siacme\Servicios\Expedientes\FabricaExpedientesVistasVer;
use Siacme\Servicios\Pacientes\PacientesFactory;
use Siacme\Servicios\Pacientes\PacientesRepositorioFactory;
use View;

/**
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */

class ExpedienteController extends Controller
{
	/**
	 * @var UsuariosRepositorioInterface
	 */
	protected $usuariosRepositorio;

	/**
	 * @var ExpedientesRepositorioInterface
	 */
	protected $expedientesRepositorio;

	public function __construct(UsuariosRepositorioInterface $usuariosRepositorio, ExpedientesRepositorioInterface $expedientesRepositorio)
	{
		$this->usuariosRepositorio    = $usuariosRepositorio;
		$this->expedientesRepositorio = $expedientesRepositorio;
	}

	/**
	 * @param                              $idPaciente
	 * @param                              $userMedico
	 * @return mixed
	 */
	public function ver($idPaciente, $userMedico)
	{
		$idPaciente           = (int)base64_decode($idPaciente);
		$userMedico           = base64_decode($userMedico);
		$medico               = $this->usuariosRepositorio->obtenerUsuarioPorUsername($userMedico);
		$pacientesRepositorio = PacientesRepositorioFactory::crear($medico);
		$paciente             = $pacientesRepositorio->obtenerPacientePorId($idPaciente);
		$expediente           = $this->expedientesRepositorio->obtenerExpedientePorPacienteMedico($paciente, $medico);
		return FabricaExpedientesVistasVer::construirVista($paciente, $medico, $expediente);

	}

	/**
	 * @param string                           $idPaciente
	 * @param string                           $userMedico
	 * @param PadecimientoRepositorioInterface $padecimientosRepositorio
	 * @param TrastornoRepositorioInterface    $trastornosRepositorio
	 * @param MarcaPastaRepositorioInterface   $pastasRepositorio
	 * @return \Siacme\Servicios\Expedientes\ExpedienteOtorrino
	 * @throws \Exception
	 */
	public function index($idPaciente, $userMedico, PadecimientoRepositorioInterface $padecimientosRepositorio, TrastornoRepositorioInterface $trastornosRepositorio, MarcaPastaRepositorioInterface $pastasRepositorio)
	{
		$idPaciente           = (int)base64_decode($idPaciente);
		$userMedico           = base64_decode($userMedico);
		$medico               = $this->usuariosRepositorio->obtenerUsuarioPorUsername($userMedico);
		$pacientesRepositorio = PacientesRepositorioFactory::crear($medico);
		$paciente             = $pacientesRepositorio->obtenerPacientePorId($idPaciente);
		$expediente           = $this->expedientesRepositorio->obtenerExpedientePorPacienteMedico($paciente, $medico);
		$listaPadecimientos   = $padecimientosRepositorio->obtenerPadecimientos();
		$listaTrastornos      = $trastornosRepositorio->obtenerTrastornos();
		$listaMarcas          = $pastasRepositorio->obtenerMarcaPastas();

		return FabricaExpedientesVistas::construirVista($paciente, $medico, $expediente, $listaPadecimientos, $listaTrastornos, $listaMarcas);
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
	 */
	public function agregarEditarExpediente(Request $request)
	{
		$idPaciente           = (int)base64_decode($request->get('idPaciente'));
		$userMedico           = base64_decode($request->get('userMedico'));
		$medico               = $this->usuariosRepositorio->obtenerUsuarioPorUsername($userMedico);
		$pacientesRepositorio = PacientesRepositorioFactory::crear($medico);
		$paciente             = $pacientesRepositorio->obtenerPacientePorId($idPaciente);
		$expediente           = $this->expedientesRepositorio->obtenerExpedientePorPacienteMedico($paciente, $medico);

		// alimentar de Http Post
		PacientesFactory::alimentarDeHttp($request, $paciente, $medico);

		// persistir
		if(!($pacientesRepositorio->persistir($paciente))) {
			return response(0);
		}

		// generar expediente
        if(is_null($expediente)) {
			$expediente = new Expediente();
			$expediente->setMedico($medico);
			$expediente->setPaciente($paciente);
			$expediente->setPrimeraVez(true);
			$this->expedientesRepositorio->persistir($expediente);
		}

		// éxito
		return response(1);
	}

	/**
	 * firmar
	 * @param \Illuminate\Http\Request                                $request
	 * @param \Siacme\Infraestructura\Citas\CitasRepositorioInterface $citasRepositorio
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
	 */
	public function firmar(Request $request, CitasRepositorioInterface $citasRepositorio)
	{
		$idPaciente           = (int)base64_decode($request->get('idPaciente'));
		$userMedico           = base64_decode($request->get('userMedico'));
		$medico               = $this->usuariosRepositorio->obtenerUsuarioPorUsername($userMedico);
		$pacientesRepositorio = PacientesRepositorioFactory::crear($medico);
		$paciente             = $pacientesRepositorio->obtenerPacientePorId($idPaciente);
		$expediente           = $this->expedientesRepositorio->obtenerExpedientePorPacienteMedico($paciente, $medico);

		$expediente->setFirma(rand());

		if(!$this->expedientesRepositorio->persistir($expediente)) {
			return response(0);
		}

		// cambiar estatus a 3 = en espera
		$cita = $citasRepositorio->obtenerCitaPorPacienteMedico($paciente, $medico);
		$cita->setEstatus(new CitaEstatus(3));

		if(!$citasRepositorio->actualizaEstatus($cita)) {
			return response(0);
		}

		return response(1);
	}

	/**
	 * @param Request                      $request
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
	 */
    public function subirFoto(Request $request)
    {
        // obtener la foto adjuntada
        if($_FILES['fotoAdjuntada']['error'] !== UPLOAD_ERR_OK) {
            return response(0);
        }

		$idPaciente           = (int)base64_decode($request->get('idPaciente'));
		$userMedico           = base64_decode($request->get('userMedico'));
		$medico               = $this->usuariosRepositorio->obtenerUsuarioPorUsername($userMedico);
		$pacientesRepositorio = PacientesRepositorioFactory::crear($medico);
		$paciente             = $pacientesRepositorio->obtenerPacientePorId($idPaciente);
        $fotografia 		  = new FotografiaPaciente($_FILES['fotoAdjuntada']['tmp_name']);

        if(!$fotografia->moverATemporal($request->session()->getId())) {
            return response(0);
        }

        $paciente->setFotografia($fotografia);

        return View::make('expedientes.paciente_foto', compact('paciente'));
    }

	/**
	 * @param Request                      $request
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
	 */
    public function recortarFoto(Request $request)
    {
        // obtener parámetros
		$x                    = $request->get('x');
		$y                    = $request->get('y');
		$ancho                = $request->get('w');
		$alto                 = $request->get('h');
		$url                  = $request->get('urlFoto');
		$idPaciente           = (int)base64_decode($request->get('idPaciente'));
		$userMedico           = base64_decode($request->get('userMedico'));
		$medico               = $this->usuariosRepositorio->obtenerUsuarioPorUsername($userMedico);
		$pacientesRepositorio = PacientesRepositorioFactory::crear($medico);
		$paciente             = $pacientesRepositorio->obtenerPacientePorId($idPaciente);

        $fotografia = new FotografiaPaciente($url);

        if(!$fotografia->cambiarTamanio($x, $y, $ancho, $alto)) {
            return response(0);
        }

        $paciente->setFotografia($fotografia);

        return View::make('expedientes.paciente_foto', compact('paciente'));
    }

	/**
	 * @param $idPaciente
	 * @param $userMedico
	 * @return View
	 */
	public function camara($idPaciente, $userMedico)
	{
		$idPaciente           = (int)base64_decode($idPaciente);
		$userMedico           = base64_decode($userMedico);
		$medico               = $this->usuariosRepositorio->obtenerUsuarioPorUsername($userMedico);
		$pacientesRepositorio = PacientesRepositorioFactory::crear($medico);
		$paciente             = $pacientesRepositorio->obtenerPacientePorId($idPaciente);
		return View::make('expedientes.expediente_paciente_camara', compact('paciente', 'medico'));
	}

	/**
	 * @param                          $idPaciente
	 * @param                          $userMedico
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
	 */
	public function capturarFoto($idPaciente, $userMedico, Request $request)
	{
		// obtener la foto adjuntada
		if($_FILES['webcam']['error'] !== UPLOAD_ERR_OK) {
			return response(0);
		}

		$idPaciente           = (int)base64_decode($idPaciente);
		$userMedico           = base64_decode($userMedico);
		$medico               = $this->usuariosRepositorio->obtenerUsuarioPorUsername($userMedico);
		$pacientesRepositorio = PacientesRepositorioFactory::crear($medico);
		$paciente             = $pacientesRepositorio->obtenerPacientePorId($idPaciente);
		$fotografia 		  = new FotografiaPaciente($_FILES['webcam']['tmp_name']);

		if(!$fotografia->moverATemporal($request->session()->getId(), 300, 200)) {
			return response(0);
		}

		$paciente->setFotografia($fotografia);

		return View::make('expedientes.paciente_foto', compact('paciente'));
	}
}