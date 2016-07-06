<?php
namespace Siacme\Infraestructura\Usuarios;

use DB;
use Siacme\Dominio\Usuarios\UsuarioTipo;

/**
 * @package Siacme\Infraestructura\Usuarios
 * @author Gerardo Adrián Gómez Ruiz
 */
class TipoUsuariosRepositorioLaravelMySQL implements TipoUsuariosRepositorio
{
	/**
	 * @return array
	 */
	public function obtenerTipoUsuarios()
	{
		try
		{
			$listaUsuarios = [];
			$usuariosTipo = DB::table('usuario_tipo')
				->orderBy('UsuarioTipo')
				->get();

			$totalUsuariosTipo = count($usuariosTipo);

			if($totalUsuariosTipo > 0) {
				foreach ($usuariosTipo as $usuariosTipo) {
					$usuarioTipo = new UsuarioTipo($usuariosTipo->idUsuarioTipo, $usuariosTipo->UsuarioTipo);

					$listaUsuarios[] = $usuarioTipo;
				}

				return $listaUsuarios;
			}

			return null;
		} catch(Exception $e) {
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACM", "Error: ".$e->getMessage());
			return null;
		}
	}
}