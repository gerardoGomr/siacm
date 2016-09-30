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
	 * @var DienteTratamiento
	 */
	private $dienteTratamiento;

	/**
	 * @var bool
	 */
	private $atendido;

	/**
	 * constructor
	 * @param DienteTratamiento $dienteTratamiento
	 * @param bool $atendido
	 */
	public function __construct(DienteTratamiento $dienteTratamiento = null, $atendido = false)
	{
		$this->dienteTratamiento = $dienteTratamiento;
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
	 * @return DienteTratamiento
	 */
	public function getDienteTratamiento()
	{
		return $this->dienteTratamiento;
	}

	/**
	 * atender el tratamiento
	 */
	public function atender()
	{
		$this->atendido = true;
	}
}