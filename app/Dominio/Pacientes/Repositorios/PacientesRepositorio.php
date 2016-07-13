<?php
namespace Siacme\Dominio\Pacientes\Repositorios;

use Siacme\Dominio\Repositorios\Repositorio;

/**
 * Interface PacientesRepositorio
 * @package Siacme\Dominio\Pacientes\Repositorios
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
interface PacientesRepositorio extends Repositorio
{
    /**
     * obtener pacientes por nombre
     * @param string $nombre
     * @return array|null
     */
    public function obtenerPorNombre($nombre);
}