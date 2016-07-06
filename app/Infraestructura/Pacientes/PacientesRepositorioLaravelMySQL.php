<?php
namespace Siacme\Infraestructura\Pacientes;

use DB;
use Siacme\Dominio\Pacientes\Escolaridad;
use Siacme\Dominio\Pacientes\EstadoCivil;
use Siacme\Dominio\Pacientes\InstitucionMedica;
use Siacme\Dominio\Pacientes\Paciente;
use Siacme\Dominio\Pacientes\PacienteJohanna;
use Siacme\Dominio\Pacientes\Religion;

/**
 * Class PacientesRepositorioMySQL
 * @package Siacme\Infraestructura\Pacientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class PacientesRepositorioLaravelMySQL
{
	/**
	 * @param \Siacme\Dominio\Pacientes\Paciente $paciente
	 * @return bool
	 */
	public function obtenerPacientePorId(Paciente $paciente)
	{
		try {
			$pacientes = DB::table('paciente')
				->join('estado_civil', 'estado_civil.idEstadoCivil', '=', 'paciente.idEstadoCivil')
				->join('religion', 'religion.idReligion', '=', 'paciente.idReligion')
				->join('escolaridad', 'escolaridad.idEscolaridad', '=', 'paciente.idEscolaridad')
				->join('institucion_medica', 'institucion_medica.idInstitucionMedica', '=', 'paciente.idInstitucionMedica')
				->where('paciente.idPaciente', $paciente->getId())
				->first();

			$totalPacientes = count($pacientes);

			if($totalPacientes > 0) {
				// setear datos
				$this->alimentar($paciente, $pacientes);

				return true;
			}

			return false;


		} catch (\Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}

	/**
	 * guardar en la base de datos
	 * @param Paciente $paciente
	 * @return bool
	 */
	public function persistir(Paciente $paciente)
	{
		try {
			if(is_null($paciente->getId())) {
				// insertar
				$idPaciente = DB::table('paciente')
					->insertGetId([
						'Nombre'        => $paciente->getNombre(),
						'Paterno'       => $paciente->getPaterno(),
						'Materno'       => $paciente->getMaterno(),
						'Telefono'      => $paciente->getTelefono(),
						'Celular'       => $paciente->getCelular(),
						'Email'         => $paciente->getEmail(),
						'FechaCreacion' => date('Y-m-d'),
					]);

				$paciente->setId($idPaciente);

			} else {
				// actualizar
				$update = DB::table('paciente')
					->where('idPaciente', $paciente->getId())
					->update([
						'Nombre'                      => $paciente->getNombre(),
						'Paterno'                     => $paciente->getPaterno(),
						'Materno'                     => $paciente->getMaterno(),
						'Telefono'                    => $paciente->getTelefono(),
						'Celular'                     => $paciente->getCelular(),
						'Email'                       => $paciente->getEmail(),
						'Direccion'                   => $paciente->getDireccion(),
						'CP'                          => $paciente->getCp(),
						'Municipio'                   => $paciente->getMunicipio(),
						'FechaNacimiento'             => $paciente->getFechaNacimiento(),
						'Edad'                        => $paciente->getEdadAnios(),
						'LugarNacimiento'             => $paciente->getLugarNacimiento(),
						'NombrePediatra'              => $paciente->getNombrePediatra(),
						'NombreQuienRecomienda'       => $paciente->getNombreRecomienda(),
						'SeHaAutomedicado'            => $paciente->getSeHaAutomedicado(),
						'ConQue'                      => $paciente->getConQueSeHaAutomedicado(),
						'EsAlergico'                  => $paciente->getEsAlergico(),
						'ACual'                       => $paciente->getAQueMedicamentoEsAlergico(),
						'EstaVivaMadre'               => $paciente->getViveMadre(),
						'CausaMuerteMadre'            => $paciente->getCausaMuerteMadre(),
						'EnfermedadesPadeceMadre'     => $paciente->getEnfermedadesMadre(),
						'EstaVivoPadre'               => $paciente->getVivePadre(),
						'CausaMuertePadre'            => $paciente->getCausaMuertePadre(),
						'EnfermedadesPadecePadre'     => $paciente->getEnfermedadesPadre(),
						'NumHermanos'                 => $paciente->getNumHermanos(),
						'NumHermanosVivos'            => $paciente->getNumHermanosVivos(),
						'NumHermanosFinados'          => $paciente->getNumHermanosFinados(),
						'EnfermedadesPadecenHermanos' => $paciente->getEnfermedadesHermanos(),
						'EnfermedadesAbuelosPaternos' => $paciente->getEnfermedadesAbuelosPaternos(),
						'EnfermedadesAbuelosMaternos' => $paciente->getEnfermedadesAbuelosMaternos(),
						'SeLeHacenMoretones'          => $paciente->getSeLeHacenMoretones(),
						'HaRequeridoTransfusion'      => $paciente->getHaRequeridoTransfusion(),
						'HaTenidoFracturas'           => $paciente->getHaTenidoFracturas(),
						'EspecifiqueFracturas'        => $paciente->getEspecifiqueFracturas(),
						'HaSidoIntervenido'           => $paciente->getHaSidoIntervenido(),
						'EspecifiqueIntervencion'     => $paciente->getEspecifiqueIntervencion(),
						'HaSidoHospitalizado'         => $paciente->getHaSidoHospitalizado(),
						'EspecifiqueHospitalizacion'  => $paciente->getEspecifiqueHospitalizacion(),
						'EsExFumador'                 => $paciente->getExFumador(),
						'EsExAlcoholico'              => $paciente->getExAlcoholico(),
						'EsExAdicto'                  => $paciente->getExAdicto(),
						'EstaBajoTratamiento'         => $paciente->getEstaBajoTratamiento(),
						'EspecifiqueTratamiento'      => $paciente->getEspecifiqueTratamiento(),
						'FechaActualizacion'          => date('Y-m-d')
					]);

				// eliminar padecimientos
				DB::table('paciente_padecimiento')
					->where('idPaciente', '=', $paciente->getId())
					->delete();
			}

			// guardar padecimientos
			if(!is_null($paciente->getListaPadecimientos())) {

				foreach ($paciente->getListaPadecimientos() as $padecimiento) {
					DB::table('paciente_padecimiento')
						->insert([
							'idPaciente'     => $paciente->getId(),
							'idPadecimiento' => $padecimiento->getId(),
							'FechaActualizacion' => date('Y-m-d')
						]);
				}
			}

			return true;
		} catch(\PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}

	/**
	 * @param \Siacme\Dominio\Pacientes\Paciente $paciente
	 * @param                                    $pacientes
	 * @return void
	 */
	private function alimentar(Paciente $paciente, $pacientes)
	{
		$paciente->setEstadoCivil(new EstadoCivil($pacientes->idEstadoCivil, $pacientes->EstadoCivil));
		$paciente->setReligion(new Religion($pacientes->idReligion, $pacientes->Religion));
		$paciente->setEscolaridad(new Escolaridad($pacientes->idEscolaridad, $pacientes->Escolaridad));
		$paciente->setInstitucionMedica(new InstitucionMedica($pacientes->idInstitucionMedica, $pacientes->InstitucionMedica));

		$paciente->revisaFoto();

		$paciente->setNombre($pacientes->Nombre);
		$paciente->setPaterno($pacientes->Paterno);
		$paciente->setMaterno($pacientes->Materno);
		$paciente->setTelefono($pacientes->Telefono);
		$paciente->setCelular($pacientes->Celular);
		$paciente->setEmail($pacientes->Email);
		$paciente->setDireccion($pacientes->Direccion);
		$paciente->setCp($pacientes->CP);
		$paciente->setMunicipio($pacientes->Municipio);
		$paciente->setFechaNacimiento($pacientes->FechaNacimiento);
		$paciente->setEdadAnios($pacientes->Edad);
		$paciente->setLugarNacimiento($pacientes->LugarNacimiento);
		$paciente->setNombrePediatra($pacientes->NombrePediatra);
		$paciente->setNombreRecomienda($pacientes->NombreQuienRecomienda);
		$paciente->setSeHaAutomedicado($pacientes->SeHaAutomedicado);
		$paciente->setConQueSeHaAutomedicado($pacientes->ConQue);
		$paciente->setEsAlergico($pacientes->EsAlergico);
		$paciente->setAQueMedicamentoEsAlergico($pacientes->ACual);
		$paciente->setViveMadre($pacientes->EstaVivaMadre);
		$paciente->setCausaMuerteMadre($pacientes->CausaMuerteMadre);
		$paciente->setEnfermedadesMadre($pacientes->EnfermedadesPadeceMadre);
		$paciente->setVivePadre($pacientes->EstaVivoPadre);
		$paciente->setCausaMuertePadre($pacientes->CausaMuertePadre);
		$paciente->setEnfermedadesPadre($pacientes->EnfermedadesPadecePadre);
		$paciente->setNumHermanos($pacientes->NumHermanos);
		$paciente->setNumHermanosVivos($pacientes->NumHermanosVivos);
		$paciente->setCausaMuerteHermanos($pacientes->CausaMuerteHermanos);
		$paciente->setEnfermedadesHermanos($pacientes->EnfermedadesPadecenHermanos);
		$paciente->setEnfermedadesAbuelosPaternos($pacientes->EnfermedadesAbuelosPaternos);
		$paciente->setEnfermedadesAbuelosMaternos($pacientes->EnfermedadesAbuelosMaternos);
		$paciente->setSeLeHacenMoretones($pacientes->SeLeHacenMoretones);
		$paciente->setHaRequeridoTransfusion($pacientes->HaRequeridoTransfusion);
		$paciente->setHaTenidoFracturas($pacientes->HaTenidoFracturas);
		$paciente->setEspecifiqueFracturas($pacientes->EspecifiqueFracturas);
		$paciente->setHaSidoIntervenido($pacientes->HaSidoIntervenido);
		$paciente->setEspecifiqueIntervencion($pacientes->EspecifiqueIntervencion);
		$paciente->setHaSidoHospitalizado($pacientes->HaSidoHospitalizado);
		$paciente->setEspecifiqueHospitalizacion($pacientes->EspecifiqueHospitalizacion);
		$paciente->setExFumador($pacientes->EsExFumador);
		$paciente->setExAdicto($pacientes->EsExAdicto);
		$paciente->setExAlcoholico($pacientes->EsExAlcoholico);
		$paciente->setEstaBajoTratamiento($pacientes->EstaBajoTratamiento);
		$paciente->setEspecifiqueTratamiento($pacientes->EspecifiqueTratamiento);
		$paciente->setNombreRepresentante($pacientes->NombreRepresentante);
		$paciente->setNombreTutor($pacientes->NombreTutor);
		$paciente->setOcupacionTutor($pacientes->OcupacionTutor);
		$paciente->setMotivoConsulta($pacientes->MotivoConsulta);
		$paciente->setHistoriaEnfermedad($pacientes->HistoriaEnfermedad);
		$paciente->setPadecimientoActual($pacientes->PadecimientoActual);
	}
}