<?php
namespace Siacme\Dominio\Expedientes;

use Illuminate\Support\Collection;
use Siacme\Dominio\Consultas\Consulta;
use Siacme\Dominio\Consultas\PlanTratamiento;
use Siacme\Dominio\Interconsultas\Interconsulta;
use Siacme\Dominio\Pacientes\Anexo;
use Siacme\Dominio\Pacientes\Odontograma;
use Siacme\Dominio\Pacientes\Paciente;
use Siacme\Dominio\Usuarios\Usuario;

/**
 * Class Expediente
 * @package Siacme\Dominio\Expedientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class Expediente
{
	/**
	 * @var int
	 */
	protected $id;

	/**
	 * @var string
	 */
	protected $firma;

	/**
	 * @var bool
	 */
	protected $primeraVez;

	/**
	 * @var Paciente
	 */
	protected $paciente;

	/**
	 * @var Usuario
	 */
	protected $medico;

	/**
	 * @var Collection
	 */
	protected $listaInterconsultas;

	/**
	 * @var Collection
	 */
	protected $listaPlanesTratamiento;

	/**
	 * @var Collection
	 */
	protected $listaOdontogramas;

	/**
	 * @var Array
	 */
	protected $listaAnexos;

	/**
	 * @var Array
	 */
	protected $listaConsultas;

	/**
	 * @var Collection
	 */
	protected $listaTratamientoOdontologia;

	/**
	 * Expediente constructor.
	 * @param null $id
	 */
	public function __construct($id = null)
	{
		$this->id = $id;

		if (is_null($this->listaOdontogramas)) {
			$this->listaOdontogramas = new Collection();
		}

		if (is_null($this->listaPlanesTratamiento)) {
			$this->listaPlanesTratamiento = new Collection();
		}

		if (is_null($this->listaInterconsultas)) {
			$this->listaInterconsultas = new Collection();
		}

		if (is_null($this->listaConsultas)) {
			$this->listaConsultas = new Collection();
		}

		if (is_null($this->listaTratamientoOdontologia)) {
			$this->listaTratamientoOdontologia = new Collection();
		}
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getFirma()
	{
		return $this->firma;
	}

	/**
	 * @param string $firma
	 */
	public function setFirma($firma)
	{
		$this->firma = $firma;
	}

	/**
	 * @return boolean
	 */
	public function primeraVez()
	{
		return $this->primeraVez;
	}

	/**
	 * @param boolean $primeraVez
	 */
	public function setPrimeraVez($primeraVez)
	{
		$this->primeraVez = false;

		if (is_numeric($primeraVez)) {
			if ((int)$primeraVez === 1) {
				$this->primeraVez = true;
			}
		} else {
			$this->primeraVez = $primeraVez;
		}
	}

	/**
	 * @return Paciente
	 */
	public function getPaciente()
	{
		return $this->paciente;
	}

	/**
	 * @param Paciente $paciente
	 */
	public function setPaciente(Paciente $paciente)
	{
		$this->paciente = $paciente;
	}

	/**
	 * @return Usuario
	 */
	public function getMedico()
	{
		return $this->medico;
	}

	/**
	 * @param Usuario $medico
	 */
	public function setMedico(Usuario $medico)
	{
		$this->medico = $medico;
	}

	/**
	 * @return Collection
	 */
	public function getListaInterconsultas()
	{
		return $this->listaInterconsultas;
	}

	/**
	 * @param Collection $listaInterconsultas
	 */
	public function setListaInterconsultas($listaInterconsultas)
	{
		$this->listaInterconsultas = $listaInterconsultas;
	}

	/**
	 * @return Collection
	 */
	public function getListaPlanesTratamiento()
	{
		return $this->listaPlanesTratamiento;
	}

	/**
	 * @param Collection $listaPlanesTratamiento
	 */
	public function setListaPlanesTratamiento($listaPlanesTratamiento)
	{
		$this->listaPlanesTratamiento = $listaPlanesTratamiento;
	}

	/**
	 * @return Collection
	 */
	public function getListaOdontogramas()
	{
		return $this->listaOdontogramas;
	}

	/**
	 * @param Collection $listaOdontogramas
	 */
	public function setListaOdontogramas($listaOdontogramas)
	{
		$this->listaOdontogramas = $listaOdontogramas;
	}

	/**
	 * evalua la existencia del campo firma
	 * si es nulo, necesita firma devuelve true
	 * caso contrario, devuelve false
	 * @return bool
	 */
	public function necesitaFirma()
	{
		if(is_null($this->firma)) {
			return true;
		}

		return false;
	}

    /**
     * devuelve el número de expediente a 6 cifras
     * @return string
     */
    public function numeroExpediente()
    {
    	$longitudId = strlen((string)$this->id);
    	$aRellenar  = 6 - $longitudId;
    	$numero     = '';

    	for($i = 1; $i <= $aRellenar; $i++) {
    		$numero .= '0';
    	}

    	return $numero . (string)$this->id;
    }

	/**
	 * @param Odontograma $odontograma
	 */
	public function agregarOdontograma(Odontograma $odontograma)
	{
		$this->listaOdontogramas->push($odontograma);
	}

	/**
	 * @param PlanTratamiento $planTratamiento
	 */
	public function agregarPlanTratamiento(PlanTratamiento $planTratamiento)
	{
		$this->listaPlanesTratamiento->push($planTratamiento);
	}

	/**
	 * @param Interconsulta $interconsulta
	 */
	public function agregarInterconsulta(Interconsulta $interconsulta)
	{
		$this->listaInterconsultas->push($interconsulta);
	}

	/**
	 * @return boolean
	 */
	public function tieneInterconsultas()
	{
		if (count($this->listaInterconsultas) > 0 ) {
			return true;
		}

		return false;
	}

	/**
	 * @param $listaAnexos
	 */
	public function obtenerAnexos($listaAnexos)
	{
		if(!is_null($listaAnexos )) {
			foreach ($listaAnexos as $anexo) {
				$this->listaAnexos[] = new Anexo($anexo);
			}
		}
	}

	/**
	 * @return Array
	 */
	public function anexos()
	{
		return $this->listaAnexos;
	}

	/**
	 * @return bool
	 */
	public function tieneAnexos()
	{
		return count($this->listaAnexos) > 0 ? true : false;
	}

	/**
	 * @return Array
	 */
	public function consultas()
	{
		return $this->listaConsultas;
	}

	/**
	 * @param Consulta $consulta
	 */
	public function agregarConsulta(Consulta $consulta)
	{
		$this->listaConsultas->push($consulta);
	}

	/**
	 * @param TratamientoOdontologia $tratamiento
	 */
	public function agregarTratamientoOdontologia(TratamientoOdontologia $tratamiento)
	{
		$this->listaTratamientoOdontologia->push($tratamiento);
	}

	/**
	 * @return bool
	 */
	public function tieneConsultas()
	{
		return count($this->listaConsultas) > 0 ? true : false;
	}

	/**
	 * @return bool
	 */
	public function tienePlanesTratamiento()
	{
		return count($this->listaPlanesTratamiento) > 0 ? true : false;
	}

	/**
	 * @return bool
	 */
	public function tieneOdontogramas()
	{
		return count($this->listaOdontogramas) > 0 ? true : false;
	}

	/**
	 * @return PlanTratamiento|null
	 */
	public function obtenerPlanActivo()
	{
		foreach ( $this->listaPlanesTratamiento as $plan ) {
			if (!$plan->atendido()) {
				return $plan;
			}
		}

		return null;
	}
}