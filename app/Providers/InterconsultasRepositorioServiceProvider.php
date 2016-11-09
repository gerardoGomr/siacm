<?php
namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use Siacme\Infraestructura\Interconsultas\DoctrineInterconsultasRepositorio;

class InterconsultasRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Siacme\Dominio\Interconsultas\Repositorios\InterconsultasRepositorio', function($app) {
            return new DoctrineInterconsultasRepositorio($app['em']);
        });
    }
}
