<?php
namespace Siacme\Dominio\Expedientes;

use Exception;
use Siacme\Dominio\Listas\IColeccion;
use Siacme\Exceptions\ElOtroTratamientoNoEstaAsignadoAlOdontogramaException;
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
	private $id;

	/**
	 * lista de dientes
	 * @var IColeccion
	 */
	private $odontogramaDientes;

    /**
     * @var IColeccion
     */
    private $otrosTratamientos;

	/**
	 * @var boolean
	 */
	private $atendido;

    /**
     * @var float
     */
    private $costo;

    /**
     * @var ExpedienteJohanna
     */
    private $expedienteEspecialidad;

    /**
     * construir el odontograma con una lista de dientes
     * si la lista no se proporciona, se asignan todos los diente
     * caso contrario, se asigna el que se pasa como parámetro
     * @param IColeccion $odontogramaDientes
     * @param IColeccion $otrosTratamientos
     * @param bool $atendido
     */
	public function __construct(IColeccion $odontogramaDientes, IColeccion $otrosTratamientos, $atendido = false)
	{
        $this->atendido           = $atendido;
        $this->odontogramaDientes = $odontogramaDientes;
        $this->otrosTratamientos  = $otrosTratamientos;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

    /**
     * @return IColeccion
     */
    public function getOdontogramaDientes()
    {
        return $this->odontogramaDientes;
    }

    /**
     * @return IColeccion
     */
    public function getOtrosTratamientos()
    {
        return $this->otrosTratamientos;
    }

    /**
     * @return boolean
     */
    public function atendido()
    {
        return $this->atendido;
    }

    /**
     * @return ExpedienteJohanna
     */
    public function getExpedienteEspecialidad()
    {
        return $this->expedienteEspecialidad;
    }

    /**
     * @return float
     */
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * agregar un odontograma diente
     * @param OdontogramaDiente $odontogramaDiente
     */
    public function agregarOdontogramaDiente(OdontogramaDiente $odontogramaDiente)
    {
        $this->odontogramaDientes->add($odontogramaDiente);
    }

    /**
     * @param OdontogramaDiente $odontogramaDiente
     */
    public function removerOdontogramaDiente(OdontogramaDiente $odontogramaDiente)
    {
        foreach ($this->odontogramaDientes as $odontogramaDienteAsignado) {
            if ($odontogramaDienteAsignado->getDiente()->getNumero() === $odontogramaDiente->getDiente()->getNumero()) {
                $this->odontogramaDientes->removeElement($odontogramaDienteAsignado);
            }
        }
    }

    /**
     * devuelve el odontogramaDiente por el numero especificado
     * @param int $numero
     * @return OdontogramaDiente
     * @throws Exception
     */
    public function getOdontogramaDiente($numero)
    {
        return $this->obtenerOdontogramaDiente($numero);
    }

    /**
     * se remueven padecimientos
     * @param int $numero
     */
    public function removerPadecimientosADiente($numero)
    {
        $odontogramaDiente = $this->obtenerOdontogramaDiente($numero);
        $odontogramaDiente->removerPadecimientos();
    }

    /**
     * agregar un padecimiento al diente
     * @param int $numero
     * @param DientePadecimiento $dientePadecimiento
     * @throws Exception
     */
    public function agregarPadecimientoADiente($numero, DientePadecimiento $dientePadecimiento)
    {
        $odontogramaDiente = $this->obtenerOdontogramaDiente($numero);

        try {
            $odontogramaDiente->agregarPadecimiento($dientePadecimiento);

        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * verificar si tiene asignados otros tratamientos
     * @return bool
     */
    public function tieneOtrosTratamientos()
    {
        return $this->otrosTratamientos->count() > 0;
    }

    /**
     * asignar otro tratamiento
     * @param OdontogramaOtroTratamiento $otroTratamiento
     * @throws OtroTratamientoYaHaSidoAgregadoAPlanActualException
     */
    public function agregarOtroTratamiento(OdontogramaOtroTratamiento $otroTratamiento)
    {
        foreach ($this->otrosTratamientos as $otroTratamientoAsignado) {
            if ($otroTratamientoAsignado->getOtroTratamiento()->getId() === $otroTratamiento->getOtroTratamiento()->getId()) {
                throw new OtroTratamientoYaHaSidoAgregadoAPlanActualException('Este tratamiento ya ha sido agregado al odontograma');
            }
        }

        $this->otrosTratamientos->add($otroTratamiento);
    }

    /**
     * remover otro tratamiento del odontograma
     * @param OtroTratamiento $otroTratamiento
     * @throws OtroTratamientoNoExisteEnPlanActualException
     */
    public function quitarOtroTratamiento(OtroTratamiento $otroTratamiento)
    {
        $encontrado = false;

        foreach ($this->otrosTratamientos as $otroTratamientoAsignado) {
            if ($otroTratamientoAsignado->getOtroTratamiento()->getId() === $otroTratamiento->getId()) {
                $this->otrosTratamientos->removeElement($otroTratamientoAsignado);

                $encontrado = true;
            }
        }

        if (!$encontrado) {
            throw new OtroTratamientoNoExisteEnPlanActualException('El tratamiento especificado no existe en el odontograma actual');
        }
    }

    /**
     * verifica todos los dientes. Si el diente actual tiene padecimientos, debe tener tratamientos
     * @return bool
     */
    public function todosLosDientesTienenTratamientos()
    {
        foreach ($this->odontogramaDientes as $odontogramaDiente) {
            if ($odontogramaDiente->tienePadecimientos()) {
                if (!$odontogramaDiente->tieneTratamientos()) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * devuelve el costo del odontograma
     * @return float
     */
    public function costo()
    {
        $this->calcularCosto();

        return $this->costoFormato();
    }

    /**
     * costo a 2 decimales
     * @return string
     */
    public function costoFormato()
    {
        return '$' . number_format($this->costo, 2);
    }

    /**
     * obtiene el costo en base a sus tratamientos y otros tratamientos
     */
    private function calcularCosto()
    {
        $this->costo = 0;
        if($this->odontogramaDientes->count() > 0) {
            // hay dientes
            foreach ($this->odontogramaDientes as $odontogramaDiente) {
                if ($odontogramaDiente->tieneTratamientos()) {
                    foreach ($odontogramaDiente->getTratamientos() as $tratamiento) {
                        $this->costo += $tratamiento->getDienteTratamiento()->getCosto();
                    }
                }
            }
        }

        if ($this->tieneOtrosTratamientos()) {
            foreach ($this->otrosTratamientos as $otroTratamiento) {
                $this->costo += $otroTratamiento->getOtroTratamiento()->getCosto();
            }
        }
    }

    /**
     * agregar un tratamiento al diente especificado
     * @param int $numero
     * @param DientePlan $dientePlan
     * @throws Exception
     */
    public function agregarTratamiento($numero, DientePlan $dientePlan)
    {
        $odontogramaDiente = $this->obtenerOdontogramaDiente($numero);

        try {
            $odontogramaDiente->agregarTratamiento($dientePlan);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * elimina un tratamiento del diente
     * @param $numero
     * @param DienteTratamiento $dienteTratamiento
     * @throws Exception
     */
    public function eliminarTratamiento($numero, DienteTratamiento $dienteTratamiento)
    {
        $odontogramaDiente = $this->obtenerOdontogramaDiente($numero);

        try {
            $odontogramaDiente->eliminarTratamiento($dienteTratamiento);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * obtener un odontograma diente de la colección
     * @param int $numero
     * @return OdontogramaDiente
     * @throws Exception
     */
    public function obtenerOdontogramaDiente($numero)
    {
        $encontrado = false;

        foreach ($this->odontogramaDientes as $odontogramaDiente) {
            if ($odontogramaDiente->getDiente()->getNumero() === $numero) {
                return $odontogramaDiente;
            }
        }

        if (!$encontrado) {
            throw new Exception('No existe el odontograma diente');
        }
    }

    /**
     * asignar expediente
     * @param ExpedienteJohanna $expedienteJohanna
     */
    public function asignadoA(ExpedienteJohanna $expedienteJohanna)
    {
        $this->expedienteEspecialidad = $expedienteJohanna;
    }

    /**
     * devolver el otro tratamiento
     * @param OtroTratamiento $otroTratamiento
     * @return OdontogramaOtroTratamiento
     * @throws ElOtroTratamientoNoEstaAsignadoAlOdontogramaException
     */
    public function obtenerOtroTratamiento(OtroTratamiento $otroTratamiento)
    {
        foreach ($this->otrosTratamientos as $odontogramaOtroTratamiento) {
            if ($odontogramaOtroTratamiento->getOtroTratamiento()->getId() === $otroTratamiento->getId()) {
                return $odontogramaOtroTratamiento;
            }
        }

        throw new ElOtroTratamientoNoEstaAsignadoAlOdontogramaException('El otro tratamiento especificado no está asignado al odontograma');
    }

    /**
     * verifica si ya esta todo atendido y de estarlo, marca al odontograma
     * como atendido
     * @return bool
     */
    public function verificarSiYaEstaTodoAtendido()
    {
        if ($this->tieneOtrosTratamientos()) {
            foreach ($this->otrosTratamientos as $odontogramaOtroTratamiento) {
                if (!$odontogramaOtroTratamiento->atendido()) {
                    return false;
                }
            }
        }

        foreach ($this->odontogramaDientes as $odontogramaDiente) {
            if ($odontogramaDiente->tieneTratamientos()) {
                foreach ($odontogramaDiente->getTratamientos() as $tratamiento) {
                    if (!$tratamiento->atendido()) {
                        return false;
                    }
                }
            }
        }

        $this->atendido = true;
    }
}