<?php
namespace Siacme\Infraestructura\Expedientes;

use Siacme\Dominio\Consultas\PlanTratamiento;

/**
 * Interface PlanTratamientoRepositorioInterface
 * @package Siacme\Infraestructura\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 */
interface PlanTratamientoRepositorioInterface
{
    /**
     * @param PlanTratamiento $plan
     * @return mixed
     */
    public function actualizarAtencionTratamiento(PlanTratamiento $plan);

    /**
     * obtener un plan por su id
     * @param $id
     * @return PlanTratamiento
     */
    public function obtenerPorId($id);
}