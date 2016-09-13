<?php
namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use Siacme\Infraestructura\Expedientes\DoctrineDientePadecimientosRepositorio;
use App;

class DientePadecimientosRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Siacme\Dominio\Expedientes\Repositorios\DientePadecimientosRepositorio', function() {
            return new DoctrineDientePadecimientosRepositorio(App::make('Doctrine\ORM\EntityManagerInterface'));
        });
    }
}
