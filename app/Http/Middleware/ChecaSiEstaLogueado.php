<?php

namespace Siacme\Http\Middleware;

use Closure;

class ChecaSiEstaLogueado
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // verificar que exista el usuario en sesion,
        // caso contrario enviar a login
        if(!$request->session()->has('Usuario')) {
            return redirect('login');
        }

        return $next($request);
    }
}
