<?php
namespace Siacme\Aplicacion\Servicios;

/**
 * Class HttpResponse
 *
 * Used for encapsulating a http response
 *
 * @package Siacme\Aplicacion\Servicios
 * @author Gerardo Adrián Gómez Ruiz <gerardo.gomr@gmail.com>
 * @category Servicio de Aplicación
 */
class HttpResponse
{
	/**
	 * @var string when response is ok
	 */
	const SUCCESS = 'success';

	/**
	 * @var string when response is failure
	 */
	const ERROR   = 'error';
}