<?php
namespace Siacme\Infraestructura\Usuarios;

use Siacme\Dominio\Usuarios\Repositorios\UsuariosRepositorio;
use Siacme\Dominio\Usuarios\Usuario;
use Siacme\Dominio\Usuarios\Especialidad;
use Siacme\Dominio\Usuarios\UsuarioTipo;
use Doctrine\ORM\EntityManager;

/**
 * Class UsuariosRepositorioMySQL
 * @package Siacme\Infraestructura\Usuarios
 * @author  Gerardo Adrián Gómez Ruiz
 */
class UsuariosRepositorioLaravelMySQL implements UsuariosRepositorio
{
	/**
	 * @var EntityManager
	 */
	protected $entityManager;

	/**
	 * UsuariosRepositorioLaravelMySQL constructor.
	 * @param EntityManager $em
	 */
	public function __construct(EntityManager $em)
	{
		$this->entityManager = $em;
	}

	public function obtenerUsuarios($datos = '')
	{
		$usuarios = [];
		$datos    = str_replace(' ', '', $datos);
		try {
			$usuarioBD = DB::table('usuario')
				->join('usuario_tipo', 'usuario.idUsuarioTipo', '=', 'usuario_tipo.idUsuarioTipo')
				->join('especialidad', 'usuario.idEspecialidad', '=', 'especialidad.idEspecialidad')
				->where('Username', 'LIKE', "%$datos%")
				->orWhere(DB::raw("REPLACE(CONCAT(Nombre, Paterno, Materno), ' ', '')"), 'LIKE', "%$datos%")
				->orWhere(DB::raw("REPLACE(CONCAT(Paterno, Materno, Nombre), ' ', '')"), 'LIKE', "%$datos%")
				->orderBy('usuario.Nombre')
				->orderBy('usuario.Paterno')
				->get();

			if(count($usuarioBD) === 0) {
				return null;
			}

			foreach ($usuarioBD as $usuarioBD) {
				if($usuarioBD->idEspecialidad === 1) {
					$usuario = new Usuario($usuarioBD->Username);
				} else {
					$usuario = new Medico($usuarioBD->Username);
					$usuario->setEspecialidad(new Especialidad($usuarioBD->idEspecialidad, $usuarioBD->Especialidad));
				}

				// construir objetos
				$usuarioTipo = new UsuarioTipo($usuarioBD->idUsuarioTipo, $usuarioBD->UsuarioTipo);
				$usuario->setPasswd($usuarioBD->Passwd);
				$usuario->setActivo($usuarioBD->Activo);
				$usuario->setNombre($usuarioBD->Nombre);
				$usuario->setPaterno($usuarioBD->Paterno);
				$usuario->setMaterno($usuarioBD->Materno);
				$usuario->setRegistrado(true);
				$usuario->setFechaCreacion($usuarioBD->FechaCreacion);
				$usuario->setUsuarioTipo($usuarioTipo);

				$usuarios[] = $usuario;
			}

			return $usuarios;

		} catch (Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}

	/**
	 * obtener un usuario por su username
	 * @param $username
	 * @return \Siacme\Dominio\Usuarios\Usuario
	 */
	public function obtenerPorUsername($username)
	{
		// TODO: Implement obtenerPorUsername() method.
		$this->entityManager->createQuery('SELECT u, us, e FROM ');
	}
}