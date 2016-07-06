<?php
namespace Siacme\Infraestructura\Pacientes;

/**
 * Interface MarcaPastaRepositorioInterface
 * @package Siacme\Infraestructura\Expedientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
interface MarcaPastaRepositorioInterface
{
	/**
	 * @param null $parametros
	 * @return Collecion
	 */
	public function obtenerMarcaPastas($parametros = null);
}