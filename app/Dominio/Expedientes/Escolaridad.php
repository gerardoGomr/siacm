<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class Escolaridad
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class Escolaridad
{
	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var string
	 */
	private $escolaridad;

	/**
	 * Escolaridad constructor.
	 * @param int $id
	 * @param string $escolaridad
	 */
	public function __construct($id = null, $escolaridad = null)
	{
		$this->id          = $id;
		$this->escolaridad = $escolaridad;
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
	public function getEscolaridad()
	{
		return $this->escolaridad;
	}
}