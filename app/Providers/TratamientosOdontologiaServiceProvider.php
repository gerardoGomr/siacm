<?php

namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use Siacme\Dominio\Expedientes\Repositorios\TratamientosOdontologiaRepositorio;
use Siacme\Infraestructura\Expedientes\DoctrineTratamientosOdontologiaRepositorio;

class TratamientosOdontologiaServiceProvider extends ServiceProvider
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
        $this->app->bind(TratamientosOdontologiaRepositorio::class, function ($app) {
            return new DoctrineTratamientosOdontologiaRepositorio($app['em']);
        });
    }
}
