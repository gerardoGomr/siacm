<?php
namespace Siacme\Infraestructura\Expedientes;

use PDOException;
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
	 * @param Usuario|null $medico
	 * @return Expediente|null
	 */
	public function obtenerPorPacienteMedico(Paciente $paciente, Usuario $medico = null)
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

		} catch (PDOException $e) {
			$pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
			$pdoLogger->log($e);
			return null;
		}
	}

	/**
	 * @param int $id
	 * @return Expediente
	 */
	public function obtenerPorId($id)
	{
		// TODO: Implement obtenerPorId() method.
		try {

			$query = $this->entityManager->createQuery("SELECT e, p, c, ee, o, oo, t, ta FROM Expedientes:Expediente e JOIN e.paciente p JOIN e.consultas c LEFT JOIN e.expedienteEspecialidad ee LEFT JOIN ee.odontogramas o LEFT JOIN o.odontogramaDientes oo LEFT JOIN oo.padecimientos pa LEFT JOIN oo.tratamientos t LEFT JOIN t.dienteTratamiento ta WHERE e.id = :id")
                ->setParameter('id', $id);

			$expediente = $query->getResult();

			if (count($expediente) === 0) {
				return null;
			}

			return $expediente[0];

		} catch (PDOException $e) {
			$pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
			$pdoLogger->log($e);
			return null;
		}
	}

    /**
     * buscar expedientes que coincidan con el parametro
     * @param array $dato
     * @return array|null
     */
    public function obtenerPor(array $dato)
    {
        $subquery = '';

        if (array_key_exists('dato', $dato)) {
            $dato['dato'] = str_replace(' ', '', $dato['dato']);
            $subquery .= " AND (CONCAT(p.nombre, p.paterno, p.materno) LIKE :dato OR CONCAT(p.paterno, p.materno, p.nombre) = :dato)";
        }

        try {
            $query = $this->entityManager->createQuery("SELECT e, p, ee FROM Expedientes:Expediente e JOIN e.paciente p LEFT JOIN e.expedienteEspecialidad ee WHERE e.id IS NOT NULL" . $subquery);
            if (array_key_exists('dato', $dato)) {
                $query->setParameter('dato', '%' . $dato['dato'] . '%');
            }
            $expedientes = $query->getResult();

            if (count($expedientes) === 0) {
                return null;
            }

            return $expedientes;

        } catch (PDOException $e) {
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
	 * persistir un nuevo expediente
	 * @param Expediente $expediente
	 * @return bool
	 */
	public function persistir(Expediente $expediente)
	{
		// TODO: Implement persistir() method.
		try {

			if (is_null($expediente->getId())) {
				// insertar
				$this->entityManager->persist($expediente);
				// $this->entityManager->persist($expediente->getExpedienteEspecialidad());
			}
			
			$this->entityManager->flush();
			return true;

		} catch (PDOException $e) {
			$pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
			$pdoLogger->log($e);
			return false;
		}
	}

	/**
	 * obtener parte de la construcción del objeto
	 * @param int $id
	 * @return Paciente
	 */
	public function obtenerPacientePorId($id)
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

		} catch (PDOException $e) {
			$pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
			$pdoLogger->log($e);
			return null;
		}
	}

    /**
     * obtener un diente Tratamiento por id
     * @param int $id
     * @return DienteTratamiento|null
     */
    public function obtenerTratamientoPorId($id)
    {
        try {
            $query = $this->entityManager->createQuery("SELECT d FROM Expedientes:DienteTratamiento d WHERE d.id = :id")
                ->setParameter('id', $id);
            $dienteTratamiento = $query->getResult();

            if (count($dienteTratamiento) === 0) {
                return null;
            }

            return $dienteTratamiento[0];

        } catch (PDOException $e) {
            $pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return null;
        }
    }

    /**
     * obtener un diente padecimiento por id
     * @param int $id
     * @return DientePadecimiento
     */
    public function obtenerPadecimientoPorId($id)
    {
        try {
            $query = $this->entityManager->createQuery("SELECT p FROM Expedientes:DientePadecimiento p WHERE p.id = :id")
                ->setParameter('id', $id);

            $dientePadecimiento = $query->getResult();

            if (count($dientePadecimiento) === 0) {
                return null;
            }

            return $dientePadecimiento[0];

        } catch (PDOException $e) {
            $pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return null;
        }
    }
}