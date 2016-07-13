<?php
namespace Siacme\Infraestructura\Pacientes;

use Doctrine\ORM\EntityManager;
use Siacme\Dominio\Pacientes\Repositorios\PacientesRepositorio;
use Siacme\Exceptions\PDO\PDOLogger;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Class PacientesRepositorioMySQL
 * @package Siacme\Infraestructura\Pacientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class DoctrinePacientesRepositorio implements PacientesRepositorio
{

	/**
	 * DoctrinePacientesRepositorio constructor.
	 * @param EntityManager $em
	 */
	public function __construct(EntityManager $em)
	{
		$this->entityManager = $em;
	}

	/**
	 * obtener pacientes por nombre
	 * @param string $nombre
	 * @return array|null
	 */
	public function obtenerPorNombre($nombre)
	{
		// TODO: Implement obtenerPorNombre() method.
		try {
			$query = $this->entityManager->createQuery('SELECT u, us, e FROM Usuarios:Usuario u JOIN u.usuarioTipo us JOIN u.especialidad e WHERE u.username = :username')
					->setParameter('username', $username);

			return null;

		} catch (\PDOException $e) {
			$pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
			$pdoLogger->log($e);
			return null;
		}
	}

	/**
	 * @param int $id
	 * @return mixed
	 */
	public function obtenerPorId($id)
	{
		// TODO: Implement obtenerPorId() method.
	}
}