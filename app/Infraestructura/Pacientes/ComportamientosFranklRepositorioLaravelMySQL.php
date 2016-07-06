<?php
namespace Siacme\Infraestructura\Pacientes;

use DB;
use Illuminate\Support\Collection;
use Siacme\Dominio\Pacientes\ComportamientoFrankl;

/**
 * Class ComportamientosFranklRepositorioInterface
 * @package Siacme\Infraestructura\Pacientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class ComportamientosFranklRepositorioLaravelMySQL implements ComportamientosFranklRepositorioInterface
{
    /**
     * obtener la lista de comportamientos frankl
     * @return array
     */
    public function obtenerComportamientos()
    {
        $listaComportamientos = new Collection();

        try {

            $comportamientos = DB::table('comportamiento_frankl')
                ->orderBy('ComportamientoFrankl')
                ->get();

            $totalComportamientos = count($comportamientos);

            if ($totalComportamientos > 0) {

                foreach ($comportamientos as $comportamientos) {
                    $comportamiento = new ComportamientoFrankl($comportamientos->idComportamientoFrankl, $comportamientos->ComportamientoFrankl);
                    $listaComportamientos->push($comportamiento);
                }

                return $listaComportamientos;
            }

            return null;

        } catch (\PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
}