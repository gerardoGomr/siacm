<?php
namespace Siacme\Infraestructura\Consultas;

use DB;
use Illuminate\Support\Collection;
use Siacme\Dominio\Consultas\ConsultaCosto;

/**
 * Class ConsultasCostosRepositorioLaravelMySQL
 * @package Siacme\Infraestructura\Consultas
 * @author Gerardo Adrián Gómez Ruiz
 */
class ConsultasCostosRepositorioLaravelMySQL implements ConsultasCostosRepositorioInterface
{
    /**
     * obtener la lista de costos de consulta
     * @return Collection|null
     */
    public function obtenerCostos()
    {
        // TODO: Implement obtenerCostos() method.
        $listaCostos = new Collection();
        try {
            $consultasCostos = DB::table('consulta_costo')
                ->orderBy('Concepto')
                ->get();

            $totalCostos = count($consultasCostos);

            if ($totalCostos === 0) {
                return null;
            }

            foreach ($consultasCostos as $consultasCostos) {
                $listaCostos->push(new ConsultaCosto($consultasCostos->idConsultaCosto, $consultasCostos->Concepto, $consultasCostos->Costo));
            }

            return $listaCostos;

        } catch (\PDOException $e) {
            return null;
        }
    }
}