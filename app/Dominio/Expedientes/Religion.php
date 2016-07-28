<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class Religion
 * @package Siacme\Dominio\Pacientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class Religion
{
	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var string
	 */
	private $religion;

	/**
	 * Religion constructor.
	 * @param int $id
	 * @param string $religion
	 */
	public function __construct($id = null, $religion = null)
	{
		$this->id       = $id;
		$this->religion = $religion;
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
	public function getReligion()
	{
		return $this->religion;
	}
}