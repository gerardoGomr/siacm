<?php
namespace Siacme\Infraestructura\Consultas;

/**
 * Interface ConsultasCostosRepositorioInterface
 * @package Siacme\Infraestructura\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 */
interface ConsultasCostosRepositorioInterface
{
    /**
     * obtener lista de costos
     * @return Collection
     */
    public function obtenerCostos();
}