<?php
namespace Siacme\Servicios\Consultas;
use Illuminate\Http\Request;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Infraestructura\Expedientes\ExpedientesRepositorioInterface;

/**
 * Class ConsultasElementosServicio
 * @package Siacme\Servicios\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 */
class ConsultasElementosServicio
{
    /**
     * @var ExpedientesRepositorioInterface
     */
    private $expedientesRepositorio;

    /**
     * ConsultasElementosServicio constructor.
     * @param ExpedientesRepositorioInterface $expedientesRepositorio
     */
    public function __construct(ExpedientesRepositorioInterface $expedientesRepositorio)
    {
        $this->expedientesRepositorio = $expedientesRepositorio;
    }

    /**
     * verificar la creación de elementos durante una consulta
     * @param Request $request
     * @param Expediente $expediente
     * @return bool
     */
    public function verificarElementosCreadosEnConsulta(Request $request, Expediente $expediente)
    {
        switch ($expediente->getMedico()->getUsername()) {
            case 'johanna.vazquez':
                // odontograma
                if ($request->session()->has('odontograma')) {
                    $odontograma = $request->session()->get('odontograma');
                    $expediente->agregarOdontograma($odontograma);
                }

                // plan de tratamiento
                if ($request->session()->has('plan')) {
                    $planTratamiento = $request->session()->get('plan');
                    $expediente->agregarPlanTratamiento($planTratamiento);
                }

                break;

            default:

                break;
        }

        // guardar la información
        return $this->expedientesRepositorio->guardarElementosDeConsulta($expediente);
    }
}