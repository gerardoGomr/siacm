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
     * @var Expediente
     */
    protected $expediente;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return boolean
     */
    public function primeraVez()
    {
        return $this->primeraVez;
    }

    public function expediente(Expediente $expediente)
    {
        $this->expediente = $expediente;
    }
}