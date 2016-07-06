<?php
namespace Siacme\Dominio\Pacientes;

/**
 * @author Gerardo Adrián Gómez Ruiz
 */
class ConvexividadFacial
{
	//int
	private $id;
	//string
	private $convexividadFacial;

	/**
	 * ConvexividadFacial constructor.
	 * @param $id
	 * @param $convexividadFacial
	 */
	public function __construct($id = null, $convexividadFacial = null)
	{
		$this->id                 = $id;
		$this->convexividadFacial = $convexividadFacial;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getConvexividadFacial()
	{
		return $this->convexividadFacial;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setConvexividadFacial($convexividadFacial)
	{
		$this->convexividadFacial = $convexividadFacial;
	}
}