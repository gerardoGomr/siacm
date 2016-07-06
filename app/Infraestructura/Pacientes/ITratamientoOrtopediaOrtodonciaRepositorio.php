<?php
namespace Siacme\Infraestructura\Pacientes;

use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Expedientes\TratamientoOdontologia;

/**
 * Interface ITratamientoOrtopediaOrtodonciaRepositorio
 * @package Siacme\Infraestructura\Pacientes
 * @author Gerardo Adrián Gómez Ruiz
 */
interface ITratamientoOrtopediaOrtodonciaRepositorio
{
    /**
     * @param TratamientoOdontologia $tratamiento
     * @param Expediente $expediente
     * @return bool
     */
    public function guardar(TratamientoOdontologia $tratamiento, Expediente $expediente);
}