<?php
namespace Siacme\Dominio\Expedientes\Repositorios;

use Siacme\Dominio\Expedientes\Diente;
use Siacme\Dominio\Repositorios\Repositorio;

/**
 * Interface DientesRepositorio
 * @package Siacme\Dominio\Expedientes\Repositorios
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
interface DientesRepositorio extends Repositorio
{
    /**
     * obtener un diente en base al número
     * @param int $numero
     * @return Diente
     */
    public function obtenerPorNumero($numero);
}