<?php
namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use App;
use Siacme\Infraestructura\Consultas\DoctrineRecetasRepositorio;

class RecetasRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Siacme\Dominio\Consultas\Repositorios\RecetasRepositorio', function() {
            return new DoctrineRecetasRepositorio(App::make('Doctrine\ORM\EntityManagerInterface'));
        });
    }
}
