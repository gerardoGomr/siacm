<?php
namespace Siacme\Infraestructura\Consultas;

use Siacme\Dominio\Consultas\Consulta;

/**
 * Interface ConsultasRepositorioInterface
 * @package Siacme\Infraestructura\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 */
interface ConsultasRepositorioInterface
{
    /**
     * @param Consulta $consulta
     * @return bool
     */
    public function persistir(Consulta $consulta);
}