<?php
namespace Siacme\Dominio\Consultas;

use Siacme\Dominio\Pacientes\DienteTratamiento;

/**
 * @package Siacme\Dominio\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
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
	 * @param bool $atendido
	 */
	public function setAtendido($atendido)
	{
		$this->atendido = $atendido;
	}

	/**
	 * @return bool
	 */
	public function atendido()
	{
		return $this->atendido;
	}

	public function getDienteTratamiento()
	{
		return $this->dienteTratamiento;
	}

	/**
	 * @param DienteTratamiento $dienteTratamiento
	 */
	public function setDienteTratamiento(DienteTratamiento $dienteTratamiento)
	{
		$this->dienteTratamiento = $dienteTratamiento;
	}

	public function atender()
	{
		$this->atendido = true;
	}
}