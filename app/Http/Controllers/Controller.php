<?php

namespace Siacme\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * validar la presencia de la $variable
     *
     * @param $variable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function validarQueryString($variable)
    {
        if (is_null($variable)) {
            return view('errors.503');
        }
    }
}
