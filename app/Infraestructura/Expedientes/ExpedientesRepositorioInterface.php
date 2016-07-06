<?php
namespace Siacme\Infraestructura\Expedientes;

use Siacme\Dominio\Pacientes\Paciente;
use Siacme\Dominio\Usuarios\Usuario;
use Siacme\Dominio\Expedientes\Expediente;

interface ExpedientesRepositorioInterface
{
	/**
	* guardar o editar el expediente
	* dependiendo si existe o no
	* su idExpediente
	* @param Expediente $expediente
	* @return bool
	*/
	public function persistir(Expediente $expediente);

	/**
	 * @param \Siacme\Dominio\Pacientes\Paciente $paciente
	 * @param \Siacme\Dominio\Usuarios\Usuario   $medico
	 * @return array
	 */
	public function obtenerExpedientePorPacienteMedico(Paciente $paciente, Usuario $medico);

	/**
	 * @param  int		  $idExpediente
	 * @return Expediente
	 */
	public function obtenerExpedientePorId($idExpediente);

	/**
	 * @param Expediente $expediente
	 * @return bool
	 */
	public function guardarElementosDeConsulta(Expediente $expediente);

	/**
	 * @param Expediente $expediente
	 * @return bool
	 */
	public function guardarInterconsulta(Expediente $expediente);
}