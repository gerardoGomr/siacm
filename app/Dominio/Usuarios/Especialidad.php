<?php

namespace Siacme\Dominio\Usuarios;

/**
 * Class Especialidad
 * @package Siacme\Dominio\Usuarios
 * @author  Gerardo Adrián Gómez Ruiz
 */
class Especialidad
{
	/**
	 * id de la especialidad
	 * @var int
	 */
	private $id;

	/**
	 * nombre de la especialidad
	 * @var string
	 */
	private $especialidad;

	/**
	 * Especialidad constructor.
	 * @param string|null $id
	 * @param string|null $especialidad
	 */
	public function __construct($id = null, $especialidad = null)
	{
		$this->id           = $id;
		$this->especialidad = $especialidad;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getEspecialidad()
	{
		return $this->especialidad;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setEspecialidad($especialidad)
	{
		$this->especialidad = $especialidad;
	}
}