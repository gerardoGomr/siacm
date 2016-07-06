<?php
namespace Siacme\Infraestructura\Pacientes;

use DB;
use Illuminate\Support\Collection;
use Siacme\Dominio\Pacientes\DientePadecimiento;

/**
 * Class PadecimientosDentalesRepositorioInterface
 * @package Siacme\Infraestructura\Pacientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class PadecimientosDentalesRepositorioMySQL implements PadecimientosDentalesRepositorioInterface
{
    /**
     * obtener todos los padecimientos dentales
     * @return Collection
     */
    public function obtenerPadecimientos()
    {
        $listaPadecimientos = new Collection();

        try {

            $padecimientos = DB::table('diente_padecimiento')
                ->where('idDientePadecimiento', '<>', 1)
                ->orderBy('DientePadecimiento')
                ->get();

            $totalPadecimientos = count($padecimientos);

            if ($totalPadecimientos > 0) {
                foreach ($padecimientos as $padecimientos) {
                    $padecimiento = new DientePadecimiento($padecimientos->idDientePadecimiento, $padecimientos->DientePadecimiento, $padecimientos->RutaImagen);

                    $listaPadecimientos->push($padecimiento);
                }

                return $listaPadecimientos;
            }

            return null;

        } catch (\PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    /**
     * obtener un padecimiento en base a su id
     * @param int $id
     * @return DientePadecimiento
     */
    public function obtenerPadecimientoPorId($id)
    {
        try {
            $padecimientos = DB::table('diente_padecimiento')
                ->where('idDientePadecimiento', $id)
                ->first();

            $totalPadecimientos = count($padecimientos);

            if ($totalPadecimientos > 0) {
                $padecimiento = new DientePadecimiento($padecimientos->idDientePadecimiento, $padecimientos->DientePadecimiento, $padecimientos->RutaImagen);
                return $padecimiento;
            }

            return null;

        } catch (\PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
}