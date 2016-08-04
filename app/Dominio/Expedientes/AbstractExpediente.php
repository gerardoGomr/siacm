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
     * @var bool
     */
    protected $revisado;

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

    /**
     * @return boolean
     */
    public function revisado()
    {
        return $this->revisado;
    }

    /**
     * marcar al expediente como revisado
     */
    public function revisadoPorPaciente()
    {
        $this->revisado = true;
    }

    /**
     * @param Expediente $expediente
     */
    public function expediente(Expediente $expediente)
    {
        $this->expediente = $expediente;
    }

    /**
     * devolver el numero de expediente rellenado con ceros
     * @return string
     */
    public function numero()
    {
        $id         = (string)$this->id;
        $longitudId = strlen($id);
        $max        = 4;
        $numero     = '';

        $diferencia = $max - $longitudId;

        for ($i = 0; $i < $diferencia; $i++) { 
            $numero .= '0';
        }

        $numero .= $id;

        return $numero;
    }
}