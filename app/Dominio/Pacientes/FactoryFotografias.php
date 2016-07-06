<?php
namespace Siacme\Dominio\Pacientes;

/**
 * Class FactoryFotografias
 * @package Siacme\Dominio\Pacientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class FactoryFotografias
{
	public static function crearFotografia(array $files = null, $ruta = '')
	{
		if(!is_null($files)) {

			return new FotografiaTrabajador($files['tmp_name'], true, $files);
		}

		return new FotografiaTrabajador($ruta);
	}
}