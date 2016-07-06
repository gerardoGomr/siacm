<?php
namespace Siacme\Dominio\Pacientes;

/**
 * @author Gerardo Adrián Gómez Ruiz
 */
class Religion
{
	//int
	private $id;
	//string
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


	public function getId()
	{
		return $this->id;
	}

	public function getReligion()
	{
		return $this->religion;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setReligion($religion)
	{
		$this->religion = $religion;
	}
}