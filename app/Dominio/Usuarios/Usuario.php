<?php
namespace Siacme\Dominio\Usuarios;

use Siacme\Dominio\Personas\Persona;

/**
 * Class Usuario
 * @package Siacme\Dominio\Usuarios
 * @author  Gerardo Adrián Gómez Ruiz
 */
class Usuario extends Persona
{
	/**
	 * nombre de usuario
	 * @var string
	 */
	protected $username;

	/**
	 * contraseña
	 * @var string
	 */
	protected $passwd;

	/**
	 * activo el usuario
	 * @var bool
	 */
	protected $activo;

	/**
	 * tipo de usuario
	 * @var UsuarioTipo
	 */
	protected $usuarioTipo;

	/**
	 * ve si el usuario está o no registrado
	 * @var bool
	 */
	protected $registrado;

	/**
	 * @var string
	 */
	protected $fechaCreacion;

	public function __construct($username = '')
	{
		$this->username = $username;
	}

	//////////////////////////////getters/////////////////////////////
	public function getUsername()
	{
		return $this->username;
	}

	public function getPasswd()
	{
		return $this->passwd;
	}

	public function getActivo()
	{
		return $this->activo;
	}

	public function getUsuarioTipo()
	{
		return $this->usuarioTipo;
	}

	//////////////////////////////SETTERS/////////////////////////////////////
	public function setUsername($username)
	{
		$this->username = $username;
	}

	public function setPasswd($passwd)
	{
		$this->passwd = $passwd;
	}


	public function setActivo($activo)
	{
		$this->activo = $activo;
	}

	public function setUsuarioTipo(UsuarioTipo $usuarioTipo)
	{
		$this->usuarioTipo = $usuarioTipo;
	}

    /**
     * Gets the ve si el usuario está o no registrado.
     *
     * @return bool
     */
    public function registrado()
    {
        return $this->registrado;
    }

    /**
     * Sets the ve si el usuario está o no registrado.
     *
     * @param bool $registrado the registrado
     */
    public function setRegistrado($registrado)
    {
        $this->registrado = $registrado;
    }

    /**
     * @param string
     */
    public function setFechaCreacion($fechaCreacion)
    {
    	$this->fechaCreacion = $fechaCreacion;
    }

    /**
     * @return string
     */
    public function getFechaCreacion()
    {
    	return $this->fechaCreacion;
    }

    /**
     * verifica la contraseña proporcionada
     * contra la seteada al usuario
     * @param  string $pass
     * @return bool
     */
    public function compruebaPassword($pass)
    {
		if(password_verify($pass, $this->passwd)) {
			return true;
		}

		return false;
    }

	/**
	 * encriptar la contraseña proporcionada
	 * @param  string $passwordSinHash
	 * @return string
	 */
	public static function encryptaPassword($passwordSinHash)
	{
		return password_hash($passwordSinHash, PASSWORD_DEFAULT);
	}
}