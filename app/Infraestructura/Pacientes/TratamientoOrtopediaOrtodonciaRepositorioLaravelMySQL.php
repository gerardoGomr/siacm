<?php
namespace Siacme\Infraestructura\Pacientes;

use DB;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Expedientes\TratamientoOdontologia;

/**
 * Class TratamientoOrtopediaOrtodonciaRepositorioLaravelMySQL
 * @package Siacme\Infraestructura\Pacientes
 * @author Gerardo Adrián Gómez Ruiz
 */
class TratamientoOrtopediaOrtodonciaRepositorioLaravelMySQL implements ITratamientoOrtopediaOrtodonciaRepositorio
{

    /**
     * @param TratamientoOdontologia $tratamiento
     * @param Expediente $expediente
     * @return bool
     */
    public function guardar(TratamientoOdontologia $tratamiento, Expediente $expediente)
    {
        // TODO: Implement guardar() method.
        try {

            $idTratamiento = DB::table('tratamiento_ortopedia_ortodoncia')
                ->insertGetId([
                    'idExpediente'      => $expediente->getId(),
                    'Dx'                => $tratamiento->getDx(),
                    'Costo'             => $tratamiento->getCosto(),
                    'Duracion'          => $tratamiento->getDuracion(),
                    'Mensualidades'     => $tratamiento->getMensualidades(),
                    'Activo'            => 1,
                    'FechaModificacion' => date('Y-m-d H:m:i')
                ]);

            foreach ($tratamiento->getListaTratamientos() as $tratamientoOdontologiaTipo) {
                DB::table('tratamiento_ortopedia_ortodoncia_detalle')
                    ->insert([
                        'idOrtopediaOrtodoncia' => $idTratamiento,
                        'Tipo'                  => $tratamientoOdontologiaTipo->getNombre(),
                        'FechaAsignacion'       => date('Y-m-d H:m:i'),
                        'FechaModificacion'     => date('Y-m-d H:m:i')
                    ]);
            }
            return true;
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}