<?php
namespace Siacme\Infraestructura\Usuarios;

use Siacme\Dominio\Usuarios\Repositorios\UsuariosRepositorio;
use Doctrine\ORM\EntityManager;
use Siacme\Exceptions\PDO\PDOLogger;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Class UsuariosRepositorioMySQL
 * @package Siacme\Infraestructura\Usuarios
 * @author  Gerardo Adrián Gómez Ruiz
 */
class DoctrineUsuariosRepositorio implements UsuariosRepositorio
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

	/**
	 * obtener un usuario por su username
	 * @param $username
	 * @return \Siacme\Dominio\Usuarios\Usuario
	 */
	public function obtenerPorUsername($username)
	{
		// TODO: Implement obtenerPorUsername() method.
		try {
			$query = $this->entityManager->createQuery('SELECT u, us, e FROM Usuarios:Usuario u JOIN u.usuarioTipo us JOIN u.especialidad e WHERE u.username = :username')
				->setParameter('username', $username);

			$usuario = $query->getResult();

			if (count($usuario) > 0) {
				return $usuario[0];
			}

			return null;

		} catch (\PDOException $e) {
            $pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return null;
        }
	}
}