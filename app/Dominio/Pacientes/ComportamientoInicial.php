<?php
namespace Siacme\Dominio\Pacientes;

/**
 * @author Gerardo Adrián Gómez Ruiz
 */
class ComportamientoInicial
{
	//int
	private $id;
	//string
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

	public function getId()
	{
		return $this->id;
	}

	public function getComportamientoInicial()
	{
		return $this->comportamientoInicial;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setComportamientoInicial($comportamientoInicial)
	{
		$this->comportamientoInicial = $comportamientoInicial;
	}
}