<?php
namespace Siacme\Dominio\Usuarios;

/**
 * Class Medico
 * @package Siacme\Dominio\Usuarios
 * @author  Gerardo Adrián Gómez Ruiz
 */
class Medico extends Usuario
{
	public function __construct($username)
	{
		parent::__construct($username);
	}

	//especialidad
	private $especialidad;

	public function getEspecialidad()
	{
		return $this->especialidad;
	}

	public function setEspecialidad(Especialidad $especialidad)
	{
		$this->especialidad = $especialidad;
	}
}