<?php
namespace Siacme\Infraestructura\Citas;

use Siacme\Dominio\Citas\Cita;
use Siacme\Dominio\Usuarios\Especialidad;
use Siacme\Dominio\Usuarios\Usuario;
use Siacme\Dominio\Pacientes\Paciente;


/**
 * @package Siacme\Expedientes\Expediente
 * @author  Gerardo Adrián Gómez Ruiz
 */
interface CitasRepositorioInterface
{
	/**
	 * persistir una cita en el almacenamiento
	 * @param  Cita   $cita
	 * @return bool
	 */
	public function persistir(Cita $cita);

	/**
	 * obtener una lista de citas por médico
	 * @param string $username
	 * @return array
	 */
	public function obtenerCitasPorMedico($username);

	/**
	 * obtener una cita por Id
	 * @param  int $idCita
	 * @return Cita $cita
	 */
	public function obtenerCitaPorId($idCita);

	/**
	 * @param Cita $cita
	 * @return bool
	 */
	public function actualizaEstatus(Cita $cita);

	/**
	 * @param \Siacme\Dominio\Pacientes\Paciente $paciente
	 * @param \Siacme\Dominio\Usuarios\Usuario   $medico
	 * @return Cita
	 */
	public function obtenerCitaPorPacienteMedico(Paciente $paciente, Usuario $medico);
}