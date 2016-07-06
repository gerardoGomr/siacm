<?php
namespace Siacme\Dominio\Citas;

use Siacme\Dominio\Usuarios\Usuario;
use Siacme\Expedientes\Expediente;
use Siacme\Dominio\Pacientes\Paciente;

/**
 * @package Siacme\Citas
 * @author  Gerardo Adrián Gómez Ruiz
 */
class Cita
{
	/**
	 * id de cita
	 * @var int
	 */
	private $id;

	/**
	 * fecha de cita
	 * @var string
	 */
	private $fecha;

	/**
	 * @var string
	 */
	private $hora;

	/**
	 * @var Medico
	 */
	private $medico;

	/**
	 * @var CitaEstatus
	 */
	private $estatus;

	/**
	 * var Paciente
	 */
	private $paciente;

	/**
	 * Cita constructor.
	 * @param null $id
	 */
	public function __construct($id = null)
	{
		$this->id = $id;
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
	public function getFecha()
	{
		return $this->fecha;
	}

	/**
	 * @return string
	 */
	public function getHora()
	{
		return $this->hora;
	}

	/**
	 * @return Medico
	 */
	public function getMedico()
	{
		return $this->medico;
	}

	/**
	 * @return CitaEstatus
	 */
	public function getEstatus()
	{
		return $this->estatus;
	}

	/**
	 * @return Expediente
	 */
	public function getExpediente()
	{
		return $this->expediente;
	}

	/**
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @param string
	 */
	public function setFecha($fecha)
	{
		$this->fecha = $fecha;
	}

	/**
	 * @param string
	 */
	public function setHora($hora)
	{
		$this->hora = $hora;
	}

	/**
	 * @param Usuario $medico
	 */
	public function setMedico(Usuario $medico)
	{
		$this->medico = $medico;
	}

	/**
	 * @param CitaEstatus
	 */
	public function setEstatus(CitaEstatus $citaEstatus)
	{
		$this->estatus = $citaEstatus;
	}

	/**
	 * calcular el fin de la cita en base a la fecha y hora
	 * @return string
	 */
	public function getFinCita()
	{
		//calcular la duracion de la cita
		list($hora, $minuto, $segundo) = explode(":", $this->hora);
		//sumar 30 mun por default
		$finCita = mktime($hora, $minuto + 30, $segundo, 0 ,0 ,0);
		return $this->fecha." ".date("H", $finCita).":".date("i",$finCita).":".date("s",$finCita);
	}

    /**
     * Gets the value of paciente.
     *
     * @return Paciente $paciente
     */
    public function getPaciente()
    {
        return $this->paciente;
    }

    /**
     * Sets the value of paciente.
     *
     * @param mixed $paciente the paciente
     */
    public function setPaciente(Paciente $paciente)
    {
        $this->paciente = $paciente;
    }

    /**
     * verficiar fecha de cita
	 * @return string
     */
    public static function verificaFechaCita($fecha)
    {
		$fechaAModificar = explode('/', $fecha);
		if(count($fechaAModificar) === 3) {
			// fecha con formato dia/mes anio
			return $fechaAModificar[2] . '-' . $fechaAModificar[1] . '-' . $fechaAModificar[0];
		}

		return $fecha;
    }

	/**
	 * verificar si una cita está o no atendida
	 * @return bool
	 */
	public function estaAtendida()
	{
		if ($this->estatus->getId() === 4) {
			return true;
		}
		return false;
	}
}