<?php
namespace Siacme\Http\Controllers\Pacientes;

use Illuminate\Http\Request;
use Siacme\Dominio\Expedientes\TratamientoOdontologia;
use Siacme\Dominio\Pacientes\Anexo;
use Siacme\Http\Requests;
use Siacme\Http\Controllers\Controller;
use Siacme\Infraestructura\Consultas\InterconsultasRepositorioInterface;
use Siacme\Infraestructura\Consultas\RecetasRepositorioInterface;
use Siacme\Infraestructura\Expedientes\PlanTratamientoRepositorioInterface;
use Siacme\Infraestructura\Pacientes\ITratamientoOrtopediaOrtodonciaRepositorio;
use Siacme\Infraestructura\Usuarios\UsuariosRepositorioInterface;
use Siacme\Reportes\Consultas\InterconsultaJohanna;
use Siacme\Reportes\Consultas\PlanTratamientoJohanna;
use Siacme\Reportes\Consultas\RecetaJohanna;
use Siacme\Servicios\Expedientes\AnexosUploader;
use Siacme\Servicios\Pacientes\PacientesRepositorioFactory;
use Siacme\Infraestructura\Expedientes\ExpedientesRepositorioInterface;

/**
 * @package Siacme\Http\Controllers\Pacientes;
 * @author Gerardo Adrián Gómez Ruiz
 */
class PacientesController extends Controller
{
    /**
     * @var UsuariosRepositorioInterface
     */
    private $usuariosRepositorio;

    /**
     * PacientesController constructor.
     * @param UsuariosRepositorioInterface $usuariosRepositorio
     */
    public function __construct(UsuariosRepositorioInterface $usuariosRepositorio)
    {
        $this->usuariosRepositorio = $usuariosRepositorio;
    }

    /**
     * Mostrar vista para busqueda de pacientes y ver detalles
     * @param $userMedico
     * @return View
     * @internal param UsuariosRepositorioInterface $usuariosRepositorio
     */
    public function index($userMedico)
    {
        // obtener el medico
        if(is_null($medico = $this->usuariosRepositorio->obtenerUsuarioPorUsername($userMedico))) {
            return view('error');
        }

        return view('pacientes.pacientes', compact('medico'));
    }

    /**
     * buscar un paciente
     * @param Request $request
     * @return View
     */
    public function buscar(Request $request)
    {
        $dato    = $request->get('txtPaciente');
        $usuario = $request->get('username');

        $medico               = $this->usuariosRepositorio->obtenerUsuarioPorUsername($usuario);
        $pacientesRepositorio = PacientesRepositorioFactory::crear($medico);

        $listaPacientes = $pacientesRepositorio->obtenerPacientesPorNombre($dato);

        return view('pacientes.pacientes_lista', compact('listaPacientes'))->render();
    }

    /**
     * ver el detalle de un paciente
     * @param Request $request
     * @param ExpedientesRepositorioInterface $expedientesRepositorio
     * @return \Illuminate\View\View
     */
    public function detalle(Request $request, ExpedientesRepositorioInterface $expedientesRepositorio)
    {
        $idPaciente = (int)base64_decode($request->get('idPaciente'));
        $username   = $request->get('username');

        $medico               = $this->usuariosRepositorio->obtenerUsuarioPorUsername($username);
        $pacientesRepositorio = PacientesRepositorioFactory::crear($medico);
        $paciente             = $pacientesRepositorio->obtenerPacientePorId($idPaciente);
        $expediente           = $expedientesRepositorio->obtenerExpedientePorPacienteMedico($paciente, $medico);

        $anexoUploader = new AnexosUploader($username, $idPaciente);
        $expediente->obtenerAnexos($anexoUploader->asignar());
        return view('pacientes.pacientes_detalle', compact('expediente', 'anexoUploader'));
    }

    /**
     * guardar un anexo del paciente
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function agregarAnexo(Request $request)
    {
        $anexo = new Anexo($request->get('nombreAnexo'));

        $anexoUploader = new AnexosUploader(base64_decode($request->get('userMedico')), base64_decode($request->get('idPaciente')));
        try {
            $anexoUploader->guardar($request->file('anexo')->getPathName(), $anexo);

            return response('1');
        } catch (\Exception $e) {
            echo $e->getMessage();
            return response('0');
        }
    }

    /**
     * eliminar anexo
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function eliminarAnexo(Request $request)
    {
        $idPaciente = (int)base64_decode($request->get('idPaciente'));
        $userMedico = base64_decode($request->get('userMedico'));
        $anexo      = base64_decode($request->get('anexo'));

        $anexoUploader = new AnexosUploader($userMedico, $idPaciente);

        if(!$anexoUploader->eliminar(new Anexo($anexo))) {
            return response('0');
        }

        return response('1');
    }

    /**
     * generar nuevo tratamiento de ortopedia - ortodoncia
     * @param Request $request
     * @param ExpedientesRepositorioInterface $expedientesRepositorio
     * @param ITratamientoOrtopediaOrtodonciaRepositorio $tratamientosRepositorio
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function agregarTratamiento(Request $request, ExpedientesRepositorioInterface $expedientesRepositorio, ITratamientoOrtopediaOrtodonciaRepositorio $tratamientosRepositorio)
    {
        $ortopedia            = $request->get('ortopedia') ? true : false;
        $ortodoncia           = $request->get('ortodoncia') ? true : false;
        $idPaciente           = (int)base64_decode($request->get('idPaciente'));
        $username             = base64_decode($request->get('username'));
        $medico               = $this->usuariosRepositorio->obtenerUsuarioPorUsername($username);
        $pacientesRepositorio = PacientesRepositorioFactory::crear($medico);
        $paciente             = $pacientesRepositorio->obtenerPacientePorId($idPaciente);
        $expediente           = $expedientesRepositorio->obtenerExpedientePorPacienteMedico($paciente, $medico);

        $tratamiento = new TratamientoOdontologia($request->get('dx'), $request->get('costo'), $request->get('duracion'), $request->get('mensualidades'));
        $tratamiento->generarTratamientos($ortopedia, $ortodoncia);

        if (!$tratamientosRepositorio->guardar($tratamiento, $expediente)) {
            return response('0');
        }

        return response('1');
    }

    /**
     * generar receta en PDF
     * @param string $id
     * @param string $idPaciente
     * @param string $userMedico
     * @param ExpedientesRepositorioInterface $expedientesRepositorio
     * @param RecetasRepositorioInterface $recetasRepositorio
     */
    public function generarReceta($id, $idPaciente, $userMedico, ExpedientesRepositorioInterface $expedientesRepositorio, RecetasRepositorioInterface $recetasRepositorio)
    {
        $id         = (int)base64_decode($id);
        $idPaciente = (int)base64_decode($idPaciente);
        $userMedico = base64_decode($userMedico);

        $medico               = $this->usuariosRepositorio->obtenerUsuarioPorUsername($userMedico);
        $pacientesRepositorio = PacientesRepositorioFactory::crear($medico);
        $paciente             = $pacientesRepositorio->obtenerPacientePorId($idPaciente);
        $expediente           = $expedientesRepositorio->obtenerExpedientePorPacienteMedico($paciente, $medico);

        $receta = $recetasRepositorio->obtenerPorId($id);

        $reporte = new RecetaJohanna($receta, $expediente);
        $reporte->SetHeaderMargin(10);
        $reporte->SetAutoPageBreak(true);
        $reporte->SetMargins(15, 25);
        $reporte->generar();
    }

    /**
     * generar la interconsulta en PDF
     * @param string $id
     * @param string $idPaciente
     * @param string $userMedico
     * @param ExpedientesRepositorioInterface $expedientesRepositorio
     * @param InterconsultasRepositorioInterface $interconsultasRepositorio
     */
    public function generarInterconsulta($id, $idPaciente, $userMedico, ExpedientesRepositorioInterface $expedientesRepositorio, InterconsultasRepositorioInterface $interconsultasRepositorio)
    {
        $id         = (int)base64_decode($id);
        $idPaciente = (int)base64_decode($idPaciente);
        $userMedico = base64_decode($userMedico);

        $medico               = $this->usuariosRepositorio->obtenerUsuarioPorUsername($userMedico);
        $pacientesRepositorio = PacientesRepositorioFactory::crear($medico);
        $paciente             = $pacientesRepositorio->obtenerPacientePorId($idPaciente);
        $expediente           = $expedientesRepositorio->obtenerExpedientePorPacienteMedico($paciente, $medico);

        $interconsulta = $interconsultasRepositorio->obtenerPorId($id);

        $reporte = new InterconsultaJohanna($interconsulta, $expediente);
        $reporte->SetHeaderMargin(10);
        $reporte->SetAutoPageBreak(true);
        $reporte->SetMargins(15, 25);
        $reporte->generar();
    }

    /**
     * generar plan en PDF
     * @param string $id
     * @param string $idPaciente
     * @param string $userMedico
     * @param ExpedientesRepositorioInterface $expedientesRepositorio
     * @param PlanTratamientoRepositorioInterface $planesRepositorio
     */
    public function generarPlan($id, $idPaciente, $userMedico, ExpedientesRepositorioInterface $expedientesRepositorio, PlanTratamientoRepositorioInterface $planesRepositorio)
    {
        $id         = (int)base64_decode($id);
        $idPaciente = (int)base64_decode($idPaciente);
        $userMedico = base64_decode($userMedico);

        $medico               = $this->usuariosRepositorio->obtenerUsuarioPorUsername($userMedico);
        $pacientesRepositorio = PacientesRepositorioFactory::crear($medico);
        $paciente             = $pacientesRepositorio->obtenerPacientePorId($idPaciente);
        $expediente           = $expedientesRepositorio->obtenerExpedientePorPacienteMedico($paciente, $medico);

        $plan = $planesRepositorio->obtenerPorId($id);

        $reporte = new PlanTratamientoJohanna($plan, $expediente);
        $reporte->SetHeaderMargin(10);
        $reporte->SetMargins(15, 50);
        $reporte->SetAutoPageBreak(true, 20);
        $reporte->generar();
    }
}
