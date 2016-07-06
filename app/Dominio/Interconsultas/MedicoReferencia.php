<?php
namespace Siacme\Dominio\Interconsultas;
use Siacme\Dominio\Personas\Persona;
use Siacme\Dominio\Usuarios\Especialidad;

/**
 * Class MedicoReferencia
 * @package Siacme\Dominio\Interconsultas
 * @author  Gerardo Adrián Gómez Ruiz
 */
class MedicoReferencia extends Persona
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
     * @var Especialidad
     */
    private $especialidad;

    /**
     * MedicoReferencia constructor.
     * @param int $id
     * @param string $direccion
     * @param Especialidad $especialidad
     */
    public function __construct($id = null, $direccion = null, Especialidad $especialidad = null)
    {
        $this->id           = $id;
        $this->direccion    = $direccion;
        $this->especialidad = $especialidad;

        parent::__construct();
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
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param string $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * @return Especialidad
     */
    public function getEspecialidad()
    {
        return $this->especialidad;
    }

    /**
     * @param Especialidad $especialidad
     */
    public function setEspecialidad($especialidad)
    {
        $this->especialidad = $especialidad;
    }
}