<?php
namespace Siacme\Http\Controllers\Expedientes;

use Illuminate\Http\Request;
use Siacme\Aplicacion\Factories\VistasExpedientesGenerarFactory;
use Siacme\Dominio\Pacientes\Repositorios\PacientesRepositorio;
use Siacme\Http\Controllers\Controller;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Expedientes\Repositorios\ExpedientesRepositorio;
use Siacme\Dominio\Usuarios\Repositorios\UsuariosRepositorio;

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
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
	 */
	public function registrar($pacienteId, $medicoId)
	{
		$pacienteId = (int)base64_decode($pacienteId);
		$medicoId   = (int)base64_decode($medicoId);

		$paciente = $this->pacientesRepositorio->obtenerPorId($pacienteId);
		$medico   = $this->usuariosRepositorio->obtenerPorId($medicoId);

		return VistasExpedientesGenerarFactory::make($paciente, $medico);
	}
}