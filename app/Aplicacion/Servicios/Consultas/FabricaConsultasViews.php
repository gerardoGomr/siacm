<?php
namespace Siacme\Servicios\Consultas;

use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Servicios\DibujadorInterface;
use View;

/**
* @author Gerardo Adrián Gómez Ruiz
*/
class FabricaConsultasViews
{
	/**
	 * @param Expediente $expediente
	 * @param string $idCita
	 * @param DibujadorInterface|null $dibujadorOdontograma
	 * @param null $listaComportamientosFrankl
	 * @param null $listaPadecimientos
	 * @param null $listaRecetas
	 * @param null $listaMedicos
	 * @param null $listaMorfologiasCraneofacial
	 * @param null $listaMorfologiasFacial
	 * @param null $listaConvexividades
	 * @param null $listaAtms
	 * @param null $listaCostosConsultas
	 * @param null|DibujadorInterface $dibujadorPlan
	 * @return ExpedienteOtorrino
	 * @throws \Exception
	 * @internal param null $listaCostoConsultas
	 */
	public static function construirVista(Expediente $expediente, $idCita, DibujadorInterface $dibujadorOdontograma = null, $listaComportamientosFrankl = null, $listaPadecimientos = null, $listaRecetas = null, $listaMedicos = null, $listaMorfologiasCraneofacial = null, $listaMorfologiasFacial = null, $listaConvexividades = null, $listaAtms = null, $listaCostosConsultas = null, DibujadorInterface $dibujadorPlan = null)
	{
		switch ($expediente->getMedico()->getUsername()) {
			case 'johanna.vazquez':
				// odontopediatría
				return View::make('consultas.consultas_odontopediatria_capturar', compact('expediente', 'idCita', 'dibujadorOdontograma', 'listaComportamientosFrankl', 'listaPadecimientos', 'listaRecetas', 'listaMedicos', 'listaMorfologiasCraneofacial', 'listaMorfologiasFacial', 'listaConvexividades', 'listaAtms', 'listaCostosConsultas', 'dibujadorPlan'));
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