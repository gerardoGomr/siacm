<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class ComportamientoInicial
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class ComportamientoInicial
{
	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var string
	 */
	private $comportamientoInicial;

	/**
	 * ComportamientoInicial constructor.
	 * @param $id
	 * @param $comportamientoInicial
	 */
	public function __construct($id = null, $comportamientoInicial = null)
	{
		$this->id                    = $id;
		$this->comportamientoInicial = $comportamientoInicial;
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
	public function getComportamientoInicial()
	{
		return $this->comportamientoInicial;
	}
}