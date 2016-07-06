<?php
namespace Siacme\Servicios\Pacientes;

use Siacme\Dominio\Usuarios\Usuario;
use Siacme\Infraestructura\Pacientes\PacientesRepositorioInterface;
/**
 * Class PacientesComplementoFactory
 * @package Siacme\Servicios\Pacientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class PacientesComplementoFactory
{
    public static function crear(Usuario $medico, PacientesRepositorioInterface $pacientesRepositorio)
    {
        switch($medico->getUsername()) {
            case 'johanna.vazquez':
                return new PacientesJohannaComplementoServicio($pacientesRepositorio);

            case 'rigoberto.garcia':
                return new PacientesRepositorioRigobertoLaravelMysql();

            default:
                throw new \InvalidArgumentException('Médico inválido');
        }
    }
}