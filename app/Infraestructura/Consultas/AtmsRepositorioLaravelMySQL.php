<?php
namespace Siacme\Infraestructura\Consultas;

use DB;
use Illuminate\Support\Collection;
use Siacme\Dominio\Pacientes\ATM;
use Siacme\Dominio\Pacientes\ConvexividadFacial;

/**
 * Class AtmsRepositorioLaravelMySQL
 * @package Siacme\Infraestructura\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 */
class AtmsRepositorioLaravelMySQL
{
    /**
     * @return Collection|null
     */
    public function obtenerTodos()
    {
        try {
            $atms = DB::table('atm')
                ->orderBy('ATM')
                ->get();

            if (count($atms) > 0) {
                $listaAtms = new Collection();
                foreach ($atms as $atms) {
                    $listaAtms->push(new ATM($atms->idATM, $atms->ATM));
                }

                return $listaAtms;
            }

            return null;

        } catch(\PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
}