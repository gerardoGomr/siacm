<?php
namespace Siacme\Dominio\Pacientes;

use DateTime;
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
     * @var DateTime
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
     * @return string|null
     */
    public function getFechaNacimiento()
    {
        return !is_null($this->fechaNacimiento) ? $this->fechaNacimiento->format('Y-m-d') : null;
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

    /**
     * edad completa del paciente
     * @return string
     */
    public function edadCompleta()
    {
        if (is_null($this->fechaNacimiento)) {
            return '-';
        }

        $this->calcularEdad();
        return $this->edadAnios > 1 ? (string)$this->edadAnios . ' años, ' . (string)$this->edadMeses. ' meses' : (string)$this->edadAnios . ' año, ' . (string)$this->edadMeses. ' meses';
    }

    /**
     * actualizar los datos personales del paciente
     * @param string $nombre
     * @param string $paterno
     * @param string $materno
     * @param DateTime $fechaNacimiento
     * @param string $lugarNacimiento
     * @param string $telefono
     * @param string $celular
     * @param string $email
     * @param Domicilio $domicilio
     */
    public function agregarDatosPersonales($nombre, $paterno, $materno, DateTime $fechaNacimiento, $lugarNacimiento, $telefono, $celular, $email, Domicilio $domicilio)
    {
        if ($this->nombre !== $nombre) {
            $this->nombre = $nombre;
        }

        if ($this->paterno !== $paterno) {
            $this->paterno = $paterno;
        }

        $this->materno         = $materno;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->lugarNacimiento = $lugarNacimiento;
        $this->telefono        = $telefono;
        $this->celular         = $celular;
        $this->email           = $email;
        $this->domicilio       = $domicilio;

        // obtener la edad del paciente
        $this->calcularEdad();
    }

    /**
     * calcula la edad del paciente en base a su fecha de nacimiento
     * obtiene la diferencia en años y meses
     */
    private function calcularEdad()
    {
        $fechaActual = new DateTime();
        $interval    = $fechaActual->diff($this->fechaNacimiento);

        $this->edadAnios = $interval->y;
        $this->edadMeses = $interval->m;
    }
}