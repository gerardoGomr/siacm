<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class DientePlan
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class DientePlan
{
	/**
	 * @var bool
	 */
	private $atendido;

	/**
	 * constructor
	 * @param bool $atendido
	 */
	public function __construct($atendido = false)
	{
		$this->atendido          = $atendido;
	}

	/**
	 * @return bool
	 */
	public function atendido()
	{
		return $this->atendido;
	}

	/**
	 * atender el tratamiento
	 */
	public function atender()
	{
		$this->atendido = true;
	}
}