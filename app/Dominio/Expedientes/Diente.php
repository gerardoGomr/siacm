<?php
namespace Siacme\Dominio\Expedientes;

use Siacme\Dominio\Listas\IColeccion;
use Siacme\Exceptions\MasDeDosPadecimientosPorDienteException;

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
     * @var Collection
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
//
//    /**
//     * agregar nuevo padecimiento al diente
//     * @param DientePadecimiento $padecimiento
//     * @throws \Exception
//     */
//    public function agregarPadecimiento(DientePadecimiento $padecimiento)
//    {
//        if (count($this->padecimientos) > 2) {
//            throw new \Exception('Solo se permiten hasta dos padecimientos');
//        }
//        $this->padecimientos[] = $padecimiento;
//    }
//
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
//
//    /**
//     * devolver un padecimiento en base a su id
//     * @param $id
//     * @return DientePadecimiento
//     */
//    public function padecimiento($id)
//    {
//        foreach ($this->padecimientos as $padecimiento) {
//
//            if($padecimiento->getId() === $id) {
//                return $padecimiento;
//            }
//        }
//
//        return null;
//    }
//
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
//
//    /**
//     * @param Collection $tratamientos
//     */
//    public function setListaTratamientos(Collection $tratamientos)
//    {
//        $this->tratamientos = $tratamientos;
//    }
//
//    /**
//     * agregar nuevo tratamiento al diente
//     * @param int $indice
//     * @param DientePlan $tratamiento
//     * @throws \Exception
//     */
//    public function agregarTratamiento($indice, DientePlan $tratamiento)
//    {
//        if(is_null($this->tratamientos)) {
//            $this->tratamientos = new Collection();
//        }
//
//        /*if (count($this->tratamientos) === 2) {
//            throw new \Exception('Solo se permiten hasta dos tratamientos por diente');
//        }*/
//
//        // si ya está ocupada la posición, la elimina para permitir agregar uno nuevo
//        if ($this->tratamientos->has($indice)) {
//            $this->tratamientos->forget($indice);
//        }
//
//        $this->tratamientos->put($indice, $tratamiento);
//    }
//
    /**
     * remover todos los tratamientos del diente
     */
    public function removerTratamientos()
    {
        if (!is_null($this->tratamientos)) {
            $this->tratamientos->clear();
        }
    }
//
//    /**
//     * devolver un padecimiento en base a su id
//     * @param $id
//     * @return DientePlan
//     */
//    public function tratamiento($id)
//    {
//        foreach ($this->tratamientos as $tratamiento) {
//
//            if($tratamiento->getId() === $id) {
//                return $tratamiento;
//            }
//        }
//
//        return null;
//    }
//
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