<?php
namespace Siacme\Infraestructura\Pacientes;

/**
 * Interface PadecimientosDentalesRepositorioInterface
 * @package Siacme\Infraestructura\Pacientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
interface PadecimientosDentalesRepositorioInterface
{
    /**
     * obtener todos los padecimientos dentales
     * @return Collection
     */
    public function obtenerPadecimientos();

    /**
     * obtener un padecimiento en base a su id
     * @param int $id
     * @return DientePadecimiento
     */
    public function obtenerPadecimientoPorId($id);
}