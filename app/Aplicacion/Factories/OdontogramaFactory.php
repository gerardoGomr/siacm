<?php
namespace Siacme\Aplicacion\Factories;

use Siacme\Dominio\Expedientes\Odontograma;
use Siacme\Dominio\Expedientes\Diente;
use Siacme\Aplicacion\ColeccionArray;

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
		$odontograma = new Odontograma(new ColeccionArray());

		self::agregarDientes(11, 18, $odontograma);
        self::agregarDientes(21, 28, $odontograma);
        self::agregarDientes(31, 38, $odontograma);
        self::agregarDientes(41, 48, $odontograma);
        self::agregarDientes(51, 55, $odontograma);
        self::agregarDientes(61, 65, $odontograma);
        self::agregarDientes(71, 75, $odontograma);
        self::agregarDientes(81, 85, $odontograma);

        return $odontograma;
	}

	/**
	 * agregar dientes dependiendo el rango
	 * @param int $inicio
	 * @param int $fin
	 * @param Odontograma $odontograma
	 */
	private static function agregarDientes($inicio, $fin, Odontograma $odontograma)
	{
		for ($numero = $inicio; $numero <= $fin; $numero++) {
			// se agrega un nuevo diente con sus características por default
			$odontograma->agregarDiente(new Diente($numero, new ColeccionArray()));
		}
	}
}