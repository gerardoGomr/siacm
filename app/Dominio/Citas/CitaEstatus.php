<?php
namespace Siacme\Dominio\Citas;

/**
 * @package Siacme\Citas
 * @author  Gerardo Adrián Gómez Ruiz
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

	/**
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @param string $estatus
	 */
	public function setEstatus($estatus)
	{
		$this->estatus = $estatus;
	}
}