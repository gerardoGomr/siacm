<?php
namespace Siacme\Dominio\Citas;

/**
 * Class CitaEstatus
 * @package Siacme\Dominio\Citas
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class CitaEstatus
{
	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var string
	 */
	private $estatus;

	public function __construct($id = null)
	{
		$this->id = $id;
	}

	/**
	 * devolver id
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getEstatus()
	{
		return $this->estatus;
	}
}