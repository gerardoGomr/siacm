<?php
namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use Siacme\Infraestructura\Citas\DoctrineCitasRepositorio;

class CitasRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Siacme\Dominio\Citas\Repositorios\CitasRepositorio', function($app) {
            return new DoctrineCitasRepositorio($app['em']);
        });
    }
}
