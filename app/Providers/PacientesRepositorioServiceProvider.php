<?php
namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use Siacme\Infraestructura\Pacientes\DoctrinePacientesRepositorio;

class PacientesRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Siacme\Dominio\Pacientes\Repositorios\PacientesRepositorio', function($app) {
            return new DoctrinePacientesRepositorio($app['em']);
        });
    }
}
