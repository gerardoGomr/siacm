<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class InstitucionMedica
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class InstitucionMedica
{
	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var string
	 */
	private $institucionMedica;

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
	public function getInstitucionMedica()
	{
		return $this->institucionMedica;
	}
}