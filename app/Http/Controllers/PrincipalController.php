<?php

namespace Siacme\Http\Controllers;

use Illuminate\Http\Request;
use Siacme\Dominio\Usuarios\Usuario;
use Siacme\Http\Controllers\Controller;
use Siacme\Http\Requests;

/**
 * Class PrincipalController
 * @package Siacme\Http\Controllers
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class PrincipalController extends Controller
{
    /**
     * vista principal
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = session('Usuario');

        if (is_null($user->getRol())) {
            return view('principal');
        }

        if ($user->getRol() === 1) {
            return redirect('consultas/' . base64_encode(Usuario::JOHANNA));
        }

        if ($user->getRol() === 2) {
            return redirect('consultas/' . base64_encode(Usuario::JOHANNA));
        }

        if ($user->getRol() === 3) {
            return redirect('citas/' . base64_encode(Usuario::JOHANNA));
        }
    }
}
