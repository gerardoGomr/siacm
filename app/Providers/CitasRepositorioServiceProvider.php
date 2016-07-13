<?php
namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use Siacme\Infraestructura\Citas\DoctrineCitasRepositorio;
use App;

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
        $this->app->bind('Siacme\Dominio\Citas\Repositorios\CitasRepositorio', function() {
            return new DoctrineCitasRepositorio(App::make('Doctrine\ORM\EntityManagerInterface'));
        });
    }
}
