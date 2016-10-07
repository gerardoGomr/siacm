<?php
namespace Siacme\Dominio\Expedientes;

use Siacme\Dominio\Listas\IColeccion;
use Siacme\Exceptions\MasDeDosPadecimientosPorDienteException;
use Siacme\Exceptions\SoloSePermitenDosTratamientosException;
use Siacme\Exceptions\TratamientoNoExisteEnPlanActualException;

/**
 * Class Diente
 * @package Siacme\Dominio\Pacientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class Diente
{
	/**
	 * numero de diente
	 * @var int
	 */
	protected $numero;

	/**
	 * padecimientos del diente
	 * @var IColeccion
	 */
	protected $padecimientos;

    /**
     * tratamientos del diente
     * @var IColeccion
     */
    protected $tratamientos;

    /**
     * @var bool
     */
    protected $existe;

    /**
     * Diente constructor.
     * @param int $numero
     * @param IColeccion|null $padecimientos
     * @param IColeccion|null $tratamientos
     */
	public function __construct($numero, IColeccion $padecimientos = null, IColeccion $tratamientos = null)
	{
        $this->numero        = $numero;
        $this->padecimientos = $padecimientos;
        $this->tratamientos  = $tratamientos;
	}

    /**
     * @return int
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @return IColeccion
     */
    public function getPadecimientos()
    {
        return $this->padecimientos;
    }

   /**
    * remover todos los padecimientos del diente
    */
   public function removerPadecimientos()
   {
       $this->padecimientos->clear();
   }

   /**
    * agrega un nuevo padecimiento al diente
    * @param DientePadecimiento $padecimiento
    * @throws MasDeDosPadecimientosPorDienteException
    */
   public function agregarPadecimiento(DientePadecimiento $padecimiento)
   {
       if (count($this->padecimientos) > 2) {
           throw new MasDeDosPadecimientosPorDienteException('Solo se permiten hasta dos padecimientos');
       }
       $this->padecimientos[] = $padecimiento;
   }

//    /**
//     * indica si el tipo de diente es de leche o permanente
//     * @return string
//     */
//    public function tipo()
//    {
//        if ($this->numero >= 51) {
//            return 'Leche';
//        }
//
//        return 'Permanente';
//    }
//
    /**
     * @return IColeccion
     */
    public function getTratamientos()
    {
        return $this->tratamientos;
    }

    /**
     * agregar nuevo tratamiento al diente
     * @param DienteTratamiento $tratamiento
     * @throws SoloSePermitenDosTratamientosException
     */
    public function agregarTratamiento(DienteTratamiento $tratamiento)
    {
        if ($this->tratamientos->count() === 2) {
            throw new SoloSePermitenDosTratamientosException('Solo se permiten hasta dos tratamientos por diente');
        }

        $this->tratamientos->add($tratamiento);
    }

    /**
     * remover todos los tratamientos del diente
     */
    public function removerTratamientos()
    {
        if (!is_null($this->tratamientos)) {
            $this->tratamientos->clear();
        }
    }

    /**
     * comprueba que el tratamiento esté asignado al diente
     * @param DienteTratamiento $dienteTratamiento
     * @return bool
     */
    public function tieneElTratamientoAsignado(DienteTratamiento $dienteTratamiento)
    {
        foreach ($this->tratamientos as $dientePlan) {
            if ($dientePlan->getDienteTratamiento()->getId() === $dienteTratamiento->getId()) {
                return true;
            }
        }

        return false;
    }

    /**
     * eliminar el tratamiento especificado
     * @param DienteTratamiento $dienteTratamiento
     * @throws TratamientoNoExisteEnPlanActualException
     */
    public function eliminarTratamiento(DienteTratamiento $dienteTratamiento)
    {
        $encontrado = false;
        foreach ($this->tratamientos as $dientePlan) {
            if ($dientePlan->getDienteTratamiento()->getId() === $dienteTratamiento->getId()) {
                $key = $this->tratamientos->key();

                $this->tratamientos->remove($key);
                $encontrado = true;
            }
        }

        if (!$encontrado) {
            throw new TratamientoNoExisteEnPlanActualException('El tratamiento especificado no existe en el plan actual.');
        }
    }

    /**
     * @return bool
     */
    public function tieneTratamientos()
    {
        return count($this->tratamientos) > 0 ? true : false;
    }

    /**
     * @return bool
     */
    public function tienePadecimientos()
    {
        return count($this->padecimientos) > 0 ? true : false;
    }
//
//    public function costoTratamientos()
//    {
//        $costo = null;
//        if ($this->tieneTratamientos()) {
//            foreach ($this->tratamientos as $dientePlan) {
//                $costo += $dientePlan->getDienteTratamiento()->getCosto();
//            }
//        }
//
//        return $costo;
//    }
//
//    public function atenderTratamientos()
//    {
//        if ($this->tieneTratamientos()) {
//            foreach ($this->tratamientos as $dientePlan) {
//                $dientePlan->atender();
//            }
//        }
//    }
}