<?php

namespace Siacme\Http\Controllers\Usuarios;

use Illuminate\Http\Request;
use Siacme\Http\Requests;
use Siacme\Http\Controllers\Controller;
use Siacme\Infraestructura\Usuarios\UsuariosRepositorioInterface;

class LoginController extends Controller
{
    /**
     * mostrar pagina login
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('login');
    }

    /**
     * loguear usuario
     * @param  Request                      $request
     * @param  UsuariosRepositorioInterface $usuariosRepositorio
     * @return View
     */
    public function logueo(Request $request, UsuariosRepositorioInterface $usuariosRepositorio)
    {
        // crear la logica del logueado
        $username = $request->get('txtUsername');
        $passwd   = $request->get('txtPassword');

        $usuario = $usuariosRepositorio->obtenerUsuarioPorUsername($username);

        if(is_null($usuario)) {
            // no existe
            return $this->generaVistaConError();
        }

        if($usuario->compruebaPassword($passwd) === false) {
            return $this->generaVistaConError();
        }

        if($usuario->getActivo() === 0) {
            // usuario inactivo
            return $this->generaVistaConError();
        }

        $request->session()->put('Usuario', $usuario);

        return redirect('/');
    }

    /**
     * cerrar sesión
     * @param  Request $request
     * @return Redirect
     */
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('login');
    }

    /**
     * generar vista con errores de logueo
     * @return View
     */
    public function generaVistaConError()
    {
        return view('login')
            ->with('error', 'Usuario y/o contraseña incorrectos');
    }
}
