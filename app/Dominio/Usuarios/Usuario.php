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
	 * @var int
	 */
	protected $id;

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
	 * @var Especialidad
	 */
	protected $especialidad;

	/**
	 * Constructor Usuario
	 * @param string $username
	 */
	public function __construct($username = '')
	{
		$this->username = $username;
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
	 * realizar el login del usuario
	 * @param string $passwd
	 * @return bool
	 */
	public function login($passwd)
	{
		if(!$this->compruebaPassword($passwd)) {
			return false;
		}

		if(!$this->activo) {
			// usuario inactivo
			return false;
		}

		return true;
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

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

    /**
     * Gets the nombre de usuario.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Gets the contraseña.
     *
     * @return string
     */
    public function getPasswd()
    {
        return $this->passwd;
    }

    /**
     * Gets the activo el usuario.
     *
     * @return bool
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Gets the tipo de usuario.
     *
     * @return UsuarioTipo
     */
    public function getUsuarioTipo()
    {
        return $this->usuarioTipo;
    }

    /**
     * Gets the value of especialidad.
     *
     * @return Especialidad
     */
    public function getEspecialidad()
    {
        return $this->especialidad;
    }
}