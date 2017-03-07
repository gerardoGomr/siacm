<?php
namespace Siacme\Infraestructura\Usuarios;

use PDOException;
use Siacme\Dominio\Usuarios\Repositorios\UsuariosRepositorio;
use Doctrine\ORM\EntityManager;
use Siacme\Dominio\Usuarios\Usuario;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Siacme\Exceptions\SiacmeLogger;

/**
 * Class DoctrineUsuariosRepositorio
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
	 * DoctrineUsuariosRepositorio constructor.
	 * @param EntityManager $em
	 */
	public function __construct(EntityManager $em)
	{
		$this->entityManager = $em;
	}

	/**
	 * obtener un usuario por su username
	 * @param $username
	 * @return Usuario
	 */
	public function obtenerPorUsername($username)
	{
		// TODO: Implement obtenerPorUsername() method.
		try {
            $usuario = $this->entityManager->createQuery('SELECT u, e FROM Usuarios:Usuario u JOIN u.especialidad e WHERE u.username = :username')
				->setParameter('username', $username)
                ->getResult();

			if (count($usuario) > 0) {
				return $usuario[0];
			}

			return null;

		} catch (PDOException $e) {
            $pdoLogger = new SiacmeLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return null;
        }
	}

	/**
	 * @param int $id
	 * @return Usuario
	 */
	public function obtenerPorId($id)
	{
		// TODO: Implement obtenerPorId() method.
		try {
            $usuario = $this->entityManager->createQuery('SELECT u, e FROM Usuarios:Usuario u JOIN u.especialidad e WHERE u.id = :id')
                ->setParameter('id', $id)
                ->getResult();

			if (count($usuario) > 0) {
				return $usuario[0];
			}

			return null;

		} catch (PDOException $e) {
			$pdoLogger = new SiacmeLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
			$pdoLogger->log($e);
			return null;
		}
	}

	/**
     * obtener una lista de usuarios
     *
	 * @return array
	 */
	public function obtenerTodos()
	{
		// TODO: Implement obtenerTodos() method.
        try {
            $usuarios = $this->entityManager->createQuery('SELECT u, e FROM Usuarios:Usuario u JOIN u.especialidad e ORDER BY u.paterno')
                ->setMaxResults(50)
                ->getResult();

            if (count($usuarios) > 0) {
                return $usuarios;
            }

            return null;

        } catch (PDOException $e) {
            $pdoLogger = new SiacmeLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return null;
        }
	}

    /**
     * persistir un usuario
     *
     * @param Usuario $usuario
     * @return bool
     */
    public function persistir(Usuario $usuario)
    {
        // TODO: Implement persistir() method.
        try {
            if (is_null($usuario->getId())) {
                $this->entityManager->persist($usuario);
            }

            $this->entityManager->flush();

            return true;

        } catch (PDOException $e) {
            $pdoLogger = new SiacmeLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return false;
        }
    }
}