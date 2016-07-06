<?php
namespace Siacme\Infraestructura\Consultas;

use DB;
use Illuminate\Support\Collection;
use Siacme\Dominio\Pacientes\DienteTratamiento;

/**
 * Class DienteTratamientosRepositorioInterface
 * @package Siacme\Infraestructura\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 */
class DienteTratamientosRepositorioLaravelMySQL implements DienteTratamientosRepositorioInterface
{
    /**
     * @return Collection
     */
    public function obtenerDienteTratamientos()
    {
        $listaDienteTratamientos = new Collection();

        try {
            $dienteTratamientos = DB::table('diente_tratamiento')
                ->orderBy('DienteTratamiento')
                ->get();

            $totalDienteTratamientos = count($dienteTratamientos);

            if ($totalDienteTratamientos > 0) {
                foreach ($dienteTratamientos as $dienteTratamientos) {
                    $dienteTratamiento = new DienteTratamiento($dienteTratamientos->idDienteTratamiento, $dienteTratamientos->DienteTratamiento, $dienteTratamientos->Costo);

                    $listaDienteTratamientos->push($dienteTratamiento);
                }

                return $listaDienteTratamientos;
            }

            return null;

        } catch (\PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    /**
     * @param  int $id
     * @return DienteTratamiento
     */
    public function obtenerDienteTratamientoPorId($id)
    {
        try {
            $dienteTratamientos = DB::table('diente_tratamiento')
                ->where('idDienteTratamiento', $id)
                ->orderBy('DienteTratamiento')
                ->first();

            $totalDienteTratamientos = count($dienteTratamientos);

            if ($totalDienteTratamientos > 0) {
                $dienteTratamiento = new DienteTratamiento($dienteTratamientos->idDienteTratamiento, $dienteTratamientos->DienteTratamiento, $dienteTratamientos->Costo);

                return $dienteTratamiento;
            }

            return null;

        } catch (\PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
}