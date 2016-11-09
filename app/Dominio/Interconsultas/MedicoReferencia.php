<?php
namespace Siacme\Dominio\Interconsultas;

use Siacme\Dominio\Personas\Persona;
use Siacme\Dominio\Usuarios\Especialidad;

/**
 * Class MedicoReferencia
 * @package Siacme\Dominio\Interconsultas
 * @author  Gerardo Adrián Gómez Ruiz
 * @version 1.0
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
     * @return Especialidad
     */
    public function getEspecialidad()
    {
        return $this->especialidad;
    }
}