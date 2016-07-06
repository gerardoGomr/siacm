<?php
namespace Siacme\Dominio\Pacientes;

/**
* @author Gerardo Adrian Gomez Ruiz
*/
class Padecimiento
{
	protected $id;
	protected $padecimiento;

	public function __construct($id = null)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getPadecimiento()
	{
		return $this->padecimiento;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setPadecimiento($padecimiento)
	{
		$this->padecimiento = $padecimiento;
	}
}