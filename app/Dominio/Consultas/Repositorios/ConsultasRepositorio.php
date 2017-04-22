<?php
namespace Siacme\Dominio\Consultas\Repositorios;

use DateTime;
use Siacme\Dominio\Consultas\Consulta;
use Siacme\Dominio\Repositorios\Repositorio;

/**
 * Interface ConsultasRepositorio
 *
 * @package Siacme\Dominio\Consultas\Repositorios
 * @category Repositorio
 * @author Gerardo Adrián Gómez Ruiz
 */
interface ConsultasRepositorio extends Repositorio
{
    /**
     * obtener lista de consultas no pagadas del día
     *
     * @param DateTime $fecha
     * @return array
     */
    public function obtenerConsultasNoPagadasDelDia(DateTime $fecha);

    /**
     * persistir cambios en el repositorio
     *
     * @param Consulta $consulta
     * @return bool
     */
    public function persistir(Consulta $consulta);
}