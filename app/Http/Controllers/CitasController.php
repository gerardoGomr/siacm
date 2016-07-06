<?php
namespace Siacme\Http\Controllers;

use Siacme\Usuarios\UsuariosRepositorioInterface;
use Siacme\Pacientes\PacientesRepositorioInterface;
use Siacme\Citas\CitasRepositorioInterface;

class CitasController
{
    /**
     * obtener los datos basicos de un usuario especificado
     *
     * @return $usuario o false
     */
    public function index($username, UsuariosRepositorioInterface $usuariosRepositorio)
    {
        if(($usuario = $usuariosRepositorio->obtenerUsuarioPorUsername($username)) === null) {
            return false;
        }

        // $listaCitas = $citasRepositorio->obtenerCitasPorMedico($username);
        // var_dump($listaCitas);exit;
        // $listas = array(
        //     'usuario'    => $usuario,
        //     'listaCitas' => $listaCitas
        // );

        return $usuario;
    }

    public function agregar(Request $request, $fecha, $hora, $med)
    {
        return view('citas.citas_agregar')->with([
            'modo'   => 'agregar',
            'fecha'  => base64_decode($fecha),
            'hora'   => base64_decode($hora),
            'medico' => $med
        ]);
    }

    /**
     * buscar pacientes en el repositorio especificado
     * @param  string                        $txtNombreBusqueda
     * @param  PacientesRepositorioInterface $pacientesRepositorio
     * @return array
     */
    public function comprobarPaciente($txtNombreBusqueda, PacientesRepositorioInterface $pacientesRepositorio)
    {
        // buscar en el repositorio y devolver
        return $pacientesRepositorio->obtenerPacientesPorNombre($txtNombreBusqueda);
    }

    public function guardar(Request $request)
    {
        // var_dump($request->all());exit;
        $idExpediente = $request->get('idExpediente');
        $txtNombre    = $request->get('txtNombre');
        $txtPaterno   = $request->get('txtPaterno');
        $txtMaterno   = $request->get('txtMaterno');
        $txtTelefono  = $request->get('txtTelefono');
        $txtCelular   = $request->get('txtCelular');
        $txtEmail     = $request->get('txtEmail');
        $fecha        = $request->get('fecha');
        $hora         = $request->get('hora');
        $medico       = base64_decode($request->get('medico'));
        $opcion       = $request->get('opcion');

        // var_dump($idExpediente);exit;
        // var_dump(!is_null($idExpediente));
        // echo '---';exit;
        // guardar
        $cita        = new Cita();
        $medicoBD    = new MedicosRepositorioBD();
        $medico      = $medicoBD->cargarUsuarioPorUsername($medico);

        $citaEstatus = new CitaEstatus(1);
        $citaBD      = new CitasRepositorioBD();

        $cita->setNombre($txtNombre);
        $cita->setPaterno($txtPaterno);
        $cita->setMaterno($txtMaterno);
        $cita->setTelefono($txtTelefono);
        $cita->setCelular($txtCelular);
        $cita->setEmail($txtEmail);
        $cita->setFecha($fecha);
        $cita->setHora($hora);
        $cita->setMedico($medico);
        $cita->setEstatus($citaEstatus);

        // echo $opcion;exit;
        if($opcion === '1') {
            // guardar
            if(!$citaBD->persistir($cita)) {
                // error
                return response(0);
            }

            if(is_null($idExpediente) === false) {
                $expediente = FabricaExpediente::construirExpedienteBasico($medico->getEspecialidad()->getId());
                $expediente->setId($idExpediente);

                $cita->setExpediente($expediente);
                // asignar cita al expediente
                if(!$citaBD->guardarExpediente($cita)) {
                    // error
                    return response(0);
                }
            }

            // exito!!
            return response(1);
        }
    }

    public function verCitas(Request $request, $med)
    {
        $medico         = base64_decode($med);
        $listaCitas     = null;
        $listaCitasJson = null;
        $citaBD         = new CitasRepositorioBD();

        $listaCitas = $citaBD->obtenerCitasPorMedico($medico);

        // hay citas
        if($listaCitas !== null) {

            $listaCitasJson = array();

            foreach ($listaCitas as $cita) {
                $citaActual           = array();

                $citaActual['id']     = $cita->getId();
                $citaActual["title"]  = "Cita de ".$cita->getNombre()." ".$cita->getPaterno()." ".$cita->getMaterno();
                $citaActual["start"]  = $cita->getFecha()." ".$cita->getHora();
                $citaActual["end"]    = $cita->getFinCita();
                $citaActual["allDay"] = false;

                $listaCitasJson[] = $citaActual;
            }

            // respuesta en formato json
            return response()->json($listaCitasJson);
        }
    }

    public function verDetalle(Request $request, $idCita, $med)
    {
        $medico = base64_decode($med);
        $cita   = new Cita();
        $citaBD = new CitasRepositorioBD();

        $cita->setId(base64_decode($idCita));

        // cargar datos por id
        if(!($citaBD->cargarDatos($cita))) {
            return View::make('error');
        }

        //var_dump($cita);exit();

        return View::make('citas.citas_detalle', compact('cita'));
    }

    public function editar(Request $request, $idCita)
    {
        $idCita = base64_decode($idCita);

        $cita = new Cita();
        $cita->setId($idCita);

        $citaBD = new CitasRepositorioInterface();
        $citaBD->cargarDatos($cita);

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
        $citaBD      = new CitasRepositorioInterface();

        // setear valores
        $cita->setId($idCita);
        $cita->setNombre($txtNombre);
        $cita->setPaterno($txtPaterno);
        $cita->setMaterno($txtMaterno);
        $cita->setTelefono($txtTelefono);
        $cita->setCelular($txtCelular);
        $cita->setEmail($txtEmail);

        if(!$citaBD->persistir($cita)) {
            // error al editar
            return response(0);
        }

        // exito!
        return response(1);
    }

    public function estatus(Request $request)
    {
        // obtener parametros
        $respuesta   = array();

        $idCita      = base64_decode($request->get('idCita'));
        $idEstatus   = $request->get('idEstatus');

        $cita        = new Cita();
        $citaEstatus = new CitaEstatus();
        $citaBD      = new CitasRepositorioBD();

        $citaEstatus->setId((int)$idEstatus);
        $cita->setId($idCita);
        $cita->setEstatus($citaEstatus);

        if(!$citaBD->actualizaEstatus($cita)) {
            // error
            $respuesta['respuesta'] = 0;
            return response()->json($respuesta);
        }
        // var_dump($cita);exit;
        // $respuesta['respuesta'] = 0;
        // $html                   = view('citas_detalle_opciones_refrescar', compact('cita'));
        // $respuesta['html'] = base64_encode($html);

        // return response($html);

        // exito
        $respuesta['respuesta'] = 1;
        // view a cargar
        $html                   = view('citas.citas_detalle_opciones_refrescar', compact('cita'));
        $respuesta['html']      = base64_encode($html);

        return response()->json($respuesta);
    }
}