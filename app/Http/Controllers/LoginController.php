<?php
namespace Siacme\Http\Controllers;

use Siacme\Usuarios\UsuariosRepositorioInterface;

class LoginController
{
    /**
     * procesar el logueo de un usuario
     * @param  string                       $username
     * @param  UsuariosRepositorioInterface $usuariosRepositorio
     * @return mixed Usuario $usuario or false
     */
    public function postLogin($username, $passwd, UsuariosRepositorioInterface $usuariosRepositorio)
    {
        $usuario = $usuariosRepositorio->obtenerUsuarioPorUsername($username);

        // var_dump($usuario);exit;
        // echo md5($passwd);exit;
        // var_dump(md5($passwd));exit;

        if($usuario->registrado() === false) {
            // no existe
            return false;
        }

        if($usuario->compruebaPassword(md5($passwd)) === false) {
            return false;
        }

        if($usuario->getActivo() === 0) {
            // usuario inactivo
            return false;
        }

        return $usuario;
    }
}