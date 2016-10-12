<?php
namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use Siacme\Infraestructura\Expedientes\DoctrineComportamientosFranklRepositorio;

class ComportamientosFranklRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Siacme\Dominio\Expedientes\Repositorios\ComportamientosFranklRepositorio', function($app) {
            return new DoctrineComportamientosFranklRepositorio($app['em']);
        });
    }
}
