<?php

namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use Siacme\Dominio\Consultas\Repositorios\ConsultasRepositorio;
use Siacme\Infraestructura\Consultas\DoctrineConsultasRepositorio;

class ConsultasRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind(ConsultasRepositorio::class, function ($app) {
            return new DoctrineConsultasRepositorio($app['em']);
        });
    }
}
