<?php
namespace Siacme\Servicios\Pacientes;

use Siacme\Dominio\Usuarios\Usuario;
use Siacme\Infraestructura\Pacientes\PacientesJohannaRepositorioLaravelMySQL;
use Siacme\Infraestructura\Pacientes\PacientesRepositorioLaravelMySQL;

class PacientesRepositorioFactory
{
    /**
     * crear nuevo paciente repositorio
     * @param Usuario $medico
     * @return PacientesJohannaRepositorioLaravelMySQL|PacientesRepositorioRigobertoLaravelMysql
     */
    public static function crear(Usuario $medico)
    {
        switch($medico->getUsername()) {
            case 'johanna.vazquez':
                return new PacientesJohannaRepositorioLaravelMySQL(new PacientesRepositorioLaravelMySQL());

            case 'rigoberto.garcia':
                return new PacientesRepositorioRigobertoLaravelMysql();

            default:
                throw new \InvalidArgumentException('Médico inválido');
        }
    }
}