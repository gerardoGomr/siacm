<?php
namespace Siacme\Dominio\Pacientes\Repositorios;

use Siacme\Dominio\Repositorios\Repositorio;
use Siacme\Dominio\Pacientes\Paciente;

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

    /**
     * actualizar paciente
     * @param Paciente $paciente
     * @return bool
     */
    public function persistir(Paciente $paciente);
}