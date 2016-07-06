<?php
namespace Siacme\Infraestructura\Usuarios;

/**
 * @package Siacme\Infraestructura\Usuarios
 * @author Gerardo Adrián Gómez Ruiz
 */
interface TipoUsuariosRepositorio
{
	/**
	 * @return array
	 */
	public function obtenerTipoUsuarios();
}