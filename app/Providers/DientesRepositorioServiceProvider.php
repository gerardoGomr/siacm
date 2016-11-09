<?php
namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use Siacme\Infraestructura\Expedientes\DoctrineDientesRepositorio;

class DientesRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Siacme\Dominio\Expedientes\Repositorios\DientesRepositorio', function($app) {
            return new DoctrineDientesRepositorio($app['em']);
        });
    }
}
