<?php
namespace Siacme\Aplicacion\Factories;

use Siacme\Dominio\Expedientes\Odontograma;
use Siacme\Dominio\Expedientes\Diente;
use Siacme\Aplicacion\ColeccionArray;
use Siacme\Dominio\Expedientes\OdontogramaDiente;

/**
 * Class OdontogramaFactory
 * @package Siacme\Aplicacion\Factories
 * @author  Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class OdontogramaFactory
{
	/**
	 * crear un nuevo odontograma y sus dientes asignados
	 * @return Odontograma
	 */
	public static function crear()
	{
		$odontograma = new Odontograma(new ColeccionArray(), new ColeccionArray());

		self::agregarOdontogramaDientes(11, 18, $odontograma);
        self::agregarOdontogramaDientes(21, 28, $odontograma);
        self::agregarOdontogramaDientes(31, 38, $odontograma);
        self::agregarOdontogramaDientes(41, 48, $odontograma);
        self::agregarOdontogramaDientes(51, 55, $odontograma);
        self::agregarOdontogramaDientes(61, 65, $odontograma);
        self::agregarOdontogramaDientes(71, 75, $odontograma);
        self::agregarOdontogramaDientes(81, 85, $odontograma);

        return $odontograma;
	}

	/**
	 * agregar dientes dependiendo el rango
	 * @param int $inicio
	 * @param int $fin
	 * @param Odontograma $odontograma
	 */
	private static function agregarOdontogramaDientes($inicio, $fin, Odontograma $odontograma)
	{
		for ($numero = $inicio; $numero <= $fin; $numero++) {
			// se agrega un nuevo diente con sus características por default
            $odontogramaDiente = new OdontogramaDiente($odontograma, new Diente($numero), new ColeccionArray(), new ColeccionArray());
			$odontograma->agregarOdontogramaDiente($odontogramaDiente);
		}
	}
}