<?php
namespace Siacme\Dominio\Expedientes;

use Siacme\Dominio\Pacientes\Paciente;
use Siacme\Dominio\Usuarios\Usuario;

/**
 * Class Expediente
 * @package Siacme\Dominio\Expedientes
 * @author  Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class Expediente
{
	/**
	 * @var int
	 */
	protected $id;

	/**
	 * @var int
	 */
	protected $numero;

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
	 * @var string
	 */
	protected $fechaCreacion;

	/**
	 * Expediente constructor.
	 * @param string $firma
	 * @param int $numero
	 */
	public function __construct($firma = '', $numero = 0)
	{
		$this->numero = $numero;
		$this->firma  = $firma;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return int
	 */
	public function getNumero()
	{
		return $this->numero;
	}

	/**
	 * @return string
	 */
	public function getFirma()
	{
		return $this->firma;
	}

	/**
	 * @return boolean
	 */
	public function primeraVez()
	{
		return $this->primeraVez;
	}

	/**
	 * @return Paciente
	 */
	public function getPaciente()
	{
		return $this->paciente;
	}

	/**
	 * @return Usuario
	 */
	public function getMedico()
	{
		return $this->medico;
	}

	/**
	 * @return string
	 */
	public function getFechaCreacion()
	{
		return $this->fechaCreacion;
	}
}