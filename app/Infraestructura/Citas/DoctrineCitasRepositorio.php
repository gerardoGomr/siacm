<?php
namespace Siacme\Infraestructura\Citas;

use Doctrine\ORM\EntityManager;
use PDOException;
use Siacme\Dominio\Citas\Cita;
use Siacme\Dominio\Citas\Repositorios\CitasRepositorio;
use Siacme\Dominio\Usuarios\Usuario;
use Siacme\Exceptions\PDO\SiacmeLogger;
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
     * @var EntityManager
     */
    private $entityManager;

	/**
	 * DoctrineCitasRepositorio constructor.
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
		try {

			$query = $this->entityManager->createQuery("SELECT c, p, m FROM Citas:Cita c JOIN c.paciente p JOIN c.medico m WHERE c.id = :id")->setParameter('id', $id);

			$citas = $query->getResult();

			if (count($citas) === 0) {
				return null;
			}

			return $citas[0];

		} catch (PDOException $e) {
			$pdoLogger = new SiacmeLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
			$pdoLogger->log($e);
			return null;
		}
	}


	/**
	 * @param Cita $cita
	 * @return bool
	 */
	public function persistir(Cita $cita)
	{
		try {
			$this->entityManager->persist($cita);
			$this->entityManager->flush();
			return true;

		} catch (PDOException $e) {
			$pdoLogger = new SiacmeLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
			$pdoLogger->log($e);
			return false;
		}
	}

	/**
	 * obtener citas por el medico
     *
	 * @param Usuario $medico
	 * @param string|null $fecha
	 * @return array|null
	 */
	public function obtenerPorMedico(Usuario $medico, $fecha = null)
	{
		try {

			if (!is_null($fecha)) {
				$query = $this->entityManager->createQuery("SELECT c, p, m FROM Citas:Cita c JOIN c.paciente p JOIN c.medico m WHERE m.id = :id AND c.fecha = :fecha AND c.estatus != 5 ORDER BY c.fecha, c.hora")
                    ->setParameter('id', $medico->getId())
                    ->setParameter('fecha', $fecha);
			} else {
				$query = $this->entityManager->createQuery("SELECT c, p, m FROM Citas:Cita c JOIN c.paciente p JOIN c.medico m WHERE m.id = :id AND c.estatus != 5 ORDER BY c.fecha, c.hora")
                    ->setParameter('id', $medico->getId());
			}

			$citas = $query->getResult();

			if (count($citas) === 0) {
				return null;
			}

			return $citas;

		} catch (PDOException $e) {
			$pdoLogger = new SiacmeLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
			$pdoLogger->log($e);
			return null;
		}
	}

	/**
	 * actualizar cita
	 * @param Cita $cita
	 * @return bool
	 */
	public function actualizar(Cita $cita)
	{
		try {
			$this->entityManager->flush();
			return true;

		} catch (PDOException $e) {
			$pdoLogger = new SiacmeLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
			$pdoLogger->log($e);
			return false;
		}
	}

	/**
	 * @return array
	 */
	public function obtenerTodos()
	{
		// TODO: Implement obtenerTodos() method.
	}
}