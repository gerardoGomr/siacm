<?php
namespace Siacme\Dominio\Expedientes;

use Siacme\Dominio\Listas\IColeccion;
use Siacme\Exceptions\MasDeDosPadecimientosPorDienteException;
use Siacme\Exceptions\SoloSePermitenDosTratamientosException;
use Siacme\Exceptions\TratamientoNoExisteEnPlanActualException;

/**
 * Class OdontogramaDiente
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class OdontogramaDiente
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Odontograma
     */
    private $odontograma;

    /**
     * @var Diente
     */
    private $diente;

    /**
     * @var IColeccion
     */
    private $padecimientos;

    /**
     * @var IColeccion
     */
    private $tratamientos;

    /**
     * OdontogramaDiente constructor.
     * @param Odontograma $odontograma
     * @param Diente $diente
     * @param IColeccion $padecimientos
     * @param IColeccion $tratamientos
     */
    public function __construct(Odontograma $odontograma, Diente $diente, IColeccion $padecimientos, IColeccion $tratamientos)
    {
        $this->odontograma   = $odontograma;
        $this->diente        = $diente;
        $this->padecimientos = $padecimientos;
        $this->tratamientos  = $tratamientos;
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Odontograma
     */
    public function getOdontograma()
    {
        return $this->odontograma;
    }

    /**
     * @return Diente
     */
    public function getDiente()
    {
        return $this->diente;
    }

    /**
     * @return IColeccion
     */
    public function getPadecimientos()
    {
        return $this->padecimientos;
    }

    /**
     * @return IColeccion
     */
    public function getTratamientos()
    {
        return $this->tratamientos;
    }

    /**
     * indica si tiene padecimientos. Revisa que tenga asignado el padecimiento
     * sano. Si lo tiene, el diente no tiene padecimientos.
     *
     * @return bool
     */
    public function tienePadecimientos()
    {
        foreach ($this->padecimientos as $padecimiento) {
            if ($padecimiento->getNombre() === 'Sano') {
                return false;
            }
        }

        return $this->padecimientos->count() > 0;
    }

    /**
     * indica si tiene tratamientos
     * @return bool
     */
    public function tieneTratamientos()
    {
        return $this->tratamientos->count() > 0;
    }

    /**
     * remover padecimientos
     */
    public function removerPadecimientos()
    {
        $this->padecimientos->clear();
    }

    /**
     * agregar un padecimiento
     * @param DientePadecimiento $dientePadecimiento
     * @throws MasDeDosPadecimientosPorDienteException
     */
    public function agregarPadecimiento(DientePadecimiento $dientePadecimiento)
    {
        if ($this->padecimientos->count() === 2) {
            throw new MasDeDosPadecimientosPorDienteException('No se pueden agregar más de dos padecimientos por diente.');
        }

        $this->padecimientos->add($dientePadecimiento);
    }

    /**
     * remover padecimiento del diente
     * @param DientePadecimiento $dientePadecimiento
     */
    public function removerPadecimiento(DientePadecimiento $dientePadecimiento)
    {
        foreach ($this->padecimientos as $padecimiento) {
            if ($padecimiento->getId() === $dientePadecimiento->getId()) {
                $this->padecimientos->removeElement($padecimiento);
            }
        }
    }

    /**
     * agregar un tratamiento al diente
     * @param DientePlan $dientePlan
     * @throws SoloSePermitenDosTratamientosException
     */
    public function agregarTratamiento(DientePlan $dientePlan)
    {
        if ($this->tratamientos->count() === 2) {
            throw new SoloSePermitenDosTratamientosException('Solo se permiten hasta dos tratamientos por diente.');
        }

        $this->tratamientos->add($dientePlan);
    }

    /**
     * eliminar un tratamiendo del diente
     * @param DienteTratamiento $dienteTratamiento
     * @throws TratamientoNoExisteEnPlanActualException
     */
    public function eliminarTratamiento(DienteTratamiento $dienteTratamiento)
    {
        $encontrado = false;
        foreach ($this->tratamientos as $dientePlan) {
            if ($dientePlan->getDienteTratamiento()->getId() === $dienteTratamiento->getId()) {
                $this->tratamientos->removeElement($dientePlan);
                $encontrado = true;
            }
        }

        if (!$encontrado) {
            throw new TratamientoNoExisteEnPlanActualException('El tratamiento especificado no existe en el odontograma actual.');
        }
    }

    /**
     * se remueve el diente al odontograma diente
     */
    public function removerDiente()
    {
        $this->diente = null;
    }

    /**
     * anexar diente al odontograma diente
     * @param Diente $diente
     */
    public function agregarDiente(Diente $diente)
    {
        $this->diente = $diente;
    }

    /**
     * remover el odontograma
     */
    public function removerOdontograma()
    {
        $this->odontograma = null;
    }

    /**
     * agregar un odontograma
     * @param Odontograma $odontograma
     */
    public function agregarOdontograma(Odontograma $odontograma)
    {
        $this->odontograma = $odontograma;
    }

    /**
     * devuelve el costo de los tratamientos
     * @return double
     */
    public function costoTratamientos()
    {
        $costo = null;
        if ($this->tieneTratamientos()) {
            foreach ($this->tratamientos as $dientePlan) {
                $costo += $dientePlan->getDienteTratamiento()->getCosto();
            }
        }

        return $costo;
    }

    /**
     * se atienden los tratamientos asignados al diente
     */
    public function atenderTratamientos()
    {
        foreach ($this->tratamientos as $dientePlan) {
            $dientePlan->atender();
        }
    }

    /**
     * verifica que el diente tenga todos sus tratamientos atendidos
     * @return bool
     */
    public function tratamientosAtendidos()
    {
        foreach ($this->tratamientos as $dientePlan) {
            if (!$dientePlan->atendido()) {
                return false;
            }
        }

        return true;
    }

    /**
     * devolver la descripcion de costos
     * @return string
     */
    public function descripcionTratamientos()
    {
        $costos = '';

        foreach ($this->tratamientos as $dientePlan) {
            $costos .= $dientePlan->getDienteTratamiento()->getTratamiento() . ': ' . $dientePlan->getDienteTratamiento()->costo() . "\n";
        }

        return $costos;
    }
}