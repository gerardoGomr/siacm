<?php
namespace Siacme\Servicios\Expedientes;

use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Pacientes\Paciente;
use Siacme\Dominio\Usuarios\Usuario;
use Siacme\Infraestructura\Pacientes\MarcaPastaRepositorioInterface;
use Siacme\Infraestructura\Pacientes\PadecimientoRepositorioInterface;
use Siacme\Trastornos\TrastornoRepositorioInterface;
use View;
/**
* @author Gerardo Adrián Gómez Ruiz
* @version 1.0
* @date    25/08/2015
*/

class FabricaExpedientesVistasVer
{
	/**
	 * @param Paciente   $paciente
	 * @param Usuario    $medico
	 * @param Expediente $expediente
	 * @param array|null $listaPadecimientos
	 * @param array|null $listaTrastornos
	 * @param array|null $listaMarcas
	 * @return ExpedienteOtorrino
	 * @throws \Exception
	 */
	public static function construirVista(Paciente $paciente, Usuario $medico, Expediente $expediente = null, $listaPadecimientos = null, $listaTrastornos = null, $listaMarcas = null)
	{
		switch ($medico->getUsername()) {
			case 'johanna.vazquez':
				// odontopediatría
				return View::make('expedientes.expediente_odontopediatria_ver', compact('expediente', 'paciente', 'medico'));
				break;

			case 1:
				return new ExpedienteOtorrino();
				break;

			default:
				throw new \Exception('Intentando crear una vista inexistente');
				break;
		}
	}
}