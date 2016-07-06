<?php
namespace Siacme\Infraestructura\Consultas;

use DB;
use Illuminate\Support\Collection;
use Siacme\Dominio\Pacientes\ConvexividadFacial;

/**
 * Class ConvexividadesFacialRepositorioLaravelMySQL
 * @package Siacme\Infraestructura\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 */
class ConvexividadesFacialRepositorioLaravelMySQL
{
    /**
     * @return Collection|null
     */
    public function obtenerTodos()
    {
        try {
            $convexividades = DB::table('convexividad_facial')
                ->orderBy('ConvexividadFacial')
                ->get();

            if (count($convexividades) > 0) {
                $listaConvexividades = new Collection();
                foreach ($convexividades as $convexividades) {
                    $listaConvexividades->push(new ConvexividadFacial($convexividades->idConvexividadFacial, $convexividades->ConvexividadFacial));
                }

                return $listaConvexividades;
            }

            return null;

        } catch(\PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
}