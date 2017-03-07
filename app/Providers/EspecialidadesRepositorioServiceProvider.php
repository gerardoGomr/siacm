<?php

namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use Siacme\Dominio\Usuarios\Repositorios\EspecialidadesRepositorio;
use Siacme\Infraestructura\Usuarios\DoctrineEspecialidadesRepositorio;

class EspecialidadesRepositorioServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EspecialidadesRepositorio::class, function($app) {
            return new DoctrineEspecialidadesRepositorio($app['em']);
        });
    }
}
