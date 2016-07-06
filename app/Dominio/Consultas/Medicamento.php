<?php
namespace Siacme\Consultas;

/**
* @author Gerardo Adrián Gómez Ruiz
*/
class Medicamento
{
	/**
	 * el id del medicamento
	 * @var int
	 */
	private $id;

	/**
	 * nombre del medicamento
	 * @var string
	 */
	private $nombre;

	public function __construct($id = null, $nombre = null)
	{
		$this->id     = $id;
		$this->nombre = $nombre;
	}

	public function nombre()
	{
		return $this->nombre;
	}
}