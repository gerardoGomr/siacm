<?php
namespace Siacme\Dominio\Personas;

/**
 * Class Persona
 * @package Siacme\Dominio\Personas
 * @author  Gerardo Adrián Gómez Ruiz
 */
abstract class Persona
{
	/**
	 * nombre de persona
	 * @var string
	 */
	protected $nombre;

	/**
	 * apellido paterno de persona
	 * @var string
	 */
	protected $paterno;

	/**
	 * apellido materno de persona
	 * @var string
	 */
	protected $materno;

    /**
     * el sexo de la persona
     * @var string
     */
    protected $sexo;

    /**
     * telefono de la persona
     * @var string
     */
    protected $telefono;

    /**
     * celular de la persona
     * @var string
     */
    protected $celular;

    /**
     * correo de la persona
     * @var string
     */
    protected $email;

	public function __construct($nombre, $paterno, $materno)
	{
        $this->nombre   = $nombre;
        $this->paterno  = $paterno;
        $this->materno  = $materno;
	}

	/**
     * Gets the nombre del funcionario.
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Gets the apellido paterno del funcionario.
     *
     * @return string
     */
    public function getPaterno()
    {
        return $this->paterno;
    }

    /**
     * Gets the apellido materno del funcionario.
     *
     * @return string
     */
    public function getMaterno()
    {
        return $this->materno;
    }

    /**
     * obtener el nombre completo del funcionario
     * @return string
     */
    public function nombreCompleto()
    {
        $nombre = $this->nombre;

        if(strlen($this->paterno)) {
            $nombre .= ' '.$this->paterno;
        }

        if(strlen($this->materno)) {
            $nombre .= ' '.$this->materno;
        }

        return $nombre;
    }

    /**
     * Gets the el sexo de la persona.
     *
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Gets the telefono de la persona.
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Gets the celular de la persona.
     *
     * @return string
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Gets the correo de la persona.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * asignar datos personales de la persona
     *
     * @param string $nombre
     * @param string $paterno
     * @param string $materno
     */
    public function asignarDatosPersonales($nombre, $paterno, $materno)
    {
        $this->nombre  = $nombre;
        $this->paterno = $paterno;
        $this->materno = $materno;
    }

    /**
     * asignar datos de contacto de la persona
     *
     * @param string $telefono
     * @param string $celular
     * @param string $email
     */
    public function asignarDatosDeContacto($telefono, $celular, $email)
    {
        $this->telefono = $telefono;
        $this->celular  = $celular;
        $this->email    = $email;
    }

    /**
     * Revisa si la persona tiene un teléfono
     * 
     * @return bool
     */
    public function tieneTelefono()
    {
        return strlen($this->telefono) > 0;
    }

    /**
     * Revisa si la persona tiene un celular
     * 
     * @return bool
     */
    public function tieneCelular()
    {
        return strlen($this->celular) > 0;
    }
}