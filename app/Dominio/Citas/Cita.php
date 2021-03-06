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
	 * @var int
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
	 */
	public function __construct($comentario = null, Paciente $paciente = null)
	{
		$this->comentario = $comentario;
		$this->paciente   = $paciente;
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
	 * @return int
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
	 * calcular el fin de la cita en base a la fecha y hora. Cada 15 minutos
	 *
	 * @return string
	 */
	public function getFinCita()
	{
		//calcular la duracion de la cita
		list($hora, $minuto, $segundo) = explode(":", $this->hora);
		//sumar 30 mun por default
		$finCita = mktime($hora, $minuto + 15, $segundo, 0 ,0 ,0);
		return $this->fecha." ".date("H", $finCita).":".date("i",$finCita).":".date("s",$finCita);
	}


    /**
     * verficar fecha de cita
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
		if ($this->estatus === CitaEstatus::ATENDIDA) {
			return true;
		}

		return false;
	}

	/**
	 * el estatus de la cita
	 * @return string
	 */
	public function estatus()
	{
		$estatus = '';

		switch ($this->estatus) {
			case CitaEstatus::AGENDADA:
				$estatus = 'Agendada';
				break;

			case CitaEstatus::CONFIRMADA:
				$estatus = 'Confirmada';
				break;

			case CitaEstatus::CANCELADA:
				$estatus = 'Cancelada';
				break;

			case CitaEstatus::EN_ESPERA_CONSULTA:
				$estatus = 'En espera de consulta';
				break;

            case CitaEstatus::ATENDIDA:
                $estatus = 'Atendida';
                break;

            case CitaEstatus::CANCELADA_INASISTENCIA:
                $estatus = 'Inasistencia';
                break;
		}

		return $estatus;
	}

	/**
	 * @param string $fecha
	 * @param string $hora
	 * @param Paciente $paciente
	 * @param Usuario $medico
	 */
	public function agendar($fecha, $hora, Paciente $paciente, Usuario $medico)
	{
		$this->fecha    = $fecha;
		$this->hora     = $hora;
		$this->paciente = $paciente;
		$this->medico   = $medico;
		$this->estatus  = CitaEstatus::AGENDADA;
	}

	/**
	 * pasar cita a estatus confirmada
	 */
	public function confirmar()
	{
		$this->estatus = CitaEstatus::CONFIRMADA;
	}

	/**
	 * pasar cita a estatus cancelada
	 */
	public function cancelar()
	{
		$this->estatus = CitaEstatus::CANCELADA;
	}

    /**
     * marcar como espera de consulta
     */
	public function enEsperaDeConsulta()
	{
		$this->estatus = CitaEstatus::EN_ESPERA_CONSULTA;
	}

    /**
     * se registra el estatus
     * @param int $accion
     */
    public function registrarEstatus($accion)
    {
        switch ($accion) {
            case CitaEstatus::CONFIRMADA:
                $this->confirmar();
                break;

            case CitaEstatus::CANCELADA:
                $this->cancelar();
                break;

            case CitaEstatus::EN_ESPERA_CONSULTA:
                $this->enEsperaDeConsulta();
                break;

            case CitaEstatus::CANCELADA_INASISTENCIA:
            	$this->inasistencia();
            	break;
        }
    }

	/**
	 * reprogramar la fecha y hora de cita
	 * @param string $fecha
	 * @param string $hora
	 */
	public function reprogramar($fecha, $hora)
	{
		$this->fecha = $fecha;
		$this->hora  = $hora;
	}

	public function getColor()
	{
		$color = '';

		switch ($this->estatus) {
			case CitaEstatus::AGENDADA:
				$color = '#A0E1FF';
				break;

			case CitaEstatus::CONFIRMADA:
				$color = '#F8F7A1';
				break;

			case CitaEstatus::CANCELADA:
				$color = '#B0263B';
				break;

			case CitaEstatus::CANCELADA_INASISTENCIA:
				$color = '#CBA7D0';
				break;

			case CitaEstatus::EN_ESPERA_CONSULTA:
				$color = '#F8C1A1';
				break;

			case CitaEstatus::ATENDIDA:
				$color = '#AAEAB1';
				break;
		}

		return $color;
	}

	/**
	 * marcar la cita como atendida
	 */
	public function atender()
	{
		$this->estatus = CitaEstatus::ATENDIDA;
	}

	/**
	 * marcar como inasistencia
	 *
	 * @return void
	 */
	public function inasistencia()
	{
		$this->estatus = CitaEstatus::CANCELADA_INASISTENCIA;
	}
}