<?php
namespace Siacme\Infraestructura\Consultas;

/**
 * Interface OtrosTratamientosRepositorioInterface
 * @package Siacme\Infraestructura\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 */
interface OtrosTratamientosRepositorioInterface
{
    /**
     * obtener una lista de otros tratamientos
     * @return Collection
     */
    public function obtenerOtrosTratamientos();

    /**
     * @param int $id
     * @return OtroTratamiento
     */
    public function obtenerOtroTratamientoPorId($id);
}