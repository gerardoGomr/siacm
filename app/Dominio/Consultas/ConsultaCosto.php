<?php
namespace Siacme\Dominio\Consultas;

/**
 * Class ConsultaCosto
 * @package Siacme\Dominio\Consultas
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class ConsultaCosto
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $concepto;

    /**
     * @var double
     */
    private $costo;

    /**
     * @var bool
     */
    private $asignadoAPrimeraVez;

    /**
     * ConsultaCosto constructor.
     * @param int $id
     * @param string $concepto
     * @param float $costo
     */
    public function __construct($id, $concepto, $costo)
    {
        $this->id       = $id;
        $this->concepto = $concepto;
        $this->costo    = $costo;
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
    public function getConcepto()
    {
        return $this->concepto;
    }

    /**
     * @return float
     */
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * @return boolean
     */
    public function asignadoAPrimeraVez()
    {
        return $this->asignadoAPrimeraVez;
    }

    /**
     * devuelve el costo formateado a dos decimales y con el signo de pesos
     * @return string
     */
    public function costo()
    {
        return '$' . (string) number_format($this->costo, 2);
    }
}