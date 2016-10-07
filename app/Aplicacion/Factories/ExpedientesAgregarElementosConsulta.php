<?php
namespace Siacme\Aplicacion\Factories;

use Illuminate\Http\Request;
use Siacme\Aplicacion\ColeccionArray;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Usuarios\Usuario;

/**
 * Class ExpedientesAgregarElementosConsulta
 * @package Siacme\Aplicacion\Factories
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class ExpedientesAgregarElementosConsulta
{
    /**
     * generar los elementos de consulta
     * @param Usuario $medico
     * @param Expediente $expediente
     * @param Request $request
     */
    public static function crear(Usuario $medico, Expediente $expediente, Request $request)
    {
        switch ($medico->getId()) {
            case Usuario::JOHANNA:
                $expediente->getExpedienteEspecialidad()->inicializarTemp(new ColeccionArray(), new ColeccionArray());
                if(is_null($expediente->getExpedienteEspecialidad()->obtenerPlanActivo())) {
                    // odontograma y plan de tratamiento
                    if ($request->session()->has('odontograma')) {
                        $odontograma = $request->session()->get('odontograma');
                        $expediente->getExpedienteEspecialidad()->agregarOdontograma($odontograma);
                    }

                    if ($request->session()->has('plan')) {
                        $planTratamiento = $request->session()->get('plan');
                        $expediente->getExpedienteEspecialidad()->agregarPlanTratamiento($planTratamiento);
                    }
                }

                break;
        }
    }
}