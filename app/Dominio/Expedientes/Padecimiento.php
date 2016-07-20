<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class Padecimiento
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class Padecimiento
{
	/**
	 * @var int
	 */
	protected $id;

	/**
	 * @var string
	 */
	protected $padecimiento;

	/**
	 * Padecimiento constructor.
	 * @param int|null $id
	 */
	public function __construct($id = null)
	{
		$this->id = $id;
	}

	/**
	 * @return int|null
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getPadecimiento()
	{
		return $this->padecimiento;
	}
}