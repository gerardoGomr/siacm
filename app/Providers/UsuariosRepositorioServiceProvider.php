<?php
namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use Siacme\Infraestructura\Usuarios\DoctrineUsuariosRepositorio;

class UsuariosRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Siacme\Dominio\Usuarios\Repositorios\UsuariosRepositorio', function($app) {
            return new DoctrineUsuariosRepositorio($app['em']);
        });
    }
}