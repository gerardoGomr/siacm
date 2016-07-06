<?php
namespace Siacme\Infraestructura\Pacientes;

/**
 * Interface PadecimientoRepositorioInterface
 * @package Siacme\Infraestructura\Expedientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
interface PadecimientoRepositorioInterface
{
	/**
	 * @return array
	 */
	public function obtenerPadecimientos();
}