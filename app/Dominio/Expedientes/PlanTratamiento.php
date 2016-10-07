<?php
namespace Siacme\Dominio\Expedientes;

use Siacme\Dominio\Listas\IColeccion;
use Siacme\Exceptions\OtroTratamientoNoExisteEnPlanActualException;
use Siacme\Exceptions\OtroTratamientoYaHaSidoAgregadoAPlanActualException;

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
	 * @var IColeccion
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
		if($this->dientes->count() > 0) {
			// hay dientes
			foreach ($this->dientes as $diente) {
				if ($diente->tieneTratamientos()) {
					foreach ($diente->getTratamientos() as $tratamiento) {
						$this->costo += $tratamiento->getDienteTratamiento()->getCosto();
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
		return $this->otrosTratamientos->count() > 0 ? true : false;
	}

	/**
	 * verifica si esta atendido o no el plan
	 * @return bool
	 */
	public function estaAtendido()
	{
		$faltantesPorAtender = 0;
		if ($this->dientes->count() > 0) {
			foreach ( $this->dientes as $diente ) {
				if ($diente->getTratamientos()->count() > 0) {
					foreach ($diente->getTratamientos() as $tratamiento) {
						if(!$tratamiento->atendido()) {
							$faltantesPorAtender++;
						}
					}
				}
			}

            if ($faltantesPorAtender > 0) {
                $this->atendido = false;
            } else {
                $this->atendido = true;
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
	 * @return IColeccion
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
	 * @return IColeccion
	 */
	public function getOtrosTratamientos()
	{
		return $this->otrosTratamientos;
	}

	/**
	 * agregar nuevo "otro" tratamiento al plan
	 * @param OtroTratamiento $tratamiento
	 * @throws OtroTratamientoYaHaSidoAgregadoAPlanActualException
	 */
	public function agregarOtroTratamiento(OtroTratamiento $tratamiento)
	{
		$encontrado = false;
		foreach ($this->otrosTratamientos as $otroTratamiento) {
			if ($otroTratamiento->getId() === $tratamiento->getId()) {
				$encontrado = true;
			}
		}

		if ($encontrado) {
			throw new OtroTratamientoYaHaSidoAgregadoAPlanActualException('El tratamiento especificado ya se ha agregado al plan actual.');
		}

		$this->otrosTratamientos->add($tratamiento);
	}

	/**
	 * quitar el tratamiento especificado del plan
	 * @param OtroTratamiento $tratamiento
	 * @throws OtroTratamientoNoExisteEnPlanActualException
	 */
	public function quitarOtroTratamiento(OtroTratamiento $tratamiento)
	{
		$encontrado = false;
		foreach ($this->otrosTratamientos as $otroTratamiento) {
			if ($otroTratamiento->getId() === $tratamiento->getId()) {
				$this->otrosTratamientos->removeElement($otroTratamiento);
				$encontrado = true;
			}
		}

		if (!$encontrado) {
			throw new OtroTratamientoNoExisteEnPlanActualException('El tratamiento especificado no existe en el plan actual.');
		}
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
	 * agregar un tratamiento al diente
	 * @param int $numeroDiente
	 * @param DienteTratamiento $dientePlan
	 * @throws \Siacme\Exceptions\SoloSePermitenDosTratamientosException
	 */
	public function agregarTratamiento($numeroDiente, DienteTratamiento $dientePlan)
	{
		$this->diente($numeroDiente)->agregarTratamiento($dientePlan);
	}

	/**
	 * @return float
	 */
	public function getCosto()
	{
		return $this->costo;
	}

	/**
	 * eliminar el tratamiento del diente seleccionado
	 * @param int $numeroDiente
	 * @param DienteTratamiento $dienteTratamiento
	 * @throws \Siacme\Exceptions\TratamientoNoExisteEnPlanActualException
	 */
	public function eliminarTratamiento($numeroDiente, DienteTratamiento $dienteTratamiento)
	{
		$this->diente($numeroDiente)->eliminarTratamiento($dienteTratamiento);
	}

	/**
	 * validar que todos los dientes tengan tratamientos
	 * @return bool
	 */
	public function todosLosDientesTienenTratamientos()
	{
		foreach ($this->dientes as $diente) {
			if ($diente->tienePadecimientos()) {
				if (!$diente->tieneTratamientos()) {
					return false;
				}
			}
		}

		return true;
	}

	public function atender() {
		foreach ($this->dientes as $diente) {
			$diente->atenderTratamientos();
		}
	}

    /**
     * @return string
     */
    public function getAQuienSeDirige()
    {
        return $this->aQuienSeDirige;
    }
}