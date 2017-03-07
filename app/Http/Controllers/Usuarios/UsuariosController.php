<?php
namespace Siacme\Http\Controllers\Usuarios;

use DateTime;
use Illuminate\Http\Request;
use Siacme\Dominio\Usuarios\Repositorios\EspecialidadesRepositorio;
use Siacme\Dominio\Usuarios\Repositorios\UsuariosRepositorio;
use Siacme\Dominio\Usuarios\Usuario;
use Siacme\Http\Controllers\Controller;
use Siacme\Http\Requests\CrearUsuarioRequest;
use Siacme\Http\Requests\EditarUsuarioRequest;
use Siacme\Infraestructura\Usuarios\EspecialidadesRepositorioInterface;
use Siacme\Infraestructura\Usuarios\TipoUsuariosRepositorio;

/**
 * Class UsuariosController
 * @package Siacme\Http\Controllers\Usuarios
 * @author Gerardo Adrián Gómez Ruiz
 */
class UsuariosController extends Controller
{
    /**
     * @var UsuariosRepositorio
     */
    private $usuariosRepositorio;

    /**
     * @var EspecialidadesRepositorio
     */
    private $especialidadesRepositorio;

    /**
     * UsuariosController constructor.
     *
     * @param UsuariosRepositorio $usuariosRepositorio
     * @param EspecialidadesRepositorio $especialidadesRepositorio
     */
    public function __construct(UsuariosRepositorio $usuariosRepositorio, EspecialidadesRepositorio $especialidadesRepositorio)
    {
        $this->usuariosRepositorio       = $usuariosRepositorio;
        $this->especialidadesRepositorio = $especialidadesRepositorio;
    }

    /**
     * mostrar listado de usuarios
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $usuarios = $this->usuariosRepositorio->obtenerTodos();
        return view('usuarios.usuarios', compact('usuarios'));
    }

    /**
     * mostrar vista de creación de nuevo usuario
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function agregar()
    {
        // obtener la lista de especialidades
        $especialidades = $this->especialidadesRepositorio->obtenerTodos();
        return view('usuarios.usuarios_agregar', compact('especialidades'));
    }

    /**
     * @param  Request $request
     * @return response()
     */
    public function buscar(Request $request)
    {
        $nombre   = $request->get('nombre');
        $usuarios = $this->usuariosRepositorio->obtenerUsuarios($nombre);

        $respuesta = [
            'contenido' => base64_encode(view('usuarios.usuarios_busqueda_resultados', compact('usuarios'))->render()),
            'resultado' => 'OK'
        ];

        return response()->json($respuesta);
    }

    /**
     * crear un nuevo usuario
     *
     * @param CrearUsuarioRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function guardar(CrearUsuarioRequest $request)
    {
        $respuesta    = ['estatus' => 'OK'];
        $especialidad = $this->especialidadesRepositorio->obtenerPorId((int)$request->get('especialidad'));
        $rol          = (int)$request->get('rol');

        $usuario = new Usuario($request->get('clave'), $request->get('passwd'), $rol, $especialidad, new DateTime());
        $usuario->asignarDatosPersonales($request->get('nombre'), $request->get('paterno'), $request->get('materno', '-'));
        $usuario->asignarDatosDeContacto($request->get('telefono', '-'), $request->get('celular', '-'), $request->get('email', '-'));

        if (!$this->usuariosRepositorio->persistir($usuario)) {
            $respuesta['estatus'] = 'fail';
        }

        return response()->json($respuesta);
    }

    /**
     * mostrar la vista de edición de usuario
     *
     * @param string|null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editar($id = null)
    {
        $this->validarQueryString($id);

        $usuario        = $this->usuariosRepositorio->obtenerPorId((int)base64_decode($id));
        $especialidades = $this->especialidadesRepositorio->obtenerTodos();

        return view('usuarios.usuarios_editar', compact('usuario', 'especialidades'));
    }

    /**
     * actualizar datos de usuario
     *
     * @param EditarUsuarioRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function modificar(EditarUsuarioRequest $request)
    {
        $respuesta    = ['estatus' => 'OK'];
        $especialidad = $this->especialidadesRepositorio->obtenerPorId((int)$request->get('especialidad'));
        $rol          = (int)$request->get('rol');

        $usuario = $this->usuariosRepositorio->obtenerPorId((int)base64_decode($request->get('usuarioId')));
        $usuario->asignarDatosDeNivel($especialidad, $rol);
        $usuario->asignarDatosPersonales($request->get('nombre'), $request->get('paterno'), $request->get('materno', '-'));
        $usuario->asignarDatosDeContacto($request->get('telefono', '-'), $request->get('celular', '-'), $request->get('email', '-'));

        if (!$this->usuariosRepositorio->persistir($usuario)) {
            $respuesta['estatus'] = 'fail';
        }

        return response()->json($respuesta);
    }

    /**
     * desactivar a un usuario
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function eliminar(Request $request)
    {
        $respuesta = ['estatus' => 'OK'];
        $usuario   = $this->usuariosRepositorio->obtenerPorId((int)$request->get('usuarioId'));
        $usuario->desactivar(new DateTime());

        if (!$this->usuariosRepositorio->persistir($usuario)) {
            $respuesta['estatus'] = 'fail';
        }

        return response()->json($respuesta);
    }

    /**
     * activar a un usuario
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function activar(Request $request)
    {
        $respuesta = ['estatus' => 'OK'];
        $usuario   = $this->usuariosRepositorio->obtenerPorId((int)$request->get('usuarioId'));
        $usuario->activar();

        if (!$this->usuariosRepositorio->persistir($usuario)) {
            $respuesta['estatus'] = 'fail';
        }

        return response()->json($respuesta);
    }

    /**
     * cambiar contrasenia de usuario
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cambiarContrasenia(Request $request)
    {
        $respuesta = ['estatus' => 'OK'];
        $usuario   = $this->usuariosRepositorio->obtenerPorId((int)$request->get('usuarioId'));   

        $usuario->cambiarContrasenia($request->get('contrasenia'));

        if (!$this->usuariosRepositorio->persistir($usuario)) {
            $respuesta['estatus'] = 'fail';
        }

        return response()->json($respuesta);
    }
}