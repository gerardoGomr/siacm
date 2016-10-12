<?php
namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use Siacme\Infraestructura\Expedientes\DoctrineDienteTratamientosRepositorio;

class DienteTratamientosRepositorioServiceProvider extends ServiceProvider
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
        //
        $this->app->bind('Siacme\Dominio\Expedientes\Repositorios\DienteTratamientosRepositorio', function($app) {
            return new DoctrineDienteTratamientosRepositorio($app['em']);
        });
    }
}
