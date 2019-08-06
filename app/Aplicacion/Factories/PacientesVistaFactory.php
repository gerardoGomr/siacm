<?php
namespace Siacme\Aplicacion\Factories;

use Siacme\Aplicacion\Servicios\Expedientes\AnexosUploader;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Usuarios\Usuario;

/**
 * Class PacientesVistaFactory
 * @package Siacme\Aplicacion\Factories
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class PacientesVistaFactory
{
    public static function make(Usuario $medico, Expediente $expediente, AnexosUploader $anexosUploader, $anexos)
    {
        $vista = '';
        $categorias = \DB::table('anexo_categoria')->get();
        $planesCirugia = [];

        switch($medico->getId()) {
            // johanna
            case Usuario::JOHANNA:
                $vista = 'pacientes.pacientes_johanna_detalle';
                break;

            case Usuario::RIGOBERTO:
                $vista = 'pacientes.pacientes_rigoberto_detalle';
                $planesCirugia = \Siacme\PlanCirugia::where('ExpedienteRigobertoId', $expediente->getId())
                    ->get();
                break;
        }
        
        return view($vista, compact('expediente', 'medico', 'anexosUploader', 'categorias', 'anexos', 'planesCirugia'));
    }
}