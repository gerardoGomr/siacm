<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class OtroTratamiento
 * @package Siacme\Dominio\Expedientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class OtroTratamiento
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $tratamiento;

    /**
     * @var double
     */
    private $costo;

    /**
     * OtroTratamiento constructor.
     * @param int $id
     * @param string $tratamiento
     * @param float $costo
     */
    public function __construct($id = null, $tratamiento = null, $costo = null)
    {
        $this->id          = $id;
        $this->tratamiento = $tratamiento;
        $this->costo       = $costo;
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
    public function getTratamiento()
    {
        return $this->tratamiento;
    }

    /**
     * @return float
     */
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * costo a dos decimales
     * @return string
     */
    public function costo()
    {
        return '$' . number_format($this->costo, 2);
    }
}