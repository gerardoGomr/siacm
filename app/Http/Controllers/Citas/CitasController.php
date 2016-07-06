<?php
namespace Siacme\Http\Controllers\Citas;

use Illuminate\Http\Request;
use Siacme\Http\Requests;
use Siacme\Http\Controllers\Controller;
use Siacme\Dominio\Citas\Cita;
use Siacme\Dominio\Citas\CitaEstatus;
use Siacme\Infraestructura\Usuarios\UsuariosRepositorioInterface;
use Siacme\Infraestructura\Citas\CitasRepositorioInterface;
use Siacme\Infraestructura\Expedientes\ExpedientesRepositorioInterface;
use Siacme\Reportes\Citas\ListaCitasPdf;
use Siacme\Reportes\ReporteJohannaPdf;
use Siacme\Servicios\Pacientes\PacientesFactory;
use Siacme\Servicios\Pacientes\PacientesRepositorioFactory;
use View;

/**
 * Class Citas
 * @package Siacme\Http\Controllers\Citas
 * @author  Gerardo Adrián Gómez Ruiz
 */
class CitasController extends Controller
{
    /**
     * repositorio de Citas
     * @var CitasRepositorioInterface
     */
    protected $citasRepositorio;

    /**
     * constructor
     * @param CitasRepositorioInterface $citasRepositorio
     */
    public function __construct(CitasRepositorioInterface $citasRepositorio)
    {
        $this->citasRepositorio = $citasRepositorio;
    }

    /**
     * @param string $username
     * @param UsuariosRepositorioInterface $usuariosRepositorio
     * @return View
     */
    public function index($username, UsuariosRepositorioInterface $usuariosRepositorio)
    {
        if(($medico = $usuariosRepositorio->obtenerUsuarioPorUsername($username)) === null) {
            return view('error');
        }

        return view('citas.citas', compact('medico'));
    }

    /**
     * mostrar vista para agregar nueva cita
     * @param  Request $request
     * @param  string  $fecha
     * @param  string  $hora
     * @param  string  $medico
     * @return View
     */
    public function agregar(Request $request, $fecha, $hora, $medico)
    {
        list($anio, $mes, $dia) = explode('-', base64_decode($fecha));

        if ((int)$mes < 10) {
            $mes = '0' . $mes;
        }

        return view('citas.citas_agregar')->with([
            'modo'   => 'agregar',
            'fecha'  => $anio . '-' . $mes . '-' . $dia,
            'hora'   => base64_decode($hora),
            'medico' => $medico
        ]);
    }

    /**
     * comprobar la existencia de un paciente
     * @param Request                      $request
     * @param UsuariosRepositorioInterface $usuariosRepositorio
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function comprobarPaciente(Request $request, UsuariosRepositorioInterface $usuariosRepositorio)
    {
        // recibir parámetros
        $txtNombreBusqueda = $request->get('txtNombreBusqueda');
        $username          = base64_decode($request->get('medico'));
        $medico            = $usuariosRepositorio->obtenerUsuarioPorUsername($username);

        // obtener el repositorio a utilizar
        $pacientesRepositorio = PacientesRepositorioFactory::crear($medico);

        // delegar busqueda de pacientes
        $listaPacientes = $pacientesRepositorio->obtenerPacientesPorNombre($txtNombreBusqueda);

        // variable para construir vista
        $html = '';

        if(is_null($listaPacientes)) {
            // no hay coincidencias, devolver mensaje de no encontrados
            $html = View::make('citas.citas_expedientes_no_encontrados');
            return response($html);
        }

        // devolver vista de encontrados
        $html = View::make('citas.citas_expedientes_encontrados', compact('listaPacientes'));

        // respuesta
        return response($html);
    }

    /**
     * @param Request                      $request
     * @param UsuariosRepositorioInterface $medicosRepositorio
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function guardar(Request $request, UsuariosRepositorioInterface $medicosRepositorio)
    {
        $txtNombre    = $request->get('txtNombre');
        $txtPaterno   = $request->get('txtPaterno');
        $txtMaterno   = $request->get('txtMaterno');
        $txtTelefono  = $request->get('txtTelefono');
        $txtCelular   = $request->get('txtCelular');
        $txtEmail     = $request->get('txtEmail');
        $fecha        = $request->get('fecha');
        $hora         = $request->get('hora');
        $userMedico   = base64_decode($request->get('medico')); // username del médico
        $opcion       = $request->get('opcion');  //insert or update
        $nuevoPaciente= $request->get('nuevoPaciente');

        $cita                 = new Cita();
        $medico               = $medicosRepositorio->obtenerUsuarioPorUsername($userMedico);
        $paciente             = PacientesFactory::crear($medico);
        $pacientesRepositorio = PacientesRepositorioFactory::crear($medico);
        $citaEstatus          = new CitaEstatus(1);

        // setear valores al paciente
        $paciente->setNombre($txtNombre);
        $paciente->setPaterno($txtPaterno);
        $paciente->setMaterno($txtMaterno);
        $paciente->setTelefono($txtTelefono);
        $paciente->setCelular($txtCelular);
        $paciente->setEmail($txtEmail);
        $paciente->setNuevoPaciente(false);

        // si es nuevo paciente en sistema
        if($nuevoPaciente === '1') {
            $paciente->setNuevoPaciente(true);

            // guardar paciente
            $pacientesRepositorio->persistir($paciente);
        } else {
            $paciente->setId(base64_decode($request->get('idPaciente')));
        }

        // setear valores de cita
        $cita->setFecha($fecha);
        $cita->setHora($hora);
        $cita->setMedico($medico);
        $cita->setEstatus($citaEstatus);
        $cita->setPaciente($paciente);

        // echo $opcion;exit;
        if($opcion === '1') {
            // persistir cita
            if(!$this->citasRepositorio->persistir($cita)) {
                // error
                return response(0);
            }

            // exito!!
            return response(1);
        }
    }

    /**
     * obtener un arreglo de citas
     * @param  Request $request
     * @param  string  $med
     * @param  string  $fecha
     * @return Response
     */
    public function verCitas(Request $request, $med, $fecha)
    {
        $medico         = base64_decode($med);
        $fecha          = !is_null($fecha) ? base64_decode($fecha) : null;
        $listaCitas     = null;
        $listaCitasJson = null;

        $listaCitas = $this->citasRepositorio->obtenerCitasPorMedico($medico, $fecha);

        // hay citas
        if($listaCitas !== null) {

            $listaCitasJson = array();

            foreach ($listaCitas as $cita) {
                $citaActual           = array();

                $citaActual['id']     = $cita->getId();
                $citaActual["title"]  = "Cita de ".$cita->getPaciente()->getNombreCompleto();
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
     * @param Request                         $request
     * @param string                          $idCita
     * @param string                          $med
     * @param ExpedientesRepositorioInterface $expedientesRepositorio
     * @return View
     */
    public function verDetalle(Request $request, $idCita, $med, ExpedientesRepositorioInterface $expedientesRepositorio)
    {
        $medico = base64_decode($med);
        $idCita = (int)base64_decode($idCita);

        // cargar datos por id
        $cita = $this->citasRepositorio->obtenerCitaPorId($idCita);

        // obtener el expediente
        $expediente = $expedientesRepositorio->obtenerExpedientePorPacienteMedico($cita->getPaciente(), $cita->getMedico());

        return View::make('citas.citas_detalle', compact('cita', 'expediente'));
    }

    /**
     * cargar datos de la cita y construir vista
     * @param  Request $request
     * @param  int  $idCita
     * @return view
     */
    public function editar(Request $request, $idCita)
    {
        $idCita = base64_decode($idCita);

        $cita = new Cita();
        $cita->setId($idCita);

        $this->citasRepositorio->cargarDatos($cita);

        return view('citas.citas_editar', compact('cita'));
    }

    public function actualizar(Request $request)
    {
        // recuperar datos de form
        $txtNombre   = $request->get('txtNombre');
        $txtPaterno  = $request->get('txtPaterno');
        $txtMaterno  = $request->get('txtMaterno');
        $txtTelefono = $request->get('txtTelefono');
        $txtCelular  = $request->get('txtCelular');
        $txtEmail    = $request->get('txtEmail');
        $idCita      = $request->get('idCita');

        // objetos
        $cita        = new Cita();

        // setear valores
        $cita->setId($idCita);
        $cita->setNombre($txtNombre);
        $cita->setPaterno($txtPaterno);
        $cita->setMaterno($txtMaterno);
        $cita->setTelefono($txtTelefono);
        $cita->setCelular($txtCelular);
        $cita->setEmail($txtEmail);

        if(!$this->citasRepositorio->persistir($cita)) {
            // error al editar
            return response(0);
        }

        // exito!
        return response(1);
    }

    /**
     * @param Request                         $request
     * @param ExpedientesRepositorioInterface $expedientesRepositorio
     * @return \Illuminate\Http\JsonResponse
     */
    public function estatus(Request $request, ExpedientesRepositorioInterface $expedientesRepositorio)
    {
        // obtener parametros
        $respuesta   = array();

        $idCita      = (int)base64_decode($request->get('idCita'));
        $idEstatus   = $request->get('idEstatus');

        $cita        = $this->citasRepositorio->obtenerCitaPorId($idCita);
        $cita->setEstatus(new CitaEstatus((int)$idEstatus));

        if(!$this->citasRepositorio->actualizaEstatus($cita)) {
            // error
            $respuesta['respuesta'] = 0;
            return response()->json($respuesta);
        }

        // obtener el expediente
        $expediente = $expedientesRepositorio->obtenerExpedientePorPacienteMedico($cita->getPaciente(), $cita->getMedico());

        // exito
        $respuesta['respuesta'] = 1;
        // view a cargar
        $html                   = view('citas.citas_detalle_opciones_refrescar', compact('cita', 'expediente'));
        $respuesta['html']      = base64_encode($html);

        return response()->json($respuesta);
    }

    /**
     * guardar en sesion el id de la cita a reprogramar
     * @param  Request $request
     * @return json string
     */
	public function guardaEnSesion(Request $request)
    {
        // obtener parametros
        $respuesta   = array();
        $idCita      = base64_decode($request->get('idCita'));

		// colocar en sesión a la cita seleccionada
		$request->session()->put('idCita', $idCita);

        // exito
        $respuesta['respuesta'] = 1;

        return response()->json($respuesta);
    }

    /**
     * realizar update a fecha y hora para reprogramar
     * la cita. Se debe modificar el estatus para que tenga estatus
     * de agendada. Id == 2
     * @param  Request $request
     * @return bool
     */
    public function reprogramar(Request $request)
    {
        $cita        = new Cita();
        $citaEstatus = new CitaEstatus();
        $idCita      = $request->session()->get('idCita');
        $fecha       = $request->get('date');
        $hora        = $request->get('time');

        $cita->setId($idCita);
        $cita->setFecha($fecha);
        $cita->setHora($hora);
        $cita->setEstatus($citaEstatus);

        // update
        if(!($this->citasRepositorio->persistir($cita))) {
            return response(0);
        }

        // eliminar de sesion
        $request->session()->forget('idCita');

        return response(1);
    }

    /**
     * generar lista citas PDF
     * @param $medico
     * @param $fecha
     */
    public function pdf($medico, $fecha)
    {
        $medico = base64_decode($medico);
        $fecha  = base64_decode($fecha);

        $listaCitas = $this->citasRepositorio->obtenerCitasPorMedico($medico, $fecha);
        $reporte = new ListaCitasPdf($listaCitas, $fecha);
        $reporte->SetHeaderMargin(10);
        $reporte->SetAutoPageBreak(true);
        $reporte->SetMargins(15, 25);
        $reporte->generar();
    }
}