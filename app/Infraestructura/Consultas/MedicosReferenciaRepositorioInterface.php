<?php
namespace Siacme\Infraestructura\Consultas;

/**
 * Interface MedicosReferenciaRepositorioInterface
 * @package Siacme\Infraestructura\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 */
interface MedicosReferenciaRepositorioInterface
{
    /**
     * obtener una lista de médicos a los que se les hace referencia
     * @return Collection
     */
    public function obtenerMedicosReferencia();

    /**
     * @param int $id
     * @return MedicoReferencia
     */
    public function obtenerMedicoPorId($id);
}