<?php
namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use Doctrine\ORM\EntityManagerInterface;
use Siacme\Infraestructura\Usuarios\DoctrineUsuariosRepositorio;
use App;

class UsuariosRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Siacme\Dominio\Usuarios\Repositorios\UsuariosRepositorio', function() {
            return new DoctrineUsuariosRepositorio(App::make('Doctrine\ORM\EntityManagerInterface'));
        });
    }
}