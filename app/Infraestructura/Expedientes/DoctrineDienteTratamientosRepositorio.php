<?php
namespace Siacme\Infraestructura\Expedientes;

use Siacme\Dominio\Expedientes\Repositorios\DienteTratamientosRepositorio;
use Siacme\Exceptions\PDO\PDOLogger;
use Doctrine\ORM\EntityManager;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PDOException;

/**
 * Class DoctrineDienteTratamientosRepositorio
 * @package Siacme\Infraestructura\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class DoctrineDienteTratamientosRepositorio implements DienteTratamientosRepositorio
{
    /**
     * @var EntityManager
     */
    private $entityManager;

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
}