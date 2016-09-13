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
    protected $listaTratamientos;

    /**
     * @var bool
     */
    protected $existe;

    /**
     * Diente constructor.
     * @param int $numero
     * @param bool|true $existe
     */
	public function __construct($numero, IColeccion $padecimientos = null)
	{
        $this->numero        = $numero;
        $this->padecimientos = $padecimientos;
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
//    /**
//     * @return Collection
//     */
//    public function getListaTratamientos()
//    {
//        return $this->listaTratamientos;
//    }
//
//    /**
//     * @param Collection $listaTratamientos
//     */
//    public function setListaTratamientos(Collection $listaTratamientos)
//    {
//        $this->listaTratamientos = $listaTratamientos;
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
//        if(is_null($this->listaTratamientos)) {
//            $this->listaTratamientos = new Collection();
//        }
//
//        /*if (count($this->listaTratamientos) === 2) {
//            throw new \Exception('Solo se permiten hasta dos tratamientos por diente');
//        }*/
//
//        // si ya está ocupada la posición, la elimina para permitir agregar uno nuevo
//        if ($this->listaTratamientos->has($indice)) {
//            $this->listaTratamientos->forget($indice);
//        }
//
//        $this->listaTratamientos->put($indice, $tratamiento);
//    }
//
//    /**
//     * remover todos los tratamientos del diente
//     */
//    public function removerTratamientos()
//    {
//        $this->listaTratamientos = null;
//    }
//
//    /**
//     * devolver un padecimiento en base a su id
//     * @param $id
//     * @return DientePlan
//     */
//    public function tratamiento($id)
//    {
//        foreach ($this->listaTratamientos as $tratamiento) {
//
//            if($tratamiento->getId() === $id) {
//                return $tratamiento;
//            }
//        }
//
//        return null;
//    }
//
//    public function tieneTratamientos()
//    {
//        return count($this->listaTratamientos) > 0 ? true : false;
//    }
//
//    public function costoTratamientos()
//    {
//        $costo = null;
//        if ($this->tieneTratamientos()) {
//            foreach ($this->listaTratamientos as $dientePlan) {
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
//            foreach ($this->listaTratamientos as $dientePlan) {
//                $dientePlan->atender();
//            }
//        }
//    }
}