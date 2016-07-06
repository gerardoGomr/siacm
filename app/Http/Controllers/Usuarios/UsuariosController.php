<?php
namespace Siacme\Http\Controllers\Usuarios;

use Illuminate\Http\Request;
use Siacme\Http\Controllers\Controller;
use Siacme\Infraestructura\Usuarios\UsuariosRepositorioInterface;
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
     * @var UsuariosRepositorioInterface
     */
    private $usuariosRepositorio;

    /**
     * Constructor
     * @param UsuariosRepositorioInterface $usuariosRepositorio
     */
    public function __construct(UsuariosRepositorioInterface $usuariosRepositorio)
    {
        $this->usuariosRepositorio = $usuariosRepositorio;
    }

    /**
     * mostrar pagina login
     * @return View
     */
    public function index()
    {
        $usuarios = $this->usuariosRepositorio->obtenerUsuarios();
        return view('usuarios.usuarios', compact('usuarios'));
    }

    public function agregar(EspecialidadesRepositorioInterface $especialidadesRepositorio, TipoUsuariosRepositorio $tipoUsuariosRepositorio)
    {
        // obtener la lista de tipo de usuario
        $tipoUsuarios = $tipoUsuariosRepositorio->obtenerTipoUsuarios();

        // obtener la lista de especialidades
        $especialidades = $especialidadesRepositorio->obtenerEspecialidades();
        return view('usuarios.usuarios_agregar', compact('especialidades', 'tipoUsuarios'));
    }

    /**
     * @param  Request $request
     * @param  UsuariosRepositorioInterface $usuariosRepositorio
     * @return response()
     */
    public function buscar(Request $request, UsuariosRepositorioInterface $usuariosRepositorio)
    {
        $nombre   = $request->get('nombre');
        $usuarios = $usuariosRepositorio->obtenerUsuarios($nombre);

        $respuesta = [
            'contenido' => base64_encode(view('usuarios.usuarios_busqueda_resultados', compact('usuarios'))->render()),
            'resultado' => 'OK'
        ];

        return response()->json($respuesta);
    }

    public function guardarUsuario()
    {
        // guardar en la BD
    }
}
