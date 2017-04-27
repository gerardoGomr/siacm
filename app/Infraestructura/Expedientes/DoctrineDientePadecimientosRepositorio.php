<?php
namespace Siacme\Infraestructura\Expedientes;

use Doctrine\ORM\EntityManager;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Siacme\Dominio\Expedientes\Repositorios\DientePadecimientosRepositorio;
use Siacme\Exceptions\SiacmeLogger;
use \PDOException;

/**
 * Class DoctrineDientePadecimientosRepositorio
 * @package Siacme\Infraestructura\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class DoctrineDientePadecimientosRepositorio implements DientePadecimientosRepositorio
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
            $dientePadecimiento = $this->entityManager->createQuery("SELECT p FROM Expedientes:DientePadecimiento p WHERE p.id = :id")
                ->setParameter('id', $id)
                ->getResult();

            if (count($dientePadecimiento) === 0) {
                return null;
            }

            return $dientePadecimiento[0];

        } catch (PDOException $e) {
            $pdoLogger = new SiacmeLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
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
            $dientePadecimientos = $this->entityManager->createQuery("SELECT p FROM Expedientes:DientePadecimiento p ORDER BY p.nombre")
                ->getResult();

            if (count($dientePadecimientos) === 0) {
                return null;
            }

            return $dientePadecimientos;

        } catch (PDOException $e) {
            $pdoLogger = new SiacmeLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return null;
        }
    }
}
