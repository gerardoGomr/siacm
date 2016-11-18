<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class Mordida
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
abstract class Mordida
{
    /**
     * @var bool
     */
    protected $activa;

    /**
     * @var double
     */
    protected $medida;

    /**
     * Mordida constructor.
     * @param bool $activa
     * @param float $medida
     */
    public function __construct($activa, $medida)
    {
        $this->activa = $activa;
        $this->medida = $medida;
    }

    /**
     * @return boolean
     */
    public function activa()
    {
        return $this->activa;
    }

    /**
     * @return float
     */
    public function getMedida()
    {
        return $this->medida;
    }

    /**
     * valor formateado de la modida
     * @return string
     */
    public function medidaMordida()
    {
        return (string)$this->medida . ' mm';
    }
}