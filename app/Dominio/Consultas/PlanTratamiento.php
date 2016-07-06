<?php
namespace Siacme\Dominio\Consultas;
use Illuminate\Support\Collection;
use Siacme\Dominio\Pacientes\Odontograma;

/**
 * @package Siacme\Dominio\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
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
	 * @var Collection
	 */
	private $listaDientes;

	/**
	 * @var string
	 */
	private $aQuienSeDirige;

	/**
	 * @var Collection
	 */
	private $listaOtrosTratamientos;

	/**
	 * constructor
	 * @param bool $atendido
	 * @param Collection $listaDientes
	 */
	public function __construct($atendido = true, Collection $listaDientes = null)
	{
		$this->atendido               = $atendido;
		$this->listaDientes           = $listaDientes;
		$this->listaOtrosTratamientos = new Collection();
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * devuelve el costo total del tratamiento
	 * @return double
	 */
	public function costo()
	{
		if (!is_null($this->costo)) {
			return $this->costo;
		}
		
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
		if(count($this->listaDientes) > 0) {
			foreach ($this->listaDientes as $diente) {
				if (!is_null($diente->getListaTratamientos())) {
					foreach ($diente->getListaTratamientos() as $tratamiento) {
						$this->costo += $tratamiento->getDienteTratamiento()->getCosto();
					}
				}
			}
		}

		if (!is_null($this->listaOtrosTratamientos)) {
			foreach ($this->listaOtrosTratamientos as $otroTratamiento) {
				$this->costo += $otroTratamiento->getCosto();
			}
		}
	}

	/**
	 * verifica si esta atendido o no el plan
	 * @return bool
	 */
	public function atendido()
	{
		$faltantesPorAtender = 0;
		if (count($this->listaDientes) > 0) {
			foreach ( $this->listaDientes as $diente ) {
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
		$this->listaDientes = $odontograma->getListaDientes();
	}

	/**
	 * @return Collection
	 */
	public function getListaDientes()
	{
		return $this->listaDientes;
	}

	/**
	 * @param Collection $listaDientes
	 */
	public function setListaDientes(Collection $listaDientes)
	{
		$this->listaDientes = $listaDientes;
	}

	/**
	 * devolver un diente en específico
	 * @param int $numero
	 * @return Diente
	 */
	public function diente($numero)
	{
		foreach ($this->listaDientes as $diente) {

			if($diente->getNumero() === $numero) {
				return $diente;
			}
		}
	}

	/**
	 * @return Collection
	 */
	public function getListaOtrosTratamientos()
	{
		return $this->listaOtrosTratamientos;
	}

	/**
	 * @param Collection $listaOtrosTratamientos
	 */
	public function setListaOtrosTratamientos(Collection $listaOtrosTratamientos)
	{
		$this->listaOtrosTratamientos = $listaOtrosTratamientos;
	}

	/**
	 * agregar nuevo "otro" tratamiento al plan
	 * @param int $indice
	 * @param OtroTratamiento $tratamiento
	 */
	public function agregarOtroTratamiento($indice, OtroTratamiento $tratamiento)
	{
		if(is_null($this->listaOtrosTratamientos)) {
			$this->listaOtrosTratamientos = new Collection();
		}

		/*if (count($this->listaTratamientos) === 2) {
            throw new \Exception('Solo se permiten hasta dos tratamientos por diente');
        }*/

		// si ya está ocupada la posición, la elimina para permitir agregar uno nuevo
		if ($this->listaOtrosTratamientos->has($indice)) {
			$this->listaOtrosTratamientos->forget($indice);
		}

		$this->listaOtrosTratamientos->put($indice, $tratamiento);
	}

	/**
	 * remover todos los "otros" tratamientos del plan
	 */
	public function removerOtrosTratamientos()
	{
		$this->listaOtrosTratamientos = null;
	}

	/**
	 * devolver "otro" tratamiento en base a su id
	 * @param $indice
	 * @return OtroTratamiento
	 */
	public function otroTratamiento($indice)
	{
		return $this->listaOtrosTratamientos->get($indice);
	}

	/**
	 * @return float
	 */
	public function getCosto()
	{
		return $this->costo;
	}

	/**
	 * @param float $costo
	 */
	public function setCosto($costo)
	{
		$this->costo = $costo;
	}

	public function atender() {
		foreach ($this->listaDientes as $diente) {
			$diente->atenderTratamientos();
		}
	}
}