<?php
namespace Siacme\Dominio\Consultas;

/**
 * Class IndicacionConsulta
 *
 * @package Siacme\Dominio\Consultas
 * @category Domain class
 * @author Gerardo Gomez <gerardo.gomr@gmail.com>
 */
class IndicacionConsulta
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
     * IndicacionConsulta constructor.
     *
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