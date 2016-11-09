<?php
namespace Siacme\Infraestructura\Expedientes;

use Siacme\Dominio\Expedientes\Diente;
use Siacme\Dominio\Expedientes\Repositorios\DientesRepositorio;
use Siacme\Exceptions\PDO\PDOLogger;
use Doctrine\ORM\EntityManager;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PDOException;

/**
 * Class DoctrineDientesRepositorio
 * @package Siacme\Infraestructura\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class DoctrineDientesRepositorio implements DientesRepositorio
{
    /**
     * DoctrinePadecimientosRepositorio constructor.
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
        try {
            $query              = $this->entityManager->createQuery("SELECT d FROM Expedientes:DienteTratamiento d WHERE d.id = :id")
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
     * obtener todos los diente tratamientos
     * @return array
     */
    public function obtenerTodos()
    {
        // TODO: Implement obtenerTodos() method.
        try {
            $query              = $this->entityManager->createQuery("SELECT d FROM Expedientes:DienteTratamiento d ORDER BY d.tratamiento");
            $dienteTratamientos = $query->getResult();

            if (count($dienteTratamientos) === 0) {
                return null;
            }

            return $dienteTratamientos;

        } catch (PDOException $e) {
            $pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return null;
        }
    }

    /**
     * obtener un diente en base al número
     * @param int $numero
     * @return Diente
     */
    public function obtenerPorNumero($numero)
    {
        // TODO: Implement obtenerPorNumero() method.
        try {
            $query = $this->entityManager->createQuery("SELECT d FROM Expedientes:Diente d WHERE d.numero = :numero")
                ->setParameter('numero', $numero);

            $diente = $query->getResult();

            if (count($diente) === 0) {
                return null;
            }

            return $diente[0];

        } catch (PDOException $e) {
            $pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return null;
        }
    }
}