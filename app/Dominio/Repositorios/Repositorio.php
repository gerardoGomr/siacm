<?php
namespace Siacme\Dominio\Repositorios;

/**
 * Interface Repositorio
 * @package Siacme\Dominio\Repositorios
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
interface Repositorio
{
    /**
     * @param int $id
     * @return mixed
     */
    public function obtenerPorId($id);

    /**
     * @return array
     */
    public function obtenerTodos();
}