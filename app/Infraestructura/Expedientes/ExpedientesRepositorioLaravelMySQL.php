<?php
namespace Siacme\Infraestructura\Expedientes;

use DB;
use Illuminate\Support\Collection;
use Siacme\Dominio\Consultas\Consulta;
use Siacme\Dominio\Consultas\DientePlan;
use Siacme\Dominio\Consultas\OtroTratamiento;
use Siacme\Dominio\Consultas\ExploracionFisica;
use Siacme\Dominio\Consultas\PlanTratamiento;
use Siacme\Dominio\Consultas\Receta;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Expedientes\TratamientoOdontologia;
use Siacme\Dominio\Expedientes\TratamientoOdontologiaTipo;
use Siacme\Dominio\Pacientes\ComportamientoFrankl;
use Siacme\Dominio\Pacientes\Diente;
use Siacme\Dominio\Pacientes\DientePadecimiento;
use Siacme\Dominio\Pacientes\DienteTratamiento;
use Siacme\Dominio\Pacientes\Paciente;
use Siacme\Dominio\Usuarios\Usuario;
use Siacme\Dominio\Usuarios\Especialidad;
use Siacme\Dominio\Interconsultas\Interconsulta;
use Siacme\Dominio\Interconsultas\MedicoReferencia;

/**
 * Class ExpedientesRepositorioLaravelMySQL
 * @package Siacme\Infraestructura\Expedientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class ExpedientesRepositorioLaravelMySQL implements ExpedientesRepositorioInterface
{
	/**
	 * @param Expediente $expediente
	 * @return bool
	 */
	public function persistir(Expediente $expediente)
	{
		try {
			if(is_null($expediente->getId())) {
				$idExpediente = DB::table('expediente')
					->insertGetId([
						'idPaciente'         => $expediente->getPaciente()->getId(),
						'UserMedico'         => $expediente->getMedico()->getUsername(),
						'PrimeraVez'         => $expediente->primeraVez() ? '1' : '0',
						'FechaCreacion'      => date('Y-m-d'),
						'FechaActualizacion' => date('Y-m-d')
					]);
				// obtener el Id
				$expediente->setId($idExpediente);
			} else {
				// editar
				DB::table('expediente')
					->where('idExpediente', '=', $expediente->getId())
					->update([
						'PrimeraVez'		 => $expediente->primeraVez() ? '1' : '0',
						'Firma'				 => $expediente->getFirma(),
						'FechaActualizacion' => date('Y-m-d')
					]);
			}

			return true;

		} catch(\PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}

	/**
	 * @param \Siacme\Dominio\Pacientes\Paciente $paciente
	 * @param \Siacme\Dominio\Usuarios\Usuario   $medico
	 * @return array
	 */
	public function obtenerExpedientePorPacienteMedico(Paciente $paciente, Usuario $medico)
	{
		try {
			$expedientes = DB::table('expediente')
				->where('idPaciente', $paciente->getId())
				->where('UserMedico', $medico->getUsername())
				->first();

			$totalExpedientes = count($expedientes);

			if($totalExpedientes > 0) {
				$expediente = new Expediente($expedientes->idExpediente);
				$expediente->setPaciente($paciente);
				$expediente->setMedico($medico);
				$expediente->setPrimeraVez($expedientes->PrimeraVez);
				$expediente->setFirma($expedientes->Firma);

				// buscar las interconsultas del expediente
				$interconsultas = DB::table('interconsulta')
					->join('medico_referencia', 'medico_referencia.idMedicoReferencia', '=', 'interconsulta.idMedicoReferencia')
					->join('especialidad', 'especialidad.idEspecialidad', '=', 'medico_referencia.idEspecialidad')
					->where('interconsulta.idExpediente', $expediente->getId())
					->orderBy('interconsulta.idInterconsulta', 'desc')
					->limit(50)
					->get();

				if (count($interconsultas) > 0) {

					foreach ($interconsultas as $interconsultas) {
						$interconsulta = new Interconsulta(
							$interconsultas->idInterconsulta,
							new MedicoReferencia(
								$interconsultas->idMedicoReferencia,
								$interconsultas->Direccion,
								new Especialidad(
									$interconsultas->idEspecialidad,
									$interconsultas->Especialidad
								)
							),
							$interconsultas->Referencia
						);

						$interconsulta->getMedico()->setNombre($interconsultas->Nombre);
						$interconsulta->getMedico()->setPaterno($interconsultas->Paterno);
						$interconsulta->getMedico()->setMaterno($interconsultas->Materno);

						$expediente->agregarInterconsulta($interconsulta);
					}
				}
				//===============================================================================
				// buscar las consultas del expediente
				$consultas = DB::table('consulta')
					->join('comportamiento_frankl', 'consulta.idComportamientoFrankl', '=', 'comportamiento_frankl.idComportamientoFrankl')
					->leftJoin('receta', 'receta.idReceta', '=', 'consulta.idReceta')
					->where('consulta.idExpediente', $expediente->getId())
					->orderBy('consulta.idConsulta', 'desc')
					->limit(50)
					->get();

				if (count($consultas) > 0) {
					foreach ( $consultas as $consultas ) {
						$consulta = new Consulta($consultas->idConsulta, $consultas->PadecimientoActual, $consultas->Interrogatorio, new ExploracionFisica($consultas->Peso, $consultas->Talla, $consultas->Pulso, $consultas->Temperatura, $consultas->TensionArterial), $consultas->Nota, new ComportamientoFrankl($consultas->idComportamientoFrankl), $consultas->Costo, $consultas->Fecha);

						if (!is_null($consultas->idReceta)) {
							$consulta->setReceta(new Receta($consultas->idReceta, $consultas->Receta));
						}
						
						$expediente->agregarConsulta($consulta);
					}
				}

				//===============================================================================
				// buscar los planes de tratamiento
				$planes = DB::table('plan_tratamiento')
					->where('idExpediente', $expediente->getId())
					->orderBy('idPlanTratamiento', 'desc')
					->limit(50)
					->get();

				if (count($planes) > 0) {
					// buscar la lista de dientes
					$dientes = DB::table('diente')
						->orderBy('Numero')
						->get();

					foreach ( $planes as $planes ) {
						$plan         = new PlanTratamiento(!$planes->Activo);
						$listaDientes = new Collection();
						$plan->setId($planes->idPlanTratamiento);

						foreach ( $dientes as $dientes ) {
							$dienteActual = new Diente($dientes->Numero);

							// padecimientos dentales
							$dientesPadecimientos = DB::table('diente_diente_padecimiento')
								->join('diente_padecimiento', 'diente_padecimiento.idDientePadecimiento', '=', 'diente_diente_padecimiento.idDientePadecimiento')
								->where('diente_diente_padecimiento.idPlanTratamiento', $planes->idPlanTratamiento)
								->where('diente_diente_padecimiento.Numero', $dientes->Numero)
								->get();

							foreach ( $dientesPadecimientos as $dientesPadecimientos ) {
								$padecimiento = new DientePadecimiento($dientesPadecimientos->idDientePadecimiento, $dientesPadecimientos->DientePadecimiento, $dientesPadecimientos->RutaImagen);
								$dienteActual->agregarPadecimiento($padecimiento);
							}

							//===============================================================================
							// tratamientos dentales
							$dientesTratamientos = DB::table('diente_diente_tratamiento')
								->leftJoin('diente_tratamiento', 'diente_tratamiento.idDienteTratamiento', '=', 'diente_diente_tratamiento.idDienteTratamiento')
								->where('diente_diente_tratamiento.idPlanTratamiento', $planes->idPlanTratamiento)
								->where('diente_diente_tratamiento.Numero', $dientes->Numero)
								->get();

							if (count($dientesTratamientos) > 0) {
								$index = 1;
								foreach ( $dientesTratamientos as $dientesTratamientos ) { 
									$tratamiento = new DientePlan(new DienteTratamiento((int)$dientesTratamientos->idDienteTratamiento, $dientesTratamientos->DienteTratamiento, $dientesTratamientos->Costo), $dientesTratamientos->Atendido === 1 ? true : false);
									$dienteActual->agregarTratamiento((string)$index, $tratamiento);
									$index++;
								}
							} else {

							}
							//if($dientes->Numero === 18) { dd($dienteActual); }
							$listaDientes->push($dienteActual);
						}

						// otros tratamientos
						$otrosTratamientos = DB::table('plan_tratamiento_otros')
							->join('plan_otro_tratamiento', 'plan_otro_tratamiento.idOtroTratamiento', '=', 'plan_tratamiento_otros.idOtroTratamiento')
							->where('plan_tratamiento_otros.idPlanTratamiento', $plan->getId())
							->get();

						if (count($otrosTratamientos) > 0) {
							foreach ($otrosTratamientos as $otrosTratamientos) {
								$otroTratamiento = new OtroTratamiento($otrosTratamientos->idOtroTratamiento, $otrosTratamientos->OtroTratamiento, $otrosTratamientos->Costo);

								$plan->agregarOtroTratamiento($otroTratamiento->getId(), $otroTratamiento);
							}
						}

						$plan->setCosto($planes->Costo);
						$plan->setListaDientes($listaDientes);
						$expediente->agregarPlanTratamiento($plan);
					}
				}

				// tratamientos ortopedia ortodoncia
				$otrosTratamientos = DB::table('tratamiento_ortopedia_ortodoncia')
					->where('idExpediente', $expediente->getId())
					->get();

				if (count($otrosTratamientos) > 0) {
					foreach ($otrosTratamientos as $otroTratamiento) {
						$tratamientoOdontologia = new TratamientoOdontologia($otroTratamiento->id, $otroTratamiento->Dx, $otroTratamiento->Costo, $otroTratamiento->Duracion, $otroTratamiento->Mensualidades);

						// obtener el detalle de tratamientos
						$otrosTratamientosDetalle = DB::table('tratamiento_ortopedia_ortodoncia_detalle')
							->where('id', $tratamientoOdontologia->getId())
							->get();

						if (count($otrosTratamientosDetalle) > 0) {
							foreach ($otrosTratamientosDetalle as $otroTratamientoDetalle) {
								$tratamientoOdontologiaTipo = new TratamientoOdontologiaTipo($otroTratamientoDetalle->Tipo);
								$tratamientoOdontologia->getListaTratamientos()->push($tratamientoOdontologiaTipo);
							}
						}

						$expediente->agregarTratamientoOdontologia($tratamientoOdontologia);
					}
				}

				return $expediente;
			}

			return null;
		} catch(\PDOException $e) {
			return null;
		}
	}

	/**
	 * @param  int		  $idExpediente
	 * @return Expediente
	 */
	public function obtenerExpedientePorId($idExpediente)
	{
		try {
			$expedientes = DB::table('expediente')
				->where('expediente.idExpediente', $idExpediente)
				->first();

			$totalExpedientes = count($expedientes);

			if($totalExpedientes > 0) {
				$expediente = new Expediente($expedientes->idExpediente);
				$expediente->setPrimeraVez($expedientes->PrimeraVez);
				$expediente->setFirma($expedientes->Firma);

				// buscar las interconsultas del expediente
				$interconsultas = DB::table('interconsulta')
						->join('medico_referencia', 'medico_referencia.idMedicoReferencia', '=', 'interconsulta.idMedicoReferencia')
						->join('especialidad', 'especialidad.idEspecialidad', '=', 'medico_referencia.idEspecialidad')
						->where('interconsulta.idExpediente', $expediente->getId())
						->orderBy('interconsulta.idInterconsulta', 'desc')
						->limit(50)
						->get();

				if (count($interconsultas) > 0) {

					foreach ($interconsultas as $interconsultas) {
						$interconsulta = new Interconsulta(
								$interconsultas->idInterconsulta,
								new MedicoReferencia(
										$interconsultas->idMedicoReferencia,
										$interconsultas->Direccion,
										new Especialidad(
												$interconsultas->idEspecialidad,
												$interconsultas->Especialidad
										)
								),
								$interconsultas->Referencia
						);

						$interconsulta->getMedico()->setNombre($interconsultas->Nombre);
						$interconsulta->getMedico()->setPaterno($interconsultas->Paterno);
						$interconsulta->getMedico()->setMaterno($interconsultas->Materno);

						$expediente->agregarInterconsulta($interconsulta);
					}
				}
				//===============================================================================
				// buscar las consultas del expediente
				$consultas = DB::table('consulta')
						->join('comportamiento_frankl', 'consulta.idComportamientoFrankl', '=', 'comportamiento_frankl.idComportamientoFrankl')
						->leftJoin('receta', 'receta.idReceta', '=', 'consulta.idReceta')
						->where('consulta.idExpediente', $expediente->getId())
						->orderBy('consulta.idConsulta', 'desc')
						->limit(50)
						->get();

				if (count($consultas) > 0) {
					foreach ( $consultas as $consultas ) {
						$consulta = new Consulta($consultas->idConsulta, $consultas->PadecimientoActual, $consultas->Interrogatorio, new ExploracionFisica($consultas->Peso, $consultas->Talla, $consultas->Pulso, $consultas->Temperatura, $consultas->TensionArterial), $consultas->Nota, new ComportamientoFrankl($consultas->idComportamientoFrankl), $consultas->Costo, $consultas->Fecha);

						$consulta->setReceta(new Receta($consultas->idReceta, $consultas->Receta));
						$expediente->agregarConsulta($consulta);
					}
				}

				//===============================================================================
				// buscar los planes de tratamiento
				$planes = DB::table('plan_tratamiento')
						->where('idExpediente', $expediente->getId())
						->orderBy('idPlanTratamiento', 'desc')
						->limit(50)
						->get();

				if (count($planes) > 0) {
					// buscar la lista de dientes
					$dientes = DB::table('diente')
							->orderBy('Numero')
							->get();

					foreach ( $planes as $planes ) {
						$plan         = new PlanTratamiento(!$planes->Activo);
						$listaDientes = new Collection();
						$plan->setId($planes->idPlanTratamiento);

						foreach ( $dientes as $dientes ) {
							$dienteActual = new Diente($dientes->Numero);

							// padecimientos dentales
							$dientesPadecimientos = DB::table('diente_diente_padecimiento')
									->join('diente_padecimiento', 'diente_padecimiento.idDientePadecimiento', '=', 'diente_diente_padecimiento.idDientePadecimiento')
									->where('diente_diente_padecimiento.idPlanTratamiento', $planes->idPlanTratamiento)
									->where('diente_diente_padecimiento.Numero', $dientes->Numero)
									->get();

							foreach ( $dientesPadecimientos as $dientesPadecimientos ) {
								$padecimiento = new DientePadecimiento($dientesPadecimientos->idDientePadecimiento, $dientesPadecimientos->DientePadecimiento, $dientesPadecimientos->RutaImagen);
								$dienteActual->agregarPadecimiento($padecimiento);
							}

							//===============================================================================
							// tratamientos dentales
							$dientesTratamientos = DB::table('diente_diente_tratamiento')
									->leftJoin('diente_tratamiento', 'diente_tratamiento.idDienteTratamiento', '=', 'diente_diente_tratamiento.idDienteTratamiento')
									->where('diente_diente_tratamiento.idPlanTratamiento', $planes->idPlanTratamiento)
									->where('diente_diente_tratamiento.Numero', $dientes->Numero)
									->get();

							if (count($dientesTratamientos) > 0) {
								$index = 1;
								foreach ( $dientesTratamientos as $dientesTratamientos ) {
									$tratamiento = new DientePlan(new DienteTratamiento((int)$dientesTratamientos->idDienteTratamiento, $dientesTratamientos->DienteTratamiento, $dientesTratamientos->Costo), $dientesTratamientos->Atendido === 1 ? true : false);

									$dienteActual->agregarTratamiento((string)$index, $tratamiento);
									$index++;
								}
							} else {

							}
							//if($dientes->Numero === 18) { dd($dienteActual); }
							$listaDientes->push($dienteActual);
						}

						$plan->setCosto($planes->Costo);
						$plan->setListaDientes($listaDientes);

						$expediente->agregarPlanTratamiento($plan);
					}
				}

				return $expediente;
			}

		} catch (\PDOException $e) {
			echo $e->getMessage();
			return null;
		}
	}

	/**
	 * @param Expediente $expediente
	 * @return bool
	 */
	public function guardarElementosDeConsulta(Expediente $expediente)
	{
		try {
			// actualizar el expediente
			$operacion = DB::table('expediente')
				->where('idExpediente', $expediente->getId())
				->update([
					'PrimeraVez' 		 => 0,
					'FechaActualizacion' => date('Y-m-d H:m:i')
				]);

			// insertar nuevo odontograma
			foreach ($expediente->getListaOdontogramas() as $odontograma) {
				$idOdontograma = DB::table('odontograma')
					->insertGetId([
						'idExpediente'  => $expediente->getId(),
						'FechaCreacion' => date('Y-m-d H:m:i')
					]);

				$odontograma->setId($idOdontograma);

				// insertar la lista de dientes
				foreach ($odontograma->getListaDientes() as $diente) {

					$operacion = DB::table('odontograma_diente')
						->insert([
							'idOdontograma'     => $odontograma->getId(),
							'Numero'            => $diente->getNumero(),
							'FechaModificacion' => date('Y-m-d H:m:i')
						]);
				}
			}

			// insertar nuevo plan de tratamiento
			foreach ($expediente->getListaPlanesTratamiento() as $plan) {
				$idPlan = DB::table('plan_tratamiento')
					->insertGetId([
						'idExpediente'      => $expediente->getId(),
						'Activo'            => 1,
						'Costo'             => $plan->costo(),
						'FechaCreacion'     => date('Y-m-d H:m:i'),
						'FechaModificacion' => date('Y-m-d H:m:i')
					]);

				$plan->setId($idPlan);

				// insertar la lista de dientes y
				foreach ($plan->getListaDientes() as $diente) {
					// nuevo padecimiento por diente
					if (!is_null($diente->getListaPadecimientos())) {
						foreach ($diente->getListaPadecimientos() as $padecimiento) {
							$operacion = DB::table('diente_diente_padecimiento')
								->insert([
									'idPlanTratamiento'    => $plan->getId(),
									'Numero'			   => $diente->getNumero(),
									'idDientePadecimiento' => $padecimiento->getId(),
									'FechaModificacion'    => date('Y-m-d H:m:i')
								]);
						}
					}

					// nuevo tratamiento por diente
					if (!is_null($diente->getListaTratamientos())) {
						foreach ($diente->getListaTratamientos() as $tratamiento) {
							$operacion = DB::table('diente_diente_tratamiento')
								->insert([
									'idPlanTratamiento'   => $plan->getId(),
									'Numero'			  => $diente->getNumero(),
									'idDienteTratamiento' => $tratamiento->getDienteTratamiento()->getId(),
									'Atendido'            => $tratamiento->atendido(),
									'FechaModificacion'   => date('Y-m-d H:m:i')
								]);
						}
					}
				}

				// insertar otros tratamientos
				foreach ($plan->getListaOtrosTratamientos() as $otrosTratamientos) {
					$operacion = DB::table('plan_tratamiento_otros')
						->insert([
							'idPlanTratamiento' => $plan->getId(),
							'idOtroTratamiento' => $otrosTratamientos->getId(),
							'FechaModificacion' => date('Y-m-d H:m:i')
						]);
				}
			}

			return true;

		} catch(\PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}

	public function guardarInterconsulta(Expediente $expediente)
	{
		// insertar interconsulta
		foreach ($expediente->getListaInterconsultas() as $interconsulta) {
			$operacion = DB::table('interconsulta')
					->insertGetId([
							'idMedicoReferencia' => $interconsulta->getMedico()->getId(),
							'idExpediente'		 => $expediente->getId(),
							'Referencia'		 => $interconsulta->getReferencia(),
							'Respondida'		 => 0,
							'FechaModificacion'  => date('Y-m-d H:m:i')
					]);

			// setear id de la interconsulta
			$interconsulta->setId($operacion);
		}
	}
}