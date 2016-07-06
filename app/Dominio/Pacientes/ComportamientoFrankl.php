<?php
namespace Siacme\Dominio\Pacientes;

/**
 * @author Gerardo Adrián Gómez Ruiz
 */
class ComportamientoFrankl
{
	//int
	private $id;
	//string
	private $comportamientoFrankl;

	/**
	 * ComportamientoFrankl constructor.
	 * @param $id
	 * @param $comportamientoFrankl
	 */
	public function __construct($id = null, $comportamientoFrankl = null)
	{
		$this->id                   = $id;
		$this->comportamientoFrankl = $comportamientoFrankl;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getComportamientoFrankl()
	{
		return $this->comportamientoFrankl;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setComportamientoFrankl($comportamientoFrankl)
	{
		$this->comportamientoFrankl = $comportamientoFrankl;
	}
}