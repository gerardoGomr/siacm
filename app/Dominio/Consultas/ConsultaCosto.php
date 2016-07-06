<?php
namespace Siacme\Dominio\Consultas;

/**
 * Class ConsultaCosto
 * @package Siacme\Dominio\Consultas
 * @author Gerardo Adrián Gómez Ruiz
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
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getConcepto()
    {
        return $this->concepto;
    }

    /**
     * @param string $concepto
     */
    public function setConcepto($concepto)
    {
        $this->concepto = $concepto;
    }

    /**
     * @return float
     */
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * @param float $costo
     */
    public function setCosto($costo)
    {
        $this->costo = $costo;
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