<?php
namespace Siacme\Infraestructura\Consultas;

use DB;
use Illuminate\Support\Collection;
use Siacme\Dominio\Pacientes\MorfologiaFacial;

/**
 * Class MorfologiasFacialRepositorioLaravelMySQL
 * @package Siacme\Infraestructura\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 */
class MorfologiasFacialRepositorioLaravelMySQL
{
    /**
     * @return Collection|null
     */
    public function obtenerTodos()
    {
        try {
            $morfologias = DB::table('morfologia_facial')
                ->orderBy('MorfologiaFacial')
                ->get();

            if (count($morfologias) > 0) {
                $listaMorfologias = new Collection();
                foreach ($morfologias as $morfologias) {
                    $listaMorfologias->push(new MorfologiaFacial($morfologias->idMorfologiaFacial, $morfologias->MorfologiaFacial));
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