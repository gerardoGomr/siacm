<?php
namespace Siacme\Dominio\Interconsultas;

use Siacme\Dominio\Fecha;

/**
 * Class Interconsulta
 * @package Siacme\Dominio\Interconsultas
 * @author  Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class Interconsulta
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var MedicoReferencia
     */
    private $medico;

    /**
     * @var string
     */
    private $referencia;

    /**
     * @var string
     */
    private $respuesta;

    /**
     * @var bool
     */
    private $respondida;

    /**
     * Interconsulta constructor.
     * @param int $id
     * @param MedicoReferencia $medico
     * @param string $referencia
     */
    public function __construct(MedicoReferencia $medico, $referencia)
    {
        $this->medico     = $medico;
        $this->referencia = $referencia;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return MedicoReferencia
     */
    public function getMedico()
    {
        return $this->medico;
    }

    /**
     * @return string
     */
    public function getReferencia()
    {
        return $this->referencia;
    }

    /**
     * @return string
     */
    public function getRespuesta()
    {
        return $this->respuesta;
    }

    /**
     * @return boolean
     */
    public function respondida()
    {
        return $this->respondida;
    }

    public function fechaInterconsulta($fecha)
    {

    }
}