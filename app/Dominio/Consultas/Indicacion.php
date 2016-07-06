<?php
namespace Siacme\Consultas;

/**
* @author Gerardo Adrián Gómez Ruiz
*/
class Indicacion
{
	/**
	 * el medicamento
	 * @var Medicamento
	 */
	private $medicamento;

	/**
	 * la dosis del medicamento
	 * @var string
	 */
	private $dosis;

	/**
	 * cada cuanto se administra
	 * @var string
	 */
	private $periodo;

	/**
	 * constructor
	 * @param Medicamento $medicamento
	 * @param string      $dosis
	 * @param string      $periodo
	 */
	public function __construct(Medicamento $medicamento, $dosis, $periodo)
	{
		$this->medicamento = $medicamento;
		$this->dosis       = $dosis;
		$this->periodo     = $periodo;
	}

	/**
	 * indicación completa
	 * @return string
	 */
	public function indicacion()
	{
		return $this->medicamento->nombre() . ': Tomar ' . $this->dosis . $this->periodo;
	}
}