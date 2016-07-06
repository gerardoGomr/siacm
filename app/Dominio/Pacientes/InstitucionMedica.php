<?php
namespace Siacme\Dominio\Pacientes;

/**
 * @author Gerardo Adrián Gómez Ruiz
 */
class InstitucionMedica
{
	//int
	private $id;
	//string
	private $institucionMedica;

	//getters
	public function getId()
	{
		return $this->id;
	}

	public function getInstitucionMedica()
	{
		return $this->institucionMedica;
	}
	//////////////////////////////////////////////////////////

	//setters
	public function setId($id)
	{
		$this->id = $id;
	}

	public function setInstitucionMedica($institucionMedica)
	{
		$this->institucionMedica = $institucionMedica;
	}
}