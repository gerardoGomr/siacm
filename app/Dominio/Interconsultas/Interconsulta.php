<?php
namespace Siacme\Dominio\Interconsultas;

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
     * @var Expediente
     */
    private $expediente;

    /**
     * Interconsulta constructor.
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

    /**
     * @return Expediente
     */
    public function getExpediente()
    {
        return $this->expediente;
    }

    /**
     * asignar expediente a la interconsulta
     * @param Expediente $expediente
     */
    public function generadaPara(Expediente $expediente)
    {
        $this->expediente = $expediente;
    }
}