<?php
namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use Siacme\Infraestructura\Interconsultas\DoctrineMedicosReferenciaRepositorio;
use App;

class MedicosReferenciaRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Siacme\Dominio\Interconsultas\Repositorios\MedicosReferenciaRepositorio', function() {
            return new DoctrineMedicosReferenciaRepositorio(App::make('Doctrine\ORM\EntityManagerInterface'));
        });
    }
}
