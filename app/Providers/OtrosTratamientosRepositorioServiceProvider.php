<?php
namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use App;
use Siacme\Infraestructura\Expedientes\DoctrineOtrosTratamientosRepositorio;

class OtrosTratamientosRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Siacme\Dominio\Expedientes\Repositorios\OtrosTratamientosRepositorio', function() {
            return new DoctrineOtrosTratamientosRepositorio(App::make('Doctrine\ORM\EntityManagerInterface'));
        });
    }
}
