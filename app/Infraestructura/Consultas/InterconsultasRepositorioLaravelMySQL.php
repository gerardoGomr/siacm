<?php
namespace Siacme\Infraestructura\Consultas;

use DB;
use Siacme\Dominio\Interconsultas\Interconsulta;
use Siacme\Dominio\Interconsultas\MedicoReferencia;
use Siacme\Dominio\Usuarios\Especialidad;

/**
 * Class InterconsultasRepositorioLaravelMySQL
 * @package Siacme\Infraestructura\Consultas
 * @author Gerardo Adrián Gómez Ruiz
 */
class InterconsultasRepositorioLaravelMySQL implements InterconsultasRepositorioInterface
{
    /**
     * @param int $id
     * @return Interconsulta
     */
    public function obtenerPorId($id)
    {
        // TODO: Implement obtenerPorId() method.
        try {
            $interconsultas = DB::table('interconsulta')
                ->join('medico_referencia', 'medico_referencia.idMedicoReferencia', '=', 'interconsulta.idMedicoReferencia')
                ->join('especialidad', 'especialidad.idEspecialidad', '=', 'medico_referencia.idEspecialidad')
                ->where('idInterconsulta', $id)
                ->first();

            $totalRecetas = count($interconsultas);

            if ($totalRecetas > 0) {
                return new Interconsulta(
                    $interconsultas->idInterconsulta,
                    new MedicoReferencia(
                        $interconsultas->idMedicoReferencia,
                        $interconsultas->Direccion,
                        new Especialidad(
                            $interconsultas->idEspecialidad,
                            $interconsultas->Especialidad
                        )
                    ),
                    $interconsultas->Referencia
                );
            }

            return null;

        } catch (\PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
}