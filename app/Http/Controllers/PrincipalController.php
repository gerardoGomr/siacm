<?php

namespace Siacme\Http\Controllers;

use Illuminate\Http\Request;

use Siacme\Http\Requests;
use Siacme\Http\Controllers\Controller;

class PrincipalController extends Controller
{
    /**
     * Mostrar pagina principal
     *
     * @return Response
     */
    public function index()
    {
        // print_r($request->session()->all());exit;
        return view('principal');
    }
}
