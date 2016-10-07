<?php
namespace Siacme\Dominio\Expedientes;

use Siacme\Dominio\Listas\IColeccion;

/**
 * Class PlanTratamientoDiente
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class PlanTratamientoDiente
{
    /**
     * @var PlanTratamiento
     */
    private $planTratamiento;

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
     * PlanTratamientoDiente constructor.
     * @param PlanTratamiento $planTratamiento
     * @param Diente $diente
     */
    public function __construct(PlanTratamiento $planTratamiento, Diente $diente, IColeccion $padecimientos, IColeccion $tratamientos)
    {
        $this->planTratamiento = $planTratamiento;
        $this->diente          = $diente;

    }

    /**
     * @return PlanTratamiento
     */
    public function getPlanTratamiento()
    {
        return $this->planTratamiento;
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
}