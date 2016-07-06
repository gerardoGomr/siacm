<?php
namespace Siacme\Dominio\Pacientes;

/**
 * @author Gerardo Adrian Gomez Ruiz
 */
class EstadoCivil
{
	//int
	private $id;
	//string
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


	public function getId()
	{
		return $this->id;
	}

	public function getEstadoCivil()
	{
		return $this->estadoCivil;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setEstadoCivil($estadoCivil)
	{
		$this->estadoCivil = $estadoCivil;
	}
}