<?php
namespace Siacme\Dominio\Pacientes;

/**
 * Class Domicilio
 * @package Siacme\Dominio\Pacientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class Domicilio
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $direccion;

    /**
     * @var string
     */
    private $cp;

    /**
     * @var string
     */
    private $municipio;

    /**
     * Domicilio constructor.
     * @param string $direccion
     * @param string $cp
     * @param string $municipio
     * @param int|null $id
     */
    public function __construct($direccion, $cp, $municipio, $id = null)
    {
        $this->id        = $id;
        $this->direccion = $direccion;
        $this->cp        = $cp;
        $this->municipio = $municipio;
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
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @return string
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * @return string
     */
    public function getMunicipio()
    {
        return $this->municipio;
    }
}