<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class TrastornoLenguaje
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class TrastornoLenguaje
{
	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var string
	 */
	private $trastornoLenguaje;

	/**
	 * TrastornoLenguaje constructor.
	 * @param int    $id
	 * @param string $trastornoLenguaje
	 */
	public function __construct($id = null, $trastornoLenguaje = null)
	{
		$this->id                = $id;
		$this->trastornoLenguaje = $trastornoLenguaje;
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
	public function getTrastornoLenguaje()
	{
		return $this->trastornoLenguaje;
	}
}