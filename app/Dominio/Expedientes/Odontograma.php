<?php
namespace Siacme\Dominio\Expedientes;

use Siacme\Dominio\Listas\IColeccion;
use Siacme\Exceptions\MasDeDosPadecimientosPorDienteException;
use Siacme\Exceptions\OtroTratamientoNoExisteEnPlanActualException;
use Siacme\Exceptions\OtroTratamientoYaHaSidoAgregadoAPlanActualException;

/**
 * Class Odontograma
 * @package Siacme\Dominio\Expedientes
 * @author  Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class Odontograma
{
	/**
	 * @var int
	 */
	protected $id;

	/**
	 * lista de dientes
	 * @var IColeccion
	 */
	protected $dientes;

    /**
     * @var IColeccion
     */
    private $otrosTratamientos;

	/**
	 * @var boolean
	 */
	protected $revisado;

    /**
     * @var ExpedienteJohanna
     */
    protected $expedienteEspecialidad;

    /**
     * construir el odontograma con una lista de dientes
     * si la lista no se proporciona, se asignan todos los diente
     * caso contrario, se asigna el que se pasa como parámetro
     * @param IColeccion $dientes
     * @param IColeccion $otrosTratamientos
     * @param bool $revisado
     */
	public function __construct(IColeccion $dientes, IColeccion $otrosTratamientos, $revisado = false)
	{
        $this->revisado          = $revisado;
        $this->dientes           = $dientes;
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
	 * agregar nuevo diente
	 * @param  Diente $diente
	 */
	public function agregarDiente(Diente $diente)
	{
		$this->dientes->add($diente);
	}

	/**
	 * remover los padecimientos al diente
	 * @param int $numeroDiente
	 */
	public function removerPadecimientosADiente($numeroDiente)
	{
		$this->diente($numeroDiente)->removerPadecimientos();
	}

	/**
	 * agregar un padecimiento al diente
	 * @param int $numeroDiente
	 * @param DientePadecimiento $dientePadecimiento
	 * @return bool
	 * @throws MasDeDosPadecimientosPorDienteException
	 */
	public function agregarPadecimientoADiente($numeroDiente, DientePadecimiento $dientePadecimiento)
	{
		try {
			$this->diente($numeroDiente)->agregarPadecimiento($dientePadecimiento);

		} catch(MasDeDosPadecimientosPorDienteException $e) {
			// log the error onto file
			return false;
		}
	}

	/**
	 * devolver un diente dependiendo el numero
	 * @param $numero
	 * @return Diente|null
	 */
	public function diente($numero)
	{
		foreach ($this->dientes->getValues() as $diente) {

			if($diente->getNumero() === $numero) {
				return $diente;
			}
		}

		return null;
	}

	/**
	 * @return boolean
	 */
	public function revisado()
	{
		return $this->revisado;
	}

	/**
	 * @return IColeccion
	 */
	public function getDientes()
	{
		return $this->dientes;
	}

	/**
	 * borrar los tratamientos asignados a sus dientes
	 */
	public function borrarDientesTratamientos()
	{
		foreach ($this->dientes as $diente) {
			$diente->removerTratamientos();
		}
	}

    /**
     * asignar para expediente especialidad
     * @param ExpedienteJohanna $expedienteJohanna
     */
    public function generarPara(ExpedienteJohanna $expedienteJohanna)
    {
        $this->expedienteEspecialidad = $expedienteJohanna;
    }

    /**
     * @return IColeccion
     */
    public function getOtrosTratamientos()
    {
        return $this->otrosTratamientos;
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
     * agregar un tratamiento al diente
     * @param int $numeroDiente
     * @param DientePlan $dientePlan
     * @throws \Siacme\Exceptions\SoloSePermitenDosTratamientosException
     */
    public function agregarTratamiento($numeroDiente, DientePlan $dientePlan)
    {
        $this->diente($numeroDiente)->agregarTratamiento($dientePlan);
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
     * se asigna el presente odontograma a johanna
     * @param ExpedienteJohanna $expedienteJohanna
     */
    public function asignadoA(ExpedienteJohanna $expedienteJohanna)
    {
        $this->expedienteEspecialidad = $expedienteJohanna;
    }
}