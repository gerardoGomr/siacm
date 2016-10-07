<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class AbstractEscalon
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
abstract class AbstractEscalon
{
    /**
     * @var bool
     */
    protected $derecho;

    /**
     * @var bool
     */
    protected $izquierdo;

    /**
     * EscalonMesial constructor.
     * @param bool $derecho
     * @param bool $izquierdo
     */
    public function __construct($derecho, $izquierdo)
    {
        $this->derecho   = $derecho;
        $this->izquierdo = $izquierdo;
    }

    /**
     * @return boolean
     */
    public function derecho()
    {
        return $this->derecho;
    }

    /**
     * @return boolean
     */
    public function izquierdo()
    {
        return $this->izquierdo;
    }


}