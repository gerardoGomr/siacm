<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class EstadoCivil
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class EstadoCivil
{
	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var string
	 */
	private $estadoCivil;

	/**
	 * EstadoCivil constructor.
	 * @param int $id
	 * @param string $estadoCivil
	 */
	public function __construct($id = null, $estadoCivil = null)
	{
		$this->id          = $id;
		$this->estadoCivil = $estadoCivil;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getEstadoCivil()
	{
		return $this->estadoCivil;
	}
}