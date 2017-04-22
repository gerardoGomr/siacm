<?php
namespace Siacme\Dominio\Expedientes\Repositorios;

use Siacme\Dominio\Expedientes\TratamientoOdontologia;
use Siacme\Dominio\Repositorios\Repositorio;

/**
 * Interface TratamientosOdontologiaRepositorio
 *
 * @package Siacme\Dominio\Expedientes\Repositorios
 * @category Repositorio
 * @author Gerardo Adrián Gómez Ruiz <gerardo.gomr@gmail.com>
 */
interface TratamientosOdontologiaRepositorio extends Repositorio
{
    /**
     * persistir cambios en la base de datos
     *
     * @param TratamientoOdontologia $tratamientoOdontologia
     * @return bool
     */
    public function persistir(TratamientoOdontologia $tratamientoOdontologia);
}