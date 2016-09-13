<?php
namespace Siacme\Dominio\Expedientes;

use Siacme\Dominio\Listas\IColeccion;

/**
 * Class PlanTratamiento
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class PlanTratamiento
{
	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var bool
	 */
	private $atendido;

	/**
	 * @var double
	 */
	private $costo;

	/**
	 * @var IColeccion
	 */
	private $dientes;

	/**
	 * @var string
	 */
	private $aQuienSeDirige;

	/**
	 * @var Collection
	 */
	private $otrosTratamientos;

	/**
	 * constructor
	 * @param IColeccion $otrosTratamientos
	 */
	public function __construct(IColeccion $otrosTratamientos = null)
	{
		$this->otrosTratamientos = $otrosTratamientos;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * devuelve el costo total del tratamiento
	 * @return double
	 */
	public function costo()
	{
		$this->calcularCosto();
		return $this->costo;
	}

	/**
	 * calcular el costo en base a la lista de tratamientos de los dientes
	 * y en base al costo de otros tratamientos
	 */
	private function calcularCosto()
	{
		$this->costo = 0;
		if(count($this->dientes) > 0) {
			// hay dientes
			foreach ($this->dientes as $diente) {
				if ($diente->tieneTratamientos()) {
					foreach ($diente->getTratamientos() as $tratamiento) {
						$this->costo += $tratamiento->getCosto();
					}
				}
			}
		}

		if ($this->tieneOtrosTratamientos()) {
			foreach ($this->otrosTratamientos as $otroTratamiento) {
				$this->costo += $otroTratamiento->getCosto();
			}
		}
	}

	/**
	 * verifica si tiene otros tratamientos
	 * @return bool
	 */
	public function tieneOtrosTratamientos()
	{
		return count($this->otrosTratamientos) > 0 ? true : false;
	}

	/**
	 * verifica si esta atendido o no el plan
	 * @return bool
	 */
	public function atendido()
	{
		$faltantesPorAtender = 0;
		if (count($this->dientes) > 0) {
			foreach ( $this->dientes as $diente ) {
				if (count($diente->getListaTratamientos()) > 0) {
					foreach ($diente->getListaTratamientos() as $tratamiento) {
						if($tratamiento->atendido() === false) {
							$faltantesPorAtender++;
						}
					}
				}

				if ($faltantesPorAtender > 0) {
					$this->atendido = false;
				} else {
					$this->atendido = true;
				}
			}
		}

		return $this->atendido;
	}

	/**
	 * generar el plan a partir de la lista de dientes del odontograma
	 * @param Odontograma $odontograma
	 */
	public function generarDeOdontograma(Odontograma $odontograma)
	{
		$this->dientes = $odontograma->getDientes();
	}

	/**
	 * @return Collection
	 */
	public function getDientes()
	{
		return $this->dientes;
	}

	/**
	 * devolver un diente en específico
	 * @param int $numero
	 * @return Diente
	 */
	public function diente($numero)
	{
		foreach ($this->dientes as $diente) {

			if($diente->getNumero() === $numero) {
				return $diente;
			}
		}
	}

	/**
	 * @return Collection
	 */
	public function getOtrosTratamientos()
	{
		return $this->otrosTratamientos;
	}

	/**
	 * agregar nuevo "otro" tratamiento al plan
	 * @param OtroTratamiento $tratamiento
	 */
	public function agregarOtroTratamiento(OtroTratamiento $tratamiento)
	{
		$this->otrosTratamientos->add($tratamiento);
	}

	/**
	 * remover todos los "otros" tratamientos del plan
	 */
	public function removerOtrosTratamientos()
	{
		$this->otrosTratamientos = null;
	}

	/**
	 * devolver "otro" tratamiento en base a su id
	 * @param $indice
	 * @return OtroTratamiento
	 */
	public function otroTratamiento($indice)
	{
		return $this->otrosTratamientos->get($indice);
	}

	/**
	 * @return float
	 */
	public function getCosto()
	{
		return $this->costo;
	}

	public function atender() {
		foreach ($this->dientes as $diente) {
			$diente->atenderTratamientos();
		}
	}
}