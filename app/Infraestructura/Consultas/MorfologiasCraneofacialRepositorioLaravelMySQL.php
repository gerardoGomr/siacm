<?php
namespace Siacme\Infraestructura\Consultas;

use DB;
use Illuminate\Support\Collection;
use Siacme\Dominio\Pacientes\MorfologiaCraneofacial;

/**
 * Class MorfologiasCraneofacialRepositorioLaravelMySQL
 * @package Siacme\Infraestructura\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 */
class MorfologiasCraneofacialRepositorioLaravelMySQL
{
    /**
     * @return Collection|null
     */
    public function obtenerTodos()
    {
        try {
            $morfologias = DB::table('morfologia_craneofacial')
                ->orderBy('MorfologiaCraneofacial')
                ->get();

            if (count($morfologias) > 0) {
                $listaMorfologias = new Collection();
                foreach ($morfologias as $morfologias) {
                    $listaMorfologias->push(new MorfologiaCraneofacial($morfologias->idMorfologiaCraneofacial, $morfologias->MorfologiaCraneofacial));
                }

                return $listaMorfologias;
            }

            return null;

        } catch(\PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
}