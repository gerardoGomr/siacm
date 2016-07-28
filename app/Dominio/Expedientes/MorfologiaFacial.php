<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class MorfologiaFacial
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class MorfologiaFacial
{
	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var string
	 */
	private $morfologiaFacial;

	/**
	 * MorfologiaFacial constructor.
	 * @param $id
	 * @param $morfologiaFacial
	 */
	public function __construct($id = null, $morfologiaFacial = null)
	{
		$this->id               = $id;
		$this->morfologiaFacial = $morfologiaFacial;
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
	public function getMorfologiaFacial()
	{
		return $this->morfologiaFacial;
	}
}