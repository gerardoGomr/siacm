<?php
namespace Siacme\Infraestructura\Consultas;

/**
 * Interface RecetasRepositorioInterface
 * @package Siacme\Infraestructura\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 */
interface RecetasRepositorioInterface
{
    /**
     * @return Collection
     */
    public function obtenerRecetas();

    /**
     * @param int $id
     * @return Receta
     */
    public function obtenerPorId($id);
}