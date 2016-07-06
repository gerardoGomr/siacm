<?php
namespace Siacme\Infraestructura\Citas;

use DB;
use Siacme\Dominio\Citas\Cita;
use Siacme\Dominio\Citas\CitaEstatus;
use Siacme\Dominio\Usuarios\Especialidad;
use Siacme\Dominio\Usuarios\Usuario;
use Siacme\Dominio\Usuarios\Medico;
use Siacme\Dominio\Pacientes\Paciente;

/**
 * @package Siacme\Citas
 * @author  Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class CitasRepositorioLaravelMySQL implements CitasRepositorioInterface
{
	/**
	 * guardar o editar una cita
	 * @param  Cita   $cita
	 * @return bool
	 */
	public function persistir(Cita $cita)
	{
		try {
			if(is_null($cita->getId())) {
				$idCita = DB::table('cita')
					  ->insertGetId([
							'UserDoctor'         => $cita->getMedico()->getUsername(),
							'idCitaEstatus'      => $cita->getEstatus()->getId(),
							'idPaciente'		 => $cita->getPaciente()->getId(),
							'FechaCita'          => $cita->getFecha(),
							'HoraCita'           => $cita->getHora(),
							'FechaCreacion' 	 => date('Y-m-d'),
							'FechaActualizacion' => date('Y-m-d')
						]);

				$cita->setId($idCita);

			} else {

				$idCita = DB::table('cita')
					->where('idCita', $cita->getId())
		      		->update([
						'FechaCita'			 => $cita->getFecha(),
						'HoraCita'			 => $cita->getHora(),
						'FechaActualizacion' => date('Y-m-d')
			      	]);
			}

			return true;

		} catch(Exception $e) {
			echo $e->getMessage();
			//mail del error para debug
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACM", "Error: ".$e->getMessage());
			return false;
		}
	}
	//obtener las citas del dia especificado
	public function obtenerCitasPorMedico($username, $fecha = null)
	{
		$listaCitas = array();

		try {

			if(isset($fecha)) {
				// corregir la fecha en formato año/mes/dia para la base de datos
				$fecha = Cita::verificaFechaCita($fecha);

				$citas = DB::table('cita')
				->join('paciente', 'paciente.idPaciente', '=', 'cita.idPaciente')
				->where('cita.UserDoctor', $username)
				->where('cita.idCitaEstatus', '<>', '5')
				->where('cita.FechaCita', $fecha)
				->get();

			} else {
				$citas = DB::table('cita')
				->join('paciente', 'paciente.idPaciente', '=', 'cita.idPaciente')

				->where('cita.UserDoctor', $username)
				->where('cita.idCitaEstatus', '<>', '5')
				->get();
			}


			$totalCitas = count($citas);

			if($totalCitas > 0) {
				foreach ($citas as $citas) {

					$cita     = new Cita();
					$paciente = new Paciente();

					$paciente->setId($citas->idPaciente);
					$paciente->setNombre($citas->Nombre);
					$paciente->setPaterno($citas->Paterno);
					$paciente->setMaterno($citas->Materno);
					$paciente->setTelefono($citas->Telefono);
					$paciente->setCelular($citas->Celular);
					$paciente->setEmail($citas->Email);
					$paciente->setEdadAnios($citas->Edad);

					$cita->setId($citas->idCita);
					$cita->setFecha($citas->FechaCita);
					$cita->setHora($citas->HoraCita);
					$cita->setPaciente($paciente);

					$listaCitas[] = $cita;
				}

				return $listaCitas;
			}

			return null;

		} catch(Exception $e) {
			//mail del error para debug
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACM", "Error: ".$e->getMessage());
			echo $e->getMessage();
			return null;
		}
	}

	/**
	* obtener una cita por Id
	* @param  int $idCita
	* @return Cita $cita
	*/
	public function obtenerCitaPorId($idCita)
	{
		try {

			$citas = DB::table('cita')
				->join('cita_estatus', 'cita.idCitaEstatus', '=', 'cita_estatus.idCitaEstatus')
				->join('usuario', 'usuario.Username', '=', 'cita.UserDoctor')
				->join('especialidad', 'usuario.idEspecialidad', '=', 'especialidad.idEspecialidad')
				->join('paciente', 'paciente.idPaciente', '=', 'cita.idPaciente')
				->select('cita.idCita', 'cita.idCitaEstatus', 'cita_estatus.CitaEstatus', 'cita.FechaCita', 'cita.HoraCita', 'usuario.Username', 'usuario.idEspecialidad', 'paciente.Nombre', 'paciente.Paterno', 'paciente.Materno', 'paciente.idPaciente', 'paciente.Telefono', 'paciente.Celular', 'paciente.Email')
				->where('cita.idCita', $idCita)
				->first();

			$totalCitas = count($citas);

			if($totalCitas > 0) {
				$cita = new Cita($citas->idCita);
				$especialidad = new Especialidad();
				$especialidad->setId($citas->idEspecialidad);

				//cita estatus
				$citaEstatus = new CitaEstatus();
				$citaEstatus->setId($citas->idCitaEstatus);
				$citaEstatus->setEstatus($citas->CitaEstatus);

				// paciente
				$paciente = new Paciente();
				$paciente->setId($citas->idPaciente);
				$paciente->setNombre($citas->Nombre);
				$paciente->setPaterno($citas->Paterno);
				$paciente->setMaterno($citas->Materno);
				$paciente->setTelefono($citas->Telefono);
				$paciente->setCelular($citas->Celular);
				$paciente->setEmail($citas->Email);

				//medico
				$medico = new Medico($citas->Username);
				$medico->setEspecialidad($especialidad);

				$cita->setFecha($citas->FechaCita);
				$cita->setHora($citas->HoraCita);
				$cita->setMedico($medico);

				$cita->setEstatus($citaEstatus);
				$cita->setPaciente($paciente);

				return $cita;

			}

			return null;

		} catch(Exception $e) {
			//mail del error para debug
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACM", "Error: ".$e->getMessage());
			return null;
		}
	}

	/**
	 * @param \Siacme\Dominio\Citas\Cita $cita
	 * @return bool
	 */
	public function actualizaEstatus(Cita $cita)
	{
		try {
			DB::table('cita')
				->where('idCita', $cita->getId())
				->update(['idCitaEstatus' => $cita->getEstatus()->getId()]);

			return true;

		} catch(\Exception $e) {
			echo $e->getMessage();
			//mail del error para debug
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACM", "Error: ".$e->getMessage());
			return false;
		}
	}

	/**
	 * @param \Siacme\Dominio\Pacientes\Paciente $paciente
	 * @param \Siacme\Dominio\Usuarios\Usuario   $medico
	 * @return Cita
	 */
	public function obtenerCitaPorPacienteMedico(Paciente $paciente, Usuario $medico)
	{
		try {

			$citas = DB::table('cita')
					->join('cita_estatus', 'cita.idCitaEstatus', '=', 'cita_estatus.idCitaEstatus')
					->where('cita.idPaciente', $paciente->getId())
					->where('cita.UserDoctor', $medico->getUsername())
					->first();

			$totalCitas = count($citas);

			if($totalCitas > 0) {
				$cita = new Cita($citas->idCita);

				//cita estatus
				$citaEstatus = new CitaEstatus();
				$citaEstatus->setId($citas->idCitaEstatus);
				$citaEstatus->setEstatus($citas->CitaEstatus);

				$cita->setFecha($citas->FechaCita);
				$cita->setHora($citas->HoraCita);
				$cita->setMedico($medico);
				$cita->setEstatus($citaEstatus);
				$cita->setPaciente($paciente);

				return $cita;

			}

			return null;

		} catch(Exception $e) {
			//mail del error para debug
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACM", "Error: ".$e->getMessage());
			return null;
		}
	}
}