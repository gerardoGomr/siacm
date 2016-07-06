<?php
namespace Siacme\Servicios\Usuarios;

use Siacme\Dominio\Usuarios\Medico;
use Siacme\Dominio\Usuarios\Usuario;

/**
 * Class UsuariosFactory
 * @package Siacme\Servicios\Usuarios
 * @author  Gerardo Adrián Gómez Ruiz
 */
class UsuariosFactory
{
    public static function crear($idEspecialidad, $username)
    {
        if($idEspecialidad === 1) {
            return new Usuario($username);
        }

        $usuario = new Medico($username);
        $usuario->setEspecialidad(new Especialidad($usuarioBD->idEspecialidad, $usuarioBD->Especialidad));
        return new Medico($username);
    }
}