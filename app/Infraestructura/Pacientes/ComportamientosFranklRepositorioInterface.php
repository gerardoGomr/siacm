<?php
namespace Siacme\Infraestructura\Pacientes;

/**
 * Interface ComportamientosFranklRepositorioInterface
 * @package Siacme\Infraestructura\Pacientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
interface ComportamientosFranklRepositorioInterface
{
    /**
     * obtener la lista de comportamientos frankl
     * @return array
     */
    public function obtenerComportamientos();
}