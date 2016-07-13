<?php
namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use Siacme\Infraestructura\Pacientes\DoctrinePacientesRepositorio;
use App;

class PacientesRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Siacme\Dominio\Pacientes\Repositorios\PacientesRepositorio', function() {
            return new DoctrinePacientesRepositorio(App::make('Doctrine\ORM\EntityManagerInterface'));
        });
    }
}
