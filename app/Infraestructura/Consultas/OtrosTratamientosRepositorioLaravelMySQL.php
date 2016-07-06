<?php
namespace Siacme\Infraestructura\Consultas;

use \DB;
use Illuminate\Support\Collection;
use Siacme\Dominio\Consultas\OtroTratamiento;

/**
 * Class OtrosTratamientosRepositorioInterface
 * @package Siacme\Infraestructura\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 */
class OtrosTratamientosRepositorioLaravelMySQL implements OtrosTratamientosRepositorioInterface
{
    /**
     * obtener una lista de otros tratamientos
     * @return Collection
     */
    public function obtenerOtrosTratamientos()
    {
        try {

            $otrosTratamientos = DB::table('plan_otro_tratamiento')
                ->orderBy('OtroTratamiento')
                ->get();

            $totalOtrosTratamientos = count($otrosTratamientos);

            if ($totalOtrosTratamientos > 0) {
                $listaOtrosTratamientos = new Collection();
                foreach ($otrosTratamientos as $otrosTratamientos) {
                    $otroTratamiento = new OtroTratamiento($otrosTratamientos->idOtroTratamiento, $otrosTratamientos->OtroTratamiento, $otrosTratamientos->Costo);

                    $listaOtrosTratamientos->push($otroTratamiento);
                }

                return $listaOtrosTratamientos;
            }

            return null;

        } catch (\PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    /**
     * @param int $id
     * @return OtroTratamiento
     */
    public function obtenerOtroTratamientoPorId($id)
    {
        try {

            $otrosTratamientos = DB::table('plan_otro_tratamiento')
                ->where('idOtroTratamiento', $id)
                ->first();

            $totalOtrosTratamientos = count($otrosTratamientos);

            if ($totalOtrosTratamientos > 0) {
                $otroTratamiento = new OtroTratamiento($otrosTratamientos->idOtroTratamiento, $otrosTratamientos->OtroTratamiento, $otrosTratamientos->Costo);

                return $otroTratamiento;
            }

            return null;

        } catch (\PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
}