<?php
namespace Siacme\Dominio\Pacientes;

/**
 * @package Siacme\Expedientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class ATM
{
	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var string
	 */
	private $atm;

	/**
	 * ATM constructor.
	 * @param int    $id
	 * @param string $atm
	 */
	public function __construct($id = null, $atm = null)
	{
		$this->id  = $id;
		$this->atm = $atm;
	}

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
	public function getATM()
	{
		return $this->atm;
	}

	/**
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @param string $atm
	 */
	public function setATM($atm)
	{
		$this->atm = $atm;
	}
}