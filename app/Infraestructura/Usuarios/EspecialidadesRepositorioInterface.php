<?php
namespace Siacme\Infraestructura\Usuarios;

/**
 * Interface EspecialidadesRepositorioInterface
 * @package Siacme\Infraestructura\Usuarios
 * @author  Gerardo Adrián Gómez Ruiz
 */
interface EspecialidadesRepositorioInterface
{
	/**
	 * obtener especialidad por id
	 * @param  int $id
	 * @return Especialidad
	 */
	public function obtenerEspecialidadPorId($id);

	/**
	 * @return array
	 */
	public function obtenerEspecialidades();
}