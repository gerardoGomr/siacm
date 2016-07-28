<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class MorfologiaCraneofacial
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class MorfologiaCraneofacial
{
	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var string
	 */
	private $morfologiaCraneofacial;

	/**
	 * MorfologiaCraneofacial constructor.
	 * @param int $id
	 * @param string $morfologiaCraneofacial
	 */
	public function __construct($id = null, $morfologiaCraneofacial = null)
	{
		$this->id                     = $id;
		$this->morfologiaCraneofacial = $morfologiaCraneofacial;
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
	public function getMorfologiaCraneofacial()
	{
		return $this->morfologiaCraneofacial;
	}
}