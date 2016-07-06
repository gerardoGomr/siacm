<?php
namespace Siacme\Dominio\Pacientes;

/**
 * @author Gerardo Adrián Gómez Ruiz
 */
class MorfologiaFacial
{
	//int
	private $id;
	//string
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

	public function getId()
	{
		return $this->id;
	}

	public function getMorfologiaFacial()
	{
		return $this->morfologiaFacial;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setMorfologiaFacial($morfologiaFacial)
	{
		$this->morfologiaFacial = $morfologiaFacial;
	}
}