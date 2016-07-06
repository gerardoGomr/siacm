<?php
namespace Siacme\Infraestructura\Consultas;

/**
 * Interface DienteTratamientosRepositorioInterface
 * @package Siacme\Infraestructura\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 */
interface DienteTratamientosRepositorioInterface
{
    /**
     * @return Collection
     */
    public function obtenerDienteTratamientos();

    /**
     * @param  int $id
     * @return DienteTratamiento
     */
    public function obtenerDienteTratamientoPorId($id);
}