<?php
namespace Siacme\Dominio\Expedientes;

use Siacme\Dominio\Listas\IColeccion;
use Siacme\Exceptions\MasDeDosPadecimientosPorDienteException;
use Siacme\Exceptions\SoloSePermitenDosTratamientosException;
use Siacme\Exceptions\TratamientoNoExisteEnPlanActualException;

/**
 * Class Diente
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
     * Diente constructor.
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
}