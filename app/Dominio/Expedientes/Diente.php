<?php
namespace Siacme\Dominio\Expedientes;

use Siacme\Dominio\Listas\IColeccion;
use Siacme\Exceptions\MasDeDosPadecimientosPorDienteException;
use Siacme\Exceptions\SoloSePermitenDosTratamientosException;
use Siacme\Exceptions\TratamientoNoExisteEnPlanActualException;

/**
 * Class Diente
 *
 * @package Siacme\Dominio\Pacientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class Diente
{
	/**
	 * numero de diente
	 * @var int
	 */
	protected $numero;

    /**
     * @var int el tipo de diente (temporal, permamente)
     */
	protected $tipo;

	const TEMPORALES  = 1;
	const PERMANENTES = 2;

    /**
     * Diente constructor.
     *
     * @param int $numero
     */
	public function __construct($numero)
	{
        $this->numero = $numero;
	}

    /**
     * @return int
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @return int
     */
    public function getTipo(): int
    {
        return $this->tipo;
    }

    /**
     * indica si el diente es temporal
     *
     * @return bool
     */
    public function esTemporal()
    {
        return $this->tipo === self::TEMPORALES;
    }

    /**
     * indica si el diente es permanente
     *
     * @return bool
     */
    public function esPermanente()
    {
        return $this->tipo === self::PERMANENTES;
    }

    /**
     * indica el tipo de diente: temporal o permanente
     *
     * @return string
     */
    public function tipo(): string
    {
        $tipo = '';
        switch ($this->getTipo()) {
            case self::TEMPORALES:
                $tipo = 'TEMPORAL';
                break;

            case self::PERMANENTES:
                $tipo = 'PERMANENTE';
                break;
        }

        return $tipo;
    }
}