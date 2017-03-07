<?php
namespace Siacme\Dominio\Usuarios\Repositorios;

use Siacme\Dominio\Repositorios\Repositorio;
use Siacme\Dominio\Usuarios\Usuario;

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
     *
     * @param string $username
     * @return Usuario
     */
    public function obtenerPorUsername($username);

    /**
     * persistir un usuario
     * @param Usuario $usuario
     * @return bool
     */
    public function persistir(Usuario $usuario);
}