<?php
namespace Siacme\Infraestructura\Expedientes;

use PDOException;
use Siacme\Dominio\Expedientes\ComportamientoFrankl;
use Siacme\Dominio\Expedientes\Repositorios\ComportamientosFranklRepositorio;
use Siacme\Exceptions\PDO\PDOLogger;
use Doctrine\ORM\EntityManager;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class DoctrineComportamientosFranklRepositorio
 * @package Siacme\Infraestructura\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class DoctrineComportamientosFranklRepositorio implements ComportamientosFranklRepositorio
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
     * @return ComportamientoFrankl
     */
    public function obtenerPorId($id)
    {
        // TODO: Implement obtenerPorId() method.
        try {
            $query           = $this->entityManager->createQuery("SELECT c FROM Expedientes:ComportamientoFrankl c WHERE c.id = :id")
                ->setParameter('id', $id);
            $comportamientos = $query->getResult();

            if (count($comportamientos) === 0) {
                return null;
            }

            return $comportamientos[0];

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
        try {
            $query           = $this->entityManager->createQuery("SELECT c FROM Expedientes:ComportamientoFrankl c");
            $comportamientos = $query->getResult();

            if (count($comportamientos) === 0) {
                return null;
            }

            return $comportamientos;

        } catch (PDOException $e) {
            $pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return null;
        }
    }
}