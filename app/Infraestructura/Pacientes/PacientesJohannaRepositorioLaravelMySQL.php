<?php
namespace Siacme\Infraestructura\Pacientes;

use DB;
use Siacme\Dominio\Pacientes\ATM;
use Siacme\Dominio\Pacientes\ComportamientoFrankl;
use Siacme\Dominio\Pacientes\ComportamientoInicial;
use Siacme\Dominio\Pacientes\ConvexividadFacial;
use Siacme\Dominio\Pacientes\MarcaPasta;
use Siacme\Dominio\Pacientes\MorfologiaCraneofacial;
use Siacme\Dominio\Pacientes\MorfologiaFacial;
use Siacme\Dominio\Pacientes\Paciente;
use Siacme\Dominio\Pacientes\PacienteJohanna;
use Siacme\Dominio\Pacientes\TrastornoLenguaje;

/**
 * Class PacientesRepositorioMySQL
 * @package Siacme\Infraestructura\Pacientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class PacientesJohannaRepositorioLaravelMySQL implements PacientesRepositorioInterface
{
	/**
	 * @var PacientesRepositorioLaravelMySQL
	 */
	private $repositorio;

	public function __construct(PacientesRepositorioLaravelMySQL $repositorio)
	{
		$this->repositorio = $repositorio;
	}

	/**
	 * comentario heredado
	 * @param  string $nombres
	 * @return array
	 */
	public function obtenerPacientesPorNombre($nombres)
	{
		try {
			$listaPacientes = array();

			// quitar espacios en blanco
			$nombres = str_replace(' ', '', $nombres);

			$pacientes = DB::table('paciente')
							->select('idPaciente', 'Nombre', 'Paterno', 'Materno', 'Telefono', 'Celular', 'Email')
							->where(DB::raw("REPLACE(CONCAT(Nombre, Paterno, Materno), ' ', '')"), 'LIKE', "%$nombres%")
							->orWhere(DB::raw("REPLACE(CONCAT(Paterno, Materno, Nombre), ' ', '')"), 'LIKE', "%$nombres%")
							->orWhere('Telefono', 'LIKE', "%$nombres%")
							->orWhere('Celular', 'LIKE', "%$nombres%")
							->orWhere('Email', 'LIKE', "%$nombres%")
							->get();

			$totalPacientes = count($pacientes);

			if($totalPacientes > 0) {
				foreach ($pacientes as $pacienteActual) {
					// crear paciente
					$paciente = new PacienteJohanna($pacienteActual->idPaciente);
					$this->repositorio->obtenerPacientePorId($paciente);

					$listaPacientes[] = $paciente;
				}

				// devolver lista de Pacientes
				return $listaPacientes;
			}

			return null;


		} catch (\Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}

	/**
	 * obtener una lista de pacientes
	 * @param  int $id
	 * @return array
	 */
	public function obtenerPacientePorId($id)
	{
		try {
			$pacientes = DB::table('paciente_johanna')
				->join('marca_pasta', 'marca_pasta.idMarcaPasta', '=', 'paciente_johanna.idMarcaPasta')
				->join('comportamiento_inicial', 'comportamiento_inicial.idComportamientoInicial', '=', 'paciente_johanna.idComportamientoInicial')
				->join('comportamiento_frankl', 'comportamiento_frankl.idComportamientoFrankl', '=', 'paciente_johanna.idComportamientoFrankl')
				->join('trastorno_lenguaje', 'trastorno_lenguaje.idTrastornoLenguaje', '=', 'paciente_johanna.idTrastornoLenguaje')
				->join('morfologia_craneofacial', 'morfologia_craneofacial.idMorfologiaCraneofacial', '=', 'paciente_johanna.idMorfologiaCraneofacial')
				->join('morfologia_facial', 'morfologia_facial.idMorfologiaFacial', '=', 'paciente_johanna.idMorfologiaFacial')
				->join('convexividad_facial', 'convexividad_facial.idConvexividadFacial', '=', 'paciente_johanna.idConvexividadFacial')
				->join('atm', 'atm.idATM', '=', 'paciente_johanna.idATM')
				->where('paciente_johanna.idPaciente', $id)
				->first();

			$totalPacientes = count($pacientes);

			if($totalPacientes > 0) {
				$paciente = new PacienteJohanna($pacientes->idPaciente);
				// obtener datos específicos
				$this->alimentar($paciente, $pacientes);
			} else {
				$paciente = new PacienteJohanna($id);
			}

			// cargar datos básicos
			$this->repositorio->obtenerPacientePorId($paciente);

			// devolver paciente
			return $paciente;


		} catch (\Exception $e) {
			echo $e->getMessage();
			return null;
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
				// insertar por primera vez
				// devuelve el objeto con Id
				$this->repositorio->persistir($paciente);
				return true;
			}

			// actualizar
			$this->repositorio->persistir($paciente);

			if($this->existeEnTablaComplementaria($paciente)) {
				// update
				DB::table('paciente_johanna')
					->where('idPaciente', '=', $paciente->getId())
					->update([
						'idMarcaPasta'               => $paciente->getMarcaPasta()->getId(),
						'idComportamientoInicial'    => $paciente->getComportamientoInicial()->getId(),
						'idComportamientoFrankl'     => $paciente->getComportamientoFrankl()->getId(),
						'idTrastornoLenguaje'        => $paciente->getTrastornoLenguaje()->getId(),
						'idMorfologiaCraneofacial'   => $paciente->getMorfologiaCraneofacial()->getId(),
						'idMorfologiaFacial'         => $paciente->getMorfologiaFacial()->getId(),
						'idConvexividadFacial'       => $paciente->getConvexividadFacial()->getId(),
						'idATM'                      => $paciente->getATM()->getId(),
						'NombrePadre'                => $paciente->getNombrePadre(),
						'NombreMadre'                => $paciente->getNombreMadre(),
						'OcupacionPadre'             => $paciente->getOcupacionPadre(),
						'OcupacionMadre'             => $paciente->getOcupacionMadre(),
						'NombreEdadesHermanos'       => $paciente->getNombreEdadesHermanos(),
						'HaPresentadoDolorBoca'      => $paciente->getHaPresentadoDolorBoca(),
						'PresentaMalOlorBoca'        => $paciente->getPresentaMalOlorBoca(),
						'HaNotadoSangradoEncias'     => $paciente->getHaNotadoSangradoEncias(),
						'SienteDienteFlojo'          => $paciente->getSienteDienteFlojo(),
						'idTrastornoLenguaje'        => $paciente->getTrastornoLenguaje()->getId(),
						'PrimeraVisitaDentista'      => $paciente->getPrimeraVisitaDentista(),
						'FechaUltimoExamenBucal'     => $paciente->getFechaUltimoExamenBucal(),
						'MotivoVisitaDentista'       => $paciente->getMotivoVisitaDentista(),
						'LeHanColocadoAnestesico'    => $paciente->getLeHanColocadoAnestesico(),
						'TuvoMalaReaccionAnestesico' => $paciente->getTuvoMalaReaccionAnestesico(),
						'ReaccionAnestesico'         => $paciente->getReaccionAnestesico(),
						'TraumatismoBucal'           => $paciente->getTraumatismoBucal(),
						'TipoCepilloAdulto'			 => $paciente->getTipoCepilloAdulto(),
						'EdadErupcionoPrimerDiente'  => $paciente->getEdadErupcionoPrimerDiente(),
						'VecesCepillaDiente'		 => $paciente->getVecesCepillaDiente(),
						'AlguienAyudaACepillarse'	 => $paciente->getAlguienAyudaACepillarse(),
						'VecesComeDia'				 => $paciente->getVecesComeDia(),
						'HiloDental'				 => $paciente->getHiloDental(),
						'EnjuagueBucal'				 => $paciente->getEnjuagueBucal(),
						'LimpiadorLingual'			 => $paciente->getLimpiadorLingual(),
						'TabletasReveladoras'		 => $paciente->getTabletasReveladoras(),
						'OtroAuxiliar'				 => $paciente->getOtroAuxiliar(),
						'EspecifiqueAuxiliar' 		 => $paciente->getEspecifiqueAuxiliar(),
						'SuccionDigital'			 => $paciente->getSuccionDigital(),
						'SuccionLingual'			 => $paciente->getSuccionLingual(),
						'Biberon'					 => $paciente->getBiberon(),
						'Bruxismo'					 => $paciente->getBruxismo(),
						'SuccionLabial'				 => $paciente->getSuccionLabial(),
						'RespiracionBucal'			 => $paciente->getRespiracionBucal(),
						'Onicofagia'				 => $paciente->getOnicofagia(),
						'Chupon'					 => $paciente->getChupon(),
						'OtroHabito'				 => $paciente->getOtroHabito(),
						'DescripcionHabito' 		 => $paciente->getDescripcionHabito(),
						'FechaActualizacion'         => date('Y-m-d')
					]);
			} else {
				// insert
				DB::table('paciente_johanna')
					->insert([
						'idPaciente'                 => $paciente->getId(),
						'idMarcaPasta'               => $paciente->getMarcaPasta()->getId(),
						'idComportamientoInicial'    => $paciente->getComportamientoInicial()->getId(),
						'idComportamientoFrankl'     => $paciente->getComportamientoFrankl()->getId(),
						'idTrastornoLenguaje'        => $paciente->getTrastornoLenguaje()->getId(),
						'idMorfologiaCraneofacial'   => $paciente->getMorfologiaCraneofacial()->getId(),
						'idMorfologiaFacial'         => $paciente->getMorfologiaFacial()->getId(),
						'idConvexividadFacial'       => $paciente->getConvexividadFacial()->getId(),
						'idATM'                      => $paciente->getATM()->getId(),
						'NombrePadre'                => $paciente->getNombrePadre(),
						'NombreMadre'                => $paciente->getNombreMadre(),
						'OcupacionPadre'             => $paciente->getOcupacionPadre(),
						'OcupacionMadre'             => $paciente->getOcupacionMadre(),
						'NombreEdadesHermanos'       => $paciente->getNombreEdadesHermanos(),
						'HaPresentadoDolorBoca'      => $paciente->getHaPresentadoDolorBoca(),
						'PresentaMalOlorBoca'        => $paciente->getPresentaMalOlorBoca(),
						'HaNotadoSangradoEncias'     => $paciente->getHaNotadoSangradoEncias(),
						'SienteDienteFlojo'          => $paciente->getSienteDienteFlojo(),
						'idTrastornoLenguaje'        => $paciente->getTrastornoLenguaje()->getId(),
						'PrimeraVisitaDentista'      => $paciente->getPrimeraVisitaDentista(),
						'FechaUltimoExamenBucal'     => $paciente->getFechaUltimoExamenBucal(),
						'MotivoVisitaDentista'       => $paciente->getMotivoVisitaDentista(),
						'LeHanColocadoAnestesico'    => $paciente->getLeHanColocadoAnestesico(),
						'TuvoMalaReaccionAnestesico' => $paciente->getTuvoMalaReaccionAnestesico(),
						'ReaccionAnestesico'         => $paciente->getReaccionAnestesico(),
						'TraumatismoBucal'           => $paciente->getTraumatismoBucal(),
						'TipoCepilloAdulto'			 => $paciente->getTipoCepilloAdulto(),
						'EdadErupcionoPrimerDiente'  => $paciente->getEdadErupcionoPrimerDiente(),
						'VecesCepillaDiente'		 => $paciente->getVecesCepillaDiente(),
						'AlguienAyudaACepillarse'	 => $paciente->getAlguienAyudaACepillarse(),
						'VecesComeDia'				 => $paciente->getVecesComeDia(),
						'HiloDental'				 => $paciente->getHiloDental(),
						'EnjuagueBucal'				 => $paciente->getEnjuagueBucal(),
						'LimpiadorLingual'			 => $paciente->getLimpiadorLingual(),
						'TabletasReveladoras'		 => $paciente->getTabletasReveladoras(),
						'OtroAuxiliar'				 => $paciente->getOtroAuxiliar(),
						'EspecifiqueAuxiliar' 		 => $paciente->getEspecifiqueAuxiliar(),
						'SuccionDigital'			 => $paciente->getSuccionDigital(),
						'SuccionLingual'			 => $paciente->getSuccionLingual(),
						'Biberon'					 => $paciente->getBiberon(),
						'Bruxismo'					 => $paciente->getBruxismo(),
						'SuccionLabial'				 => $paciente->getSuccionLabial(),
						'RespiracionBucal'			 => $paciente->getRespiracionBucal(),
						'Onicofagia'				 => $paciente->getOnicofagia(),
						'Chupon'					 => $paciente->getChupon(),
						'OtroHabito'				 => $paciente->getOtroHabito(),
						'DescripcionHabito' 		 => $paciente->getDescripcionHabito(),
						'FechaCreacion'              => date('Y-m-d'),
						'FechaActualizacion'         => date('Y-m-d')
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
	 * @return bool
	 */
	private function existeEnTablaComplementaria(Paciente $paciente)
	{
		$pacientes = DB::table('paciente_johanna')
			->select('idPaciente')
			->where('idPaciente', $paciente->getId())
			->first();

		$totalPacientes = count($pacientes);

		if($totalPacientes === 0) {
			return false;
		}

		return true;
	}


	/**
	 * @param PacienteJohanna $paciente
	 * @param $pacientes
	 */
	private function alimentar(PacienteJohanna $paciente, $pacientes)
	{
		$paciente->setMarcaPasta(new MarcaPasta($pacientes->idMarcaPasta, $pacientes->MarcaPasta));
		$paciente->setComportamientoInicial(new ComportamientoInicial($pacientes->idComportamientoInicial, $pacientes->ComportamientoInicial));
		$paciente->setComportamientoFrankl(new ComportamientoFrankl($pacientes->idComportamientoFrankl, $pacientes->ComportamientoFrankl));
		$paciente->setTrastornoLenguaje(new TrastornoLenguaje($pacientes->idTrastornoLenguaje, $pacientes->TrastornoLenguaje));
		$paciente->setMorfologiaCraneofacial(new MorfologiaCraneofacial($pacientes->idMorfologiaCraneofacial, $pacientes->MorfologiaCraneofacial));
		$paciente->setMorfologiaFacial(new MorfologiaFacial($pacientes->idMorfologiaFacial, $pacientes->MorfologiaFacial));
		$paciente->setConvexividadFacial(new ConvexividadFacial($pacientes->idConvexividadFacial, $pacientes->ConvexividadFacial));
		$paciente->setAtm(new ATM($pacientes->idATM, $pacientes->ATM));

		$paciente->setNombrePadre($pacientes->NombrePadre);
		$paciente->setNombreMadre($pacientes->NombreMadre);
		$paciente->setOcupacionPadre($pacientes->OcupacionPadre);
		$paciente->setOcupacionMadre($pacientes->OcupacionMadre);
		$paciente->setNombreEdadesHermanos($pacientes->NombreEdadesHermanos);
		$paciente->setHaPresentadoDolorBoca($pacientes->HaPresentadoDolorBoca);
		$paciente->setPresentaMalOlorBoca($pacientes->PresentaMalOlorBoca);
		$paciente->setHaNotadoSangradoEncias($pacientes->HaNotadoSangradoEncias);
		$paciente->setSienteDienteFlojo($pacientes->SienteDienteFlojo);
		$paciente->setPrimeraVisitaDentista($pacientes->PrimeraVisitaDentista);
		$paciente->setFechaUltimoExamenBucal($pacientes->FechaUltimoExamenBucal);
		$paciente->setMotivoVisitaDentista($pacientes->MotivoVisitaDentista);
		$paciente->setLeHanColocadoAnestesico($pacientes->LeHanColocadoAnestesico);
		$paciente->setTuvoMalaReaccionAnestesico($pacientes->TuvoMalaReaccionAnestesico);
		$paciente->setReaccionAnestesico($pacientes->ReaccionAnestesico);
		$paciente->setTraumatismoBucal($pacientes->TraumatismoBucal);
		$paciente->setTipoCepilloAdulto($pacientes->TipoCepilloAdulto);
		$paciente->setEdadErupcionoPrimerDiente($pacientes->EdadErupcionoPrimerDiente);
		$paciente->setVecesCepillaDiente($pacientes->VecesCepillaDiente);
		$paciente->setAlguienAyudaACepillarse($pacientes->AlguienAyudaACepillarse);
		$paciente->setVecesComeDia($pacientes->VecesComeDia);
		$paciente->setHiloDental($pacientes->HiloDental);
		$paciente->setEnjuagueBucal($pacientes->EnjuagueBucal);
		$paciente->setLimpiadorLingual($pacientes->LimpiadorLingual);
		$paciente->setTabletasReveladoras($pacientes->TabletasReveladoras);
		$paciente->setOtroAuxiliar($pacientes->OtroAuxiliar);
		$paciente->setEspecifiqueAuxiliar($pacientes->EspecifiqueAuxiliar);
		$paciente->setSuccionDigital($pacientes->SuccionDigital);
		$paciente->setSuccionLingual($pacientes->SuccionLingual);
		$paciente->setBiberon($pacientes->Biberon);
		$paciente->setBruxismo($pacientes->Bruxismo);
		$paciente->setSuccionLabial($pacientes->SuccionLabial);
		$paciente->setRespiracionBucal($pacientes->RespiracionBucal);
		$paciente->setOnicofagia($pacientes->Onicofagia);
		$paciente->setChupon($pacientes->Chupon);
		$paciente->setOtroHabito($pacientes->OtroHabito);
		$paciente->setDescripcionHabito($pacientes->DescripcionHabito);
	}

	/**
	 * actualizar datos faltantes
	 * @param Paciente $paciente
	 * @return bool
	 */
	public function completarDatos(Paciente $paciente)
	{
		try {
			$operacion = DB::table('paciente_johanna')
				->where('idPaciente', $paciente->getId())
				->update([
					'Labios'                        => $paciente->getLabios(),
					'Carrillos'                     => $paciente->getCarrillos(),
					'Frenillos'                     => $paciente->getFrenillos(),
					'Paladar'                       => $paciente->getPaladar(),
					'Lengua'                        => $paciente->getLengua(),
					'PisoDeBoca'                    => $paciente->getPisoDeBoca(),
					'Parodonto'                     => $paciente->getParodonto(),
					'Uvula'                         => $paciente->getUvula(),
					'Amigdalas'                     => $paciente->getAmigdalas(),
					'MordidaBordeBorde'             => $paciente->getMordidaBordeBorde() ? 1 : 0,
					'MedidaMordidaBordeBorde'       => $paciente->getMedidaBordeBorde(),
					'SobremordidaVertical'          => $paciente->getSobremordidaVertical() ? 1 : 0,
					'MedidaSobremordidaVertical'    => $paciente->getMedidaSobremordidaVertical(),
					'SobremordidaHorizontal'        => $paciente->getSobremordidaHorizontal() ? 1 : 0,
					'MedidaSobremordidaHorizontal'  => $paciente->getMedidaSobremordidaHorizontal(),
					'MordidaAbiertaAnterior'        => $paciente->getMordidaAbiertaAnterior() ? 1 : 0,
					'MedidaMordidaAbiertaAnterior'  => $paciente->getMedidaMordidaAbiertaAnterior(),
					'MordidaCruzadaAnterior'        => $paciente->getMordidaCruzadaAnterior() ? 1 : 0,
					'MedidaMordidaCruzadaAnterior'  => $paciente->getMedidaMordidaCruzadaAnterior(),
					'MordidaCruzadaPosterior'       => $paciente->getMordidaCruzadaPosterior() ? 1 : 0,
					'MedidaMordidaCruzadaPosterior' => $paciente->getMedidaMordidaCruzadaPosterior(),
					'LineaMediaDental'              => $paciente->getLineaMediaDental() ? 1 : 0,
					'MedidaLineaMediaDental'        => $paciente->getMedidaLineaMediaDental(),
					'LineaMediaEsqueletica'         => $paciente->getLineaMediaEsqueletica() ? 1 : 0,
					'MedidaLineaMediaEsqueletica'   => $paciente->getMedidaLineaMediaEsqueletica(),
					'AlteracionesTamanio'           => $paciente->getAlteracionesTamanio() ? 1 : 0,
					'MedidaAlteracionesTamanio'     => $paciente->getMedidaAlteracionesTamanio(),
					'AlteracionesForma'             => $paciente->getAlteracionesForma() ? 1 : 0,
					'MedidaAlteracionesForma'       => $paciente->getMedidaAlteracionesForma(),
					'AlteracionesNumero'            => $paciente->getAlteracionesNumero() ? 1 : 0,
					'MedidaAlteracionesNumero'      => $paciente->getMedidaAlteracionesNumero(),
					'AlteracionesEstructura'        => $paciente->getAlteracionesEstructura() ? 1 : 0,
					'MedidaAlteracionesEstructura'  => $paciente->getMedidaAlteracionesEstructura(),
					'AlteracionesTextura'           => $paciente->getAlteracionesTextura() ? 1 : 0,
					'MedidaAlteracionesTextura'     => $paciente->getMedidaAlteracionesTextura(),
					'AlteracionesColor'             => $paciente->getAlteracionesColor() ? 1 : 0,
					'MedidaAlteracionesColor'       => $paciente->getMedidaAlteracionesColor(),
					'TipoArcoI'                     => $paciente->getTipoArcoI() ? 1 : 0,
					'EscalonMesialDerecho'          => $paciente->getEscalonMesialDerecho() ? 1 : 0,
					'EscalonMesialIzquierdo'        => $paciente->getEscalonMesialIzquierdo() ? 1 : 0,
					'EscalonDistalDerecho'          => $paciente->getEscalonDistalDerecho() ? 1 : 0,
					'EscalonDistalIzquierdo'        => $paciente->getEscalonDistalIzquierdo() ? 1 : 0,
					'EscalonRectoDerecho'           => $paciente->getEscalonRectoDerecho() ? 1 : 0,
					'EscalonRectoIzquierdo'         => $paciente->getEscalonRectoIzquierdo() ? 1 : 0,
					'MesialExageradoDerecho'        => $paciente->getMesialExageradoDerecho() ? 1 : 0,
					'MesialExageradoIzquierdo'      => $paciente->getMesialExageradoIzquierdo() ? 1 : 0,
					'NoDeterminadoDerecho'          => $paciente->getNoDeterminadoDerecho() ? 1 : 0,
					'NoDeterminadoIzquierdo'        => $paciente->getNoDeterminadoIzquierdo() ? 1 : 0,
					//'RelacionCaninaDerecha'         => $paciente->getRelacionCaninaDerecha() ? 1 : 0,
					//'RelacionCaninaIzquierda'       => $paciente->getRelacionCaninaIzquierda() ? 1 : 0,
					'RelacionMolarDerechaI'         => $paciente->getRelacionMolarDerechaI() ? 1 : 0,
					'RelacionMolarDerechaII'        => $paciente->getRelacionMolarDerechaII() ? 1 : 0,
					'RelacionMolarDerechaIII'       => $paciente->getRelacionMolarDerechaIII() ? 1 : 0,
					'RelacionMolarIzquierdaI'       => $paciente->getRelacionMolarIzquierdaI() ? 1 : 0,
					'RelacionMolarIzquierdaII'      => $paciente->getRelacionMolarIzquierdaII() ? 1 : 0,
					'RelacionMolarIzquierdaIII'     => $paciente->getRelacionMolarIzquierdaIII() ? 1 : 0,
					'RelacionCaninaDerechaI'        => $paciente->getRelacionCaninaDerechaI() ? 1 : 0,
					'RelacionCaninaDerechaII'       => $paciente->getRelacionCaninaDerechaII() ? 1 : 0,
					'RelacionCaninaDerechaIII'      => $paciente->getRelacionCaninaDerechaIII() ? 1 : 0,
					'RelacionCaninaIzquierdaI'      => $paciente->getRelacionCaninaIzquierdaI() ? 1 : 0,
					'RelacionCaninaIzquierdaII'     => $paciente->getRelacionCaninaIzquierdaII() ? 1 : 0,
					'RelacionCaninaIzquierdaIII'    => $paciente->getRelacionCaninaIzquierdaIII() ? 1 : 0,
					'FechaActualizacion'            => date('Y-m-d H:m:i')
				]);

			return true;
		} catch (\PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
}