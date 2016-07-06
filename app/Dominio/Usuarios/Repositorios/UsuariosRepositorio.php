<?php
namespace Siacme\Dominio\Usuarios\Repositorios;

/**
 * Interface UsuariosRepositorio
 * @package Siacme\Dominio\Usuarios
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
interface UsuariosRepositorio
{
    /**
     * obtener un usuario por su username
     * @param $username
     * @return Usuario
     */
    public function obtenerPorUsername($username);
}