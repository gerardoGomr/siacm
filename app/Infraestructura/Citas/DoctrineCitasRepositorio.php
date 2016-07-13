<?php
namespace Siacme\Infraestructura\Citas;

use Doctrine\ORM\EntityManager;
use Siacme\Dominio\Citas\Cita;
use Siacme\Dominio\Citas\Repositorios\CitasRepositorio;
use Siacme\Dominio\Usuarios\Usuario;
use Siacme\Exceptions\PDO\PDOLogger;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * @package Siacme\Citas
 * @author  Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class DoctrineCitasRepositorio implements CitasRepositorio
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
	 * @param int $id
	 * @return mixed
	 */
	public function obtenerPorId($id)
	{
		// TODO: Implement obtenerPorId() method.
	}


	/**
	 * @param Cita $cita
	 * @return bool
	 */
	public function persistir(Cita $cita)
	{
		// TODO: Implement persistir() method.
		try {
			$this->entityManager->persist($cita);
			$this->entityManager->flush();
			return true;

		} catch (\PDOException $e) {
			$pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
			$pdoLogger->log($e);
			return false;
		}
	}

	/**
	 * obtener citas por el medico
	 * @param Usuario $medico
	 * @param string|null $fecha
	 * @return array|null
	 */
	public function obtenerPorMedico(Usuario $medico, $fecha = null)
	{
		// TODO: Implement obtenerPorMedico() method.
		try {

			if (!is_null($fecha)) {
				$query = $this->entityManager->createQuery("SELECT c, p, m FROM Citas:Cita c JOIN c.paciente p JOIN c.medico m WHERE m.username = :username AND c.fecha = :fecha")
						->setParameter('username', $medico)->setParameter('fecha', $fecha);
			} else {
				$query = $this->entityManager->createQuery("SELECT c, p, m FROM Citas:Cita c JOIN c.paciente p JOIN c.medico m WHERE m.username = :username")
						->setParameter('username', $medico);
			}

			$citas = $query->getResult();

			if (count($citas) === 0) {
				return null;
			}

			return $citas;

		} catch (\PDOException $e) {
			$pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
			$pdoLogger->log($e);
			return null;
		}
	}
}