<?php

namespace Siacme\Http\Controllers;

use Illuminate\Http\Request;

use Siacme\Http\Requests;
use Siacme\Http\Controllers\Controller;

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
        // print_r($request->session()->all());exit;
        return view('principal');
    }
}
