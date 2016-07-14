<?php
namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use Siacme\Infraestructura\Expedientes\DoctrineExpedientesRepositorio;
use App;

class ExpedientesRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Siacme\Dominio\Expedientes\Repositorios\ExpedientesRepositorio', function() {
            return new DoctrineExpedientesRepositorio(App::make('Doctrine\ORM\EntityManagerInterface'));
        });
    }
}