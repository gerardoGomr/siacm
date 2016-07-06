<?php
namespace Siacme\Dominio\Interconsultas;
use Illuminate\Support\Collection;
use Siacme\Dominio\Fecha;

/**
 * Class Interconsulta
 * @package Siacme\Dominio\Interconsultas
 * @author  Gerardo Adrián Gómez Ruiz
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
     * @var Collection
     */
    private $listaAnexos;

    /**
     * Interconsulta constructor.
     * @param int $id
     * @param MedicoReferencia $medico
     * @param string $referencia
     */
    public function __construct($id, MedicoReferencia $medico, $referencia)
    {
        $this->id         = $id;
        $this->medico     = $medico;
        $this->referencia = $referencia;

        if (is_null($this->listaAnexos)) {
            $this->listaAnexos = new Collection();
        }
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return MedicoReferencia
     */
    public function getMedico()
    {
        return $this->medico;
    }

    /**
     * @param MedicoReferencia $medico
     */
    public function setMedico($medico)
    {
        $this->medico = $medico;
    }

    /**
     * @return string
     */
    public function getReferencia()
    {
        return $this->referencia;
    }

    /**
     * @param string $referencia
     */
    public function setReferencia($referencia)
    {
        $this->referencia = $referencia;
    }

    /**
     * @return string
     */
    public function getRespuesta()
    {
        return $this->respuesta;
    }

    /**
     * @param string $respuesta
     */
    public function setRespuesta($respuesta)
    {
        $this->respuesta = $respuesta;
    }

    /**
     * @return boolean
     */
    public function respondida()
    {
        return $this->respondida;
    }

    /**
     * @param boolean $respondida
     */
    public function setRespondida($respondida)
    {
        $this->respondida = $respondida;
    }

    /**
     * @return Collection
     */
    public function getListaAnexos()
    {
        return $this->listaAnexos;
    }

    /**
     * @param Collection $listaAnexos
     */
    public function setListaAnexos($listaAnexos)
    {
        $this->listaAnexos = $listaAnexos;
    }

    public function fechaInterconsulta($fecha)
    {
        return Fecha::convertir($fecha);
    }
}