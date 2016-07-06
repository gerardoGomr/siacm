<?php
namespace Siacme\Infraestructura\Pacientes;

use Siacme\Dominio\Pacientes\Paciente;

/**
 * @author Gerardo Adrián Gómez Ruiz
 */
interface PacientesRepositorioInterface
{
	/**
	 * obtener una lista de pacientes
	 * @param  string $nombres
	 * @return array
	 */
	public function obtenerPacientesPorNombre($nombres);

	/**
	 * obtener una lista de pacientes
	 * @param  int $id
	 * @return array
	 */
	public function obtenerPacientePorId($id);

	/**
	 * guardar paciente
	 * @param  Paciente $paciente
	 * @return bool
	 */
	public function persistir(Paciente $paciente);

	/**
	 * actualizar datos faltantes
	 * @param Paciente $paciente
	 * @return bool
	 */
	public function completarDatos(Paciente $paciente);
}