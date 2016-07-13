<?php
namespace Siacme\Dominio\Citas\Repositorios;

use Siacme\Dominio\Citas\Cita;
use Siacme\Dominio\Repositorios\Repositorio;
use Siacme\Dominio\Usuarios\Usuario;

/**
 * Interface CitasRepositorio
 * @package Siacme
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
interface CitasRepositorio extends Repositorio
{
    /**
     * @param Cita $cita
     * @return bool
     */
    public function persistir(Cita $cita);

    /**
     * obtener citas por el medico
     * @param Usuario $medico
     * @param string|null $fecha
     * @return array|null
     */
    public function obtenerPorMedico(Usuario $medico, $fecha = null);
}