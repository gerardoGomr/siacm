<?php
namespace Siacme\Infraestructura\Pacientes;

use DB;
use Siacme\Dominio\Pacientes\MarcaPasta;

/**
 * Class MarcaPastaRepositorioLaravelMySQL
 * @package Siacme\Infraestructura\Expedientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class MarcaPastaRepositorioLaravelMySQL implements MarcaPastaRepositorioInterface
{
	/**
	 * @param null $parametros
	 * @return Collecion
	 */
	public function obtenerMarcaPastas($parametros = null)
	{
		$listaMarcas = array();

		try {
			$marcas = DB::table('marca_pasta')
				->select('idMarcaPasta', 'MarcaPasta')
				->get();

			$totalMarcas = count($marcas);

			if($totalMarcas > 0) {

				foreach ($marcas as $marcas) {
					$marcaPasta = new MarcaPasta();
					$marcaPasta->setId($marcas->idMarcaPasta);
					$marcaPasta->setMarcaPasta($marcas->MarcaPasta);

					$listaMarcas[] = $marcaPasta;
				}

				return $listaMarcas;
			}

			return null;
		} catch(Exception $e) {

			return null;
		}
	}
}