<?php
namespace Siacme\Dominio\Citas;

use Siacme\Dominio\Usuarios\Usuario;
use Siacme\Dominio\Pacientes\Paciente;

/**
 * Class Cita
 * @package Siacme\Dominio\Citas
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
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
	 * @var Usuario
	 */
	private $medico;

	/**
	 * @var CitaEstatus
	 */
	private $estatus;

	/**
	 * @var Paciente
	 */
	private $paciente;

	/**
	 * @var string
	 */
	private $comentario;

	/**
	 * Cita constructor.
	 * @param string $comentario
	 * @param Paciente $paciente
	 * @param null $id
	 */
	public function __construct($comentario, Paciente $paciente = null, $id = null)
	{
		$this->comentario = $comentario;
		$this->paciente   = $paciente;
		$this->id         = $id;
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
	 * @return Usuario
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
	 * @return Paciente
	 */
	public function getPaciente()
	{
		return $this->paciente;
	}

	/**
	 * @return string
	 */
	public function getComentario()
	{
		return $this->comentario;
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
	public function atendida()
	{
		if ($this->estatus->getId() === 4) {
			return true;
		}
		return false;
	}
}