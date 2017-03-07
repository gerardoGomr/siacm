<?php
namespace Siacme\Dominio\Usuarios;

use DateTime;
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
	 * @var int
	 */
	protected $rol;

	/**
	 * @var Especialidad
	 */
	protected $especialidad;

    /**
     * @var DateTime
     */
	protected $fechaAlta;

    /**
     * @var DateTime
     */
	protected $fechaBaja;

	const JOHANNA   = 2;
	const RIGOBERTO = 3;

    /**
     * Constructor Usuario
     *
     * @param string $username
     * @param string $password
     * @param int $rol
     * @param Especialidad $especialidad
     * @param DateTime $fechaAlta
     */
	public function __construct($username = '', $password, $rol, Especialidad $especialidad, DateTime $fechaAlta)
	{
        $this->username     = $username;
        $this->passwd       = self::encryptaPassword($password);
        $this->rol          = $rol;
        $this->especialidad = $especialidad;
        $this->fechaAlta    = $fechaAlta;
        $this->activo       = true;
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
     * @return int
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * devolver el rol de usuario
     * @return string
     */
    public function rol()
    {
        $rol = '';
        switch ($this->rol) {
            case Rol::MEDICO:
                $rol = 'Médico';
                break;

            case Rol::ASISTENTE:
                $rol = 'Asistente';
                break;

            case Rol::RECEPCIONISTA:
                $rol = 'Recepcionista';
                break;
        }

        return $rol;
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

    /**
     * @return DateTime
     */
    public function getFechaAlta(): DateTime
    {
        return $this->fechaAlta;
    }

    /**
     * @return DateTime
     */
    public function getFechaBaja(): DateTime
    {
        return $this->fechaBaja;
    }

    /**
     * asignar datos de nivel
     *
     * @param Especialidad $especialidad
     * @param $rol
     */
    public function asignarDatosDeNivel(Especialidad $especialidad, $rol)
    {
        $this->especialidad = $especialidad;
        $this->rol          = $rol;
    }

    /**
     * desactivar a un usuario en base a $fechaBaja
     *
     * @param DateTime $fechaBaja
     */
    public function desactivar(DateTime $fechaBaja)
    {
        $this->activo    = false;
        $this->fechaBaja = $fechaBaja;
    }

    /**
     * activar a un usuario
     */
    public function activar()
    {
        $this->activo = true;
    }

    /**
     * asigna una nueva contraseña al usuario
     * 
     * @param string $nuevaContrasenia
     */
    public function cambiarContrasenia($nuevaContrasenia)
    {
        $this->passwd = self::encryptaPassword($nuevaContrasenia);
    }
}