<?php
namespace Siacme\Http\Controllers\Reportes;

use Illuminate\Http\Request;
use Siacme\Dominio\Consultas\Repositorios\ConsultasRepositorio;
use Siacme\Dominio\Expedientes\Repositorios\ExpedientesRepositorio;
use Siacme\Dominio\Usuarios\Repositorios\UsuariosRepositorio;
use Siacme\Http\Controllers\Controller;

/**
 * Class ReportesController
 *
 * @package Siacme\Http\Controllers\Reportes
 * @category Controller
 * @author  Gerardo Adrián Gómez Ruiz <gerardo.gomr@gmail.com>
 */
class ReportesController extends Controller
{
    /**
     * @var UsuariosRepositorio
     */
    protected $usuariosRepositorio;

    /**
     * @var ExpedientesRepositorio
     */
    protected $expedientesRepositorio;

    /**
     * ConsultasController constructor.
     *
     * @param UsuariosRepositorio $usuariosRepositorio
     * @param ExpedientesRepositorio $expedientesRepositorio
     */
    public function __construct(UsuariosRepositorio $usuariosRepositorio, ExpedientesRepositorio $expedientesRepositorio)
    {
        $this->usuariosRepositorio    = $usuariosRepositorio;
        $this->expedientesRepositorio = $expedientesRepositorio;
    }

    /**
     * mostrar vista de reporte de cobros de consulta
     *
     * @param string $medicoId
     * @return mixed
     */
    public function vistaCobroConsultas($medicoId)
    {
        $medico = $this->usuariosRepositorio->obtenerPorId((int)base64_decode($medicoId));

        return view('reportes.cobro_consultas', compact('medico'));
    }

    public function cobroConsultas(Request $request, ConsultasRepositorio $consultasRepositorio)
    {
        $response = ['estatus' => 'success'];
        $medico = $this->usuariosRepositorio->obtenerPorId((int)base64_decode($request->get('medicoId')));
        $fecha  = $request->get('fecha');

        $consultas        = $consultasRepositorio->obtenerPorFechaYMedico($fecha, $medico);
        $response['view'] = view('reportes.cobro_consultas_resultados', compact('consultas', 'fecha'))->render();

        return response()->json($response);
    }
}