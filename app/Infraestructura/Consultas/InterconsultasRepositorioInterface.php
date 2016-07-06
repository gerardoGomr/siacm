<?php
namespace Siacme\Infraestructura\Consultas;

/**
 * Interface InterconsultasRepositorioInterface
 * @package Siacme\Infraestructura\Consultas
 * @author Gerardo Adrián Gómez Ruiz
 */
interface InterconsultasRepositorioInterface
{
    /**
     * @param int $id
     * @return Interconsulta
     */
    public function obtenerPorId($id);
}