<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class ConvexividadFacial
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class ConvexividadFacial
{
	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var string
	 */
	private $convexividadFacial;

	/**
	 * ConvexividadFacial constructor.
	 * @param int $id
	 * @param string $convexividadFacial
	 */
	public function __construct($id = null, $convexividadFacial = null)
	{
		$this->id                 = $id;
		$this->convexividadFacial = $convexividadFacial;
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
	public function getConvexividadFacial()
	{
		return $this->convexividadFacial;
	}
}