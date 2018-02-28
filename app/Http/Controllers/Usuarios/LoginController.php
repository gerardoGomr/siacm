<?php

namespace Siacme\Http\Controllers\Usuarios;

use Illuminate\Http\Request;
use Siacme\Dominio\Usuarios\Usuario;
use Siacme\Http\Requests;
use Siacme\Http\Controllers\Controller;
use Siacme\Dominio\Usuarios\Repositorios\UsuariosRepositorio;

class LoginController extends Controller
{
    /**
     * mostrar vista para login
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('login');
    }

    /**
     * loguear usuario
     * @param  Request $request
     * @param  UsuariosRepositorio $usuariosRepositorio
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|View
     */
    public function logueo(Request $request, UsuariosRepositorio $usuariosRepositorio)
    {
        // crear la logica del logueado
        $username = $request->get('username');
        $passwd   = $request->get('password');

        $usuario = $usuariosRepositorio->obtenerPorUsername($username);

        if(is_null($usuario)) {
            return $this->generaVistaConError();
        }

        if(!$usuario->login($passwd)) {
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
        return view('login')->with('error', 'Usuario y/o contraseña incorrectos');
    }
}
