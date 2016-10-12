<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class DientePlan
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class DientePlanPadecimiento
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var DientePadecimiento
     */
    private $dientePadecimiento;

    /**
     * @var Diente
     */
    private $diente;

    /**
     * @var PlanTratamiento
     */
    private $planTratamiento;

    /**
     * constructor
     * @param DientePadecimiento $dientePadecimiento
     * @param Diente $diente
     * @param PlanTratamiento $planTratamiento
     */
	public function __construct(DientePadecimiento $dientePadecimiento, Diente $diente, PlanTratamiento $planTratamiento = null)
	{
        $this->dientePadecimiento = $dientePadecimiento;
        $this->diente             = $diente;
        $this->planTratamiento    = $planTratamiento;
	}

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return DientePadecimiento
     */
    public function getDientePadecimiento()
    {
        return $this->dientePadecimiento;
    }

    /**
     * @return Diente
     */
    public function getDiente()
    {
        return $this->diente;
    }

    /**
     * @return PlanTratamiento
     */
    public function getPlanTratamiento()
    {
        return $this->planTratamiento;
    }

    /**
     * asignar plan de tratamiento
     * @param PlanTratamiento $planTratamiento
     */
    public function asignarPlanTratamiento(PlanTratamiento $planTratamiento)
    {
        $this->planTratamiento = $planTratamiento;
    }
}