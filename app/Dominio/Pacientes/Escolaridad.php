<?php
namespace Siacme\Dominio\Pacientes;

/**
 * @author Gerardo Adrián Gómez Ruiz
 */
class Escolaridad
{
	//int
	private $id;
	//string
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


	public function getId()
	{
		return $this->id;
	}

	public function getEscolaridad()
	{
		return $this->escolaridad;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setEscolaridad($escolaridad)
	{
		$this->escolaridad = $escolaridad;
	}
}