<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class EscalonMesial
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class EscalonMesial
{
    /**
     * @var bool
     */
    private $derecho;

    /**
     * @var bool
     */
    private $izquierdo;

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


}