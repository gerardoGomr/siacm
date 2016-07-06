<?php
namespace Siacme\Dominio\Pacientes;

/**
 * Class DienteTratamiento
 * @package Siacme\Dominio\Pacientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class DienteTratamiento
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
     * DienteTratamiento constructor.
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
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTratamiento()
    {
        return $this->tratamiento;
    }

    /**
     * @param string $tratamiento
     */
    public function setTratamiento($tratamiento)
    {
        $this->tratamiento = $tratamiento;
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
}