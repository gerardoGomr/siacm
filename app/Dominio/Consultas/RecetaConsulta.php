<?php
namespace Siacme\Dominio\Consultas;

/**
 * Class RecetaConsulta
 * @package Siacme\Dominio\Consultas
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class RecetaConsulta
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $cuerpo;

    /**
     * RecetaConsulta constructor.
     * @param string $cuerpo
     */
    public function __construct($cuerpo)
    {
        $this->cuerpo = $cuerpo;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCuerpo()
    {
        return $this->cuerpo;
    }
}