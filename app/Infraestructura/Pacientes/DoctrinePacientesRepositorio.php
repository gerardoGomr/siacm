<?php
namespace Siacme\Infraestructura\Pacientes;

use Doctrine\ORM\EntityManager;
use Siacme\Dominio\Pacientes\Repositorios\PacientesRepositorio;
use Siacme\Dominio\Pacientes\Paciente;
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
		//$nombre = str_replace(' ', '', $nombre);
		// TODO: Implement obtenerPorNombre() method.
		try {
			$query = $this->entityManager->createQuery("SELECT p, d FROM Pacientes:Paciente p LEFT JOIN p.domicilio d WHERE CONCAT(p.nombre, p.paterno, p.materno) LIKE :nombre OR CONCAT(p.paterno, p.materno, p.nombre) LIKE :nombre OR p.nombre LIKE :nombre")
					->setParameter('nombre', "%$nombre%");

			$pacientes = $query->getResult();

			if (count($pacientes) === 0) {
				return null;
			}

			return $pacientes;

		} catch (\PDOException $e) {
			$pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
			$pdoLogger->log($e);
			return null;
		}
	}

	/**
	 * @param int $id
	 * @return Paciente
	 */
	public function obtenerPorId($id)
	{
		// TODO: Implement obtenerPorId() method.
		try {
			$query = $this->entityManager->createQuery("SELECT p, d FROM Pacientes:Paciente p LEFT JOIN p.domicilio d WHERE p.id = :id")
					->setParameter('id', $id);

			$pacientes = $query->getResult();

			if (count($pacientes) === 0) {
				return null;
			}

			return $pacientes[0];

		} catch (\PDOException $e) {
			$pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
			$pdoLogger->log($e);
			return null;
		}
	}

	/**
	 * @return array
	 */
	public function obtenerTodos()
	{
		// TODO: Implement obtenerTodos() method.
	}

	/**
     * actualizar paciente
     * @param Paciente $paciente
     * @return bool
     */
    public function persistir(Paciente $paciente)
    {
    	try {
    		$this->entityManager->persist($paciente);
			$this->entityManager->flush();
			return true;

		} catch (\PDOException $e) {
			$pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
			$pdoLogger->log($e);
			return false;
		}	
    }
}