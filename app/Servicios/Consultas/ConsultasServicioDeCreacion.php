<?php
namespace Siacme\Servicios\Consultas;
use Siacme\Dominio\Usuarios\Usuario;
use Siacme\Http\Requests\Request;

/**
 * Class ConsultasServicioDeCreacion
 * @package Siacme\Servicios\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 */
class ConsultasServicioDeCreacion
{
    public static function verificarCreacionDeConsulta(Usuario $medico, Request $request)
    {
        switch($medico->getUsername()) {
            case 'johanna.vazquez':
                // verificar si hay odontograma
                if ($request->session()->has('odontograma')) {
                    $odontograma = $request->session()->get('odontograma');
                    // guardar odontograma en la BD
                }

                // verificar si hay plan de tratamiento
                if ($request->session()->has('plan')) {
                    $planTratamiento = $request->session()->get('plan');
                    // guardar pla de tratamiento en la BD
                }
                break;

            case 'rigoberto.garcia':
                break;

            default:
                throw new \InvalidArgumentException('Médico inválido');
                break;
        }
    }
}