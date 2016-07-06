<?php
namespace Siacme\Dominio\Pacientes;

/**
 * @author Gerardo Adrián Gómez Ruiz
 */
class MorfologiaCraneofacial
{
	//int
	private $id;
	//string
	private $morfologiaCraneofacial;

	/**
	 * MorfologiaCraneofacial constructor.
	 * @param $id
	 * @param $morfologiaCraneofacial
	 */
	public function __construct($id = null, $morfologiaCraneofacial = null)
	{
		$this->id                     = $id;
		$this->morfologiaCraneofacial = $morfologiaCraneofacial;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getMorfologiaCraneofacial()
	{
		return $this->morfologiaCraneofacial;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setMorfologiaCraneofacial($morfologiaCraneofacial)
	{
		$this->morfologiaCraneofacial = $morfologiaCraneofacial;
	}
}