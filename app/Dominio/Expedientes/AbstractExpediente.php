<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class AbstractExpediente
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
abstract class AbstractExpediente
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var bool
     */
    protected $primeraVez;

    /**
     * @return boolean
     */
    public function primeraVez()
    {
        return $this->primeraVez;
    }
}