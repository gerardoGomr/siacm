<?php
namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use Siacme\Infraestructura\Consultas\DoctrineConsultaCostosRepositorio;

class ConsultaCostosRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Siacme\Dominio\Consultas\Repositorios\ConsultaCostosRepositorio', function($app) {
            return new DoctrineConsultaCostosRepositorio($app['em']);
        });
    }
}
