<?php
namespace Siacme\Http\Controllers\Citas;

use Illuminate\Http\Request;
use Siacme\Dominio\Citas\CitaEstatus;
use Siacme\Dominio\Citas\Repositorios\CitasRepositorio;
use Siacme\Dominio\Expedientes\Repositorios\ExpedientesRepositorio;
use Siacme\Dominio\Pacientes\Paciente;
use Siacme\Dominio\Pacientes\Repositorios\PacientesRepositorio;
use Siacme\Http\Controllers\Controller;
use Siacme\Dominio\Citas\Cita;
use Siacme\Dominio\Usuarios\Repositorios\UsuariosRepositorio;

/**
 * Class Citas
 * @package Siacme\Http\Controllers\Citas
 * @author  Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class CitasController extends Controller
{
//    /**
//     * repositorio de Citas
//     * @var CitasRepositorioInterface
//     */
//    protected $citasRepositorio;
//
    /**
     * constructor
     * @param CitasRepositorio $citasRepositorio
     */
    public function __construct(CitasRepositorio $citasRepositorio)
    {
        $this->citasRepositorio = $citasRepositorio;
    }

    /**
     * @param $username
     * @param UsuariosRepositorio $usuariosRepositorio
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($username, UsuariosRepositorio $usuariosRepositorio)
    {
        if(is_null($medico = $usuariosRepositorio->obtenerPorUsername($username))) {
            return view('error');
        }

        return view('citas.citas', compact('medico'));
    }

    /**
     * comprobar la existencia de un paciente
     * @param Request $request
     * @param PacientesRepositorio $pacientesRepositorio
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Throwable
     */
    public function buscarPacientes(Request $request, PacientesRepositorio $pacientesRepositorio)
    {
        // recibir parámetros
        $dato = $request->get('dato');
        $respuesta = [];

        // delegar busqueda de pacientes
        $pacientes = $pacientesRepositorio->obtenerPorNombre($dato);

        if(is_null($pacientes)) {
            // no hay coincidencias, devolver mensaje de no encontrados
            $respuesta['estatus'] = 'fail';
            $respuesta['mensaje'] = 'No se encontraron resultados';
        } else {
            // devolver vista de encontrados
            $respuesta['estatus'] = 'OK';
            $respuesta['html']    = view('citas.citas_expedientes_encontrados', compact('pacientes'))->render();
        }

        // respuesta
        return response()->json($respuesta);
    }

    /**
     * agendar una nueva cita en una fecha, hora y para un paciente
     * @param Request $request
     * @param UsuariosRepositorio $medicosRepositorio
     * @param PacientesRepositorio $pacientesRepositorio
     * @return \Illuminate\Http\JsonResponse
     * @internal param CitasRepositorio $citasRepositorio
     */
    public function agendar(Request $request, UsuariosRepositorio $medicosRepositorio, PacientesRepositorio $pacientesRepositorio)
    {
        // post variables
        $nombre     = $request->get('nombre');
        $paterno    = $request->get('paterno');
        $materno    = $request->get('materno');
        $telefono   = $request->get('telefono');
        $celular    = $request->get('celular');
        $email      = $request->get('email');
        $fecha      = $request->get('fecha');
        $hora       = $request->get('hora');
        $userMedico = $request->get('userMedico');
        $respuesta  = [];

        if ($request->has('pacienteId') && $request->get('pacienteId') !== '0') {
            $pacienteId = (int)$request->get('pacienteId');
            // obtener paciente por id
            $paciente = $pacientesRepositorio->obtenerPorId($pacienteId);

        } else {
            // nuevo paciente
            $paciente = new Paciente($nombre, $paterno, $materno, $telefono, $celular, $email);
        }

        $medico = $medicosRepositorio->obtenerPorUsername($userMedico);

        $cita = new Cita();
        $cita->agendar($fecha, $hora, $paciente, $medico);

        if (!$this->citasRepositorio->persistir($cita)) {
            $respuesta['estatus'] = 'fail';
        }

        $respuesta['estatus'] = 'OK';

        return response()->json($respuesta);
    }

    /**
     * obtener un arreglo de citas
     * @param  string $med
     * @param  string $fecha
     * @param UsuariosRepositorio $medicosRepositorio
     * @return Response
     */
    public function verCitas($med, $fecha, UsuariosRepositorio $medicosRepositorio)
    {
        $medico         = base64_decode($med);
        $fecha          = !is_null($fecha) ? base64_decode($fecha) : null;
        $listaCitas     = null;
        $listaCitasJson = null;
        $medico         = $medicosRepositorio->obtenerPorUsername($medico);

        $listaCitas = $this->citasRepositorio->obtenerPorMedico($medico, $fecha);

        // hay citas
        if(!is_null($listaCitas)) {

            $listaCitasJson = [];

            foreach ($listaCitas as $cita) {
                $citaActual           = [];

                $citaActual['id']     = $cita->getId();
                $citaActual["title"]  = "Cita de ".$cita->getPaciente()->nombreCompleto();
                $citaActual["start"]  = $cita->getFecha()." ".$cita->getHora();
                $citaActual["end"]    = $cita->getFinCita();
                $citaActual["allDay"] = false;

                $listaCitasJson[] = $citaActual;
            }

            // respuesta en formato json
            return response()->json($listaCitasJson);
        }
    }

    /**
     * ver el detalle de una cita en base a la cita seleccionada
     * @param Request $request
     * @param ExpedientesRepositorio $expedientesRepositorio
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Throwable
     */
    public function verDetalle(Request $request, ExpedientesRepositorio $expedientesRepositorio)
    {
        //$medico = base64_decode();
        $citaId    = (int)base64_decode($request->get('citaId'));
        $respuesta = [];
        // cargar datos por id
        $cita = $this->citasRepositorio->obtenerPorId($citaId);

        // obtener el expediente
        $expediente = $expedientesRepositorio->obtenerPorPacienteMedico($cita->getPaciente(), $cita->getMedico());
        $respuesta['html']    = view('citas.citas_detalle_contenido', compact('cita', 'expediente'))->render();
        $respuesta['estatus'] = 'OK';

        return response()->json($respuesta);
    }
//
//    /**
//     * cargar datos de la cita y construir vista
//     * @param  Request $request
//     * @param  int  $idCita
//     * @return view
//     */
//    public function editar(Request $request, $idCita)
//    {
//        $idCita = base64_decode($idCita);
//
//        $cita = new Cita();
//        $cita->setId($idCita);
//
//        $this->citasRepositorio->cargarDatos($cita);
//
//        return view('citas.citas_editar', compact('cita'));
//    }
//
//    public function actualizar(Request $request)
//    {
//        // recuperar datos de form
//        $txtNombre   = $request->get('txtNombre');
//        $txtPaterno  = $request->get('txtPaterno');
//        $txtMaterno  = $request->get('txtMaterno');
//        $txtTelefono = $request->get('txtTelefono');
//        $txtCelular  = $request->get('txtCelular');
//        $txtEmail    = $request->get('txtEmail');
//        $idCita      = $request->get('idCita');
//
//        // objetos
//        $cita        = new Cita();
//
//        // setear valores
//        $cita->setId($idCita);
//        $cita->setNombre($txtNombre);
//        $cita->setPaterno($txtPaterno);
//        $cita->setMaterno($txtMaterno);
//        $cita->setTelefono($txtTelefono);
//        $cita->setCelular($txtCelular);
//        $cita->setEmail($txtEmail);
//
//        if(!$this->citasRepositorio->persistir($cita)) {
//            // error al editar
//            return response(0);
//        }
//
//        // exito!
//        return response(1);
//    }
//
    /**
     * cambiar el estatus de la cita en base a la acción
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cambiarEstatus(Request $request)
    {
        // obtener parametros
        $respuesta   = [];
        $citaId      = (int)base64_decode($request->get('citaId'));
        $cita        = $this->citasRepositorio->obtenerPorId($citaId);
        $accion      = (int)$request->get('accion');

        switch ($accion) {
            case CitaEstatus::CONFIRMADA:
                $cita->confirmar();
                break;

            case CitaEstatus::CANCELADA:
                $cita->cancelar();
                break;
        }

        if(!$this->citasRepositorio->actualizar($cita)) {
            // error
            $respuesta['estatus'] = 'fail';
            return response()->json($respuesta);
        }

        // exito
        $respuesta['estatus'] = 'OK';
        $respuesta['html']    = view('citas.citas_detalle_contenido', compact('cita'))->render();

        return response()->json($respuesta);
    }

    /**
     * guardar referencia a la cita que será reprogramada
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
	public function asignarReprogramacion(Request $request)
    {
        // obtener parametros
        $respuesta = [];
        $citaId    = (int)base64_decode($request->get('citaId'));

        // colocar en sesión a la cita seleccionada
		$request->session()->put('citaId', $citaId);

        // exito
        $respuesta['estatus'] = 'OK';

        return response()->json($respuesta);
    }

    /**
     * reprogramar la cita a la fecha y hora seleccionados
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reprogramar(Request $request)
    {
        $citaId    = $request->session()->get('citaId');
        $fecha     = $request->get('date');
        $hora      = $request->get('time');
        $respuesta = [];

        $cita = $this->citasRepositorio->obtenerPorId($citaId);
        $cita->reprogramar($fecha, $hora);

        // update
        $respuesta['estatus'] = 'OK';

        if(!$this->citasRepositorio->actualizar($cita)) {
            // error
            $respuesta['estatus'] = 'fail';
        }

        // eliminar de sesion
        $request->session()->forget('citaId');

        return response()->json($respuesta);
    }
//
//    /**
//     * generar lista citas PDF
//     * @param $medico
//     * @param $fecha
//     */
//    public function pdf($medico, $fecha)
//    {
//        $medico = base64_decode($medico);
//        $fecha  = base64_decode($fecha);
//
//        $listaCitas = $this->citasRepositorio->obtenerCitasPorMedico($medico, $fecha);
//        $reporte = new ListaCitasPdf($listaCitas, $fecha);
//        $reporte->SetHeaderMargin(10);
//        $reporte->SetAutoPageBreak(true);
//        $reporte->SetMargins(15, 25);
//        $reporte->generar();
//    }
}