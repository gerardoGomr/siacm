<?php
namespace Siacme\Dominio\Usuarios\Repositorios;
use Siacme\Dominio\Repositorios\Repositorio;

/**
 * Interface UsuariosRepositorio
 * @package Siacme\Dominio\Usuarios
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
interface UsuariosRepositorio extends Repositorio
{
    /**
     * obtener un usuario por su username
     * @param $username
     * @return Usuario
     */
    public function obtenerPorUsername($username);
}