<?php
namespace Siacme\Dominio\Pacientes;

use Siacme\Dominio\Personas\Persona;

/**
 * Class Paciente
 * @package Siacme\Dominio\Pacientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class Paciente extends Persona
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var Domicilio
     */
    protected $domicilio;

    /**
     * @var string
     */
    protected $fechaNacimiento;

    /**
     * @var int
     */
    protected $edadAnios;

    /**
     * @var int
     */
    protected $edadMeses;

    /**
     * @var string
     */
    protected $lugarNacimiento;

    /**
     * Paciente constructor.
     * @param string $nombre
     * @param string $paterno
     * @param string $materno
     * @param string $telefono
     * @param string $celular
     * @param string $email
     */
    public function __construct($nombre, $paterno, $materno, $telefono, $celular, $email)
    {
        $this->telefono = $telefono;
        $this->celular  = $celular;
        $this->email    = $email;

        parent::__construct($nombre, $paterno, $materno);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Domicilio
     */
    public function getDomicilio()
    {
        return $this->domicilio;
    }

    /**
     * @return string
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * @return int
     */
    public function getEdadAnios()
    {
        return $this->edadAnios;
    }

    /**
     * @return int
     */
    public function getEdadMeses()
    {
        return $this->edadMeses;
    }

    /**
     * @return string
     */
    public function getLugarNacimiento()
    {
        return $this->lugarNacimiento;
    }

    public function edadCompleta()
    {

    }
}