<?php
namespace Siacme\Infraestructura\Usuarios;

use PDOException;
use Siacme\Dominio\Usuarios\Especialidad;
use Siacme\Dominio\Usuarios\Repositorios\EspecialidadesRepositorio;
use Doctrine\ORM\EntityManager;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Siacme\Exceptions\SiacmeLogger;

/**
 * Class DoctrineEspecialidadesRepositorio
 * @package Siacme\Infraestructura\Usuarios
 * @author  Gerardo Adrián Gómez Ruiz
 */
class DoctrineEspecialidadesRepositorio implements EspecialidadesRepositorio
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
	 * @param int $id
	 * @return Especialidad
	 */
	public function obtenerPorId($id)
	{
		// TODO: Implement obtenerPorId() method.
		try {
            $especialidades = $this->entityManager->createQuery('SELECT e FROM Usuarios:Especialidad e WHERE e.id = :id ORDER BY e.especialidad')
                ->setParameter('id', $id)
                ->getResult();

            if (count($especialidades) > 0) {
                return $especialidades[0];
            }

			return null;

		} catch (PDOException $e) {
			$pdoLogger = new SiacmeLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
			$pdoLogger->log($e);
			return null;
		}
	}

	/**
     * obtener una lista de especialidades
     *
	 * @return array
	 */
	public function obtenerTodos()
	{
		// TODO: Implement obtenerTodos() method.
        try {
            $especialidades = $this->entityManager->createQuery('SELECT e FROM Usuarios:Especialidad e ORDER BY e.especialidad')
                ->getResult();

            if (count($especialidades) > 0) {
                return $especialidades;
            }

            return null;

        } catch (PDOException $e) {
            $pdoLogger = new SiacmeLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return null;
        }
	}
}