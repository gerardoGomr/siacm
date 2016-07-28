<?php
namespace Siacme\Infraestructura\Expedientes;

use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Expedientes\Repositorios\ExpedientesRepositorio;
use Siacme\Dominio\Pacientes\Paciente;
use Siacme\Dominio\Usuarios\Usuario;
use Siacme\Exceptions\PDO\PDOLogger;
use Doctrine\ORM\EntityManager;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class ExpedientesRepositorioLaravelMySQL
 * @package Siacme\Infraestructura\Expedientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class DoctrineExpedientesRepositorio implements ExpedientesRepositorio
{
	/**
	 * DoctrineExpedientesRepositorio constructor.
	 * @param EntityManager $em
	 */
	public function __construct(EntityManager $em)
	{
		$this->entityManager = $em;
	}

	/**
	 * obtener un expediente por el paciente al que le pertenece y al médico que atiende
	 * @param Paciente $paciente
	 * @param Usuario $medico
	 * @return Expediente|null
	 */
	public function obtenerPorPacienteMedico(Paciente $paciente, Usuario $medico)
	{
		// TODO: Implement obtenerPorPacienteMedico() method.
		try {

			$query = $this->entityManager->createQuery("SELECT e, p, ee FROM Expedientes:Expediente e JOIN e.paciente p LEFT JOIN e.expedienteEspecialidad ee WHERE p.id = :pacienteId")
				->setParameter('pacienteId', $paciente->getId());

			$expediente = $query->getResult();

			if (count($expediente) === 0) {
				return null;
			}

			return $expediente[0];

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

	/**
	 * @return array
	 */
	public function obtenerTodos()
	{
		// TODO: Implement obtenerTodos() method.
	}

	/**
	 * persistir un nuevo expediente
	 * @param Expediente $expediente
	 * @return bool
	 */
	public function persistir(Expediente $expediente)
	{
		// TODO: Implement persistir() method.
		try {
			$this->entityManager->persist($expediente);
			$this->entityManager->flush();

			return true;

		} catch (\PDOException $e) {
			$pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
			$pdoLogger->log($e);
			return false;
		}
	}
}