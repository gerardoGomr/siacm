<?php
namespace Siacme\Infraestructura\Expedientes;

use PDOException;
use Siacme\Dominio\Expedientes\MorfologiaFacial;
use Siacme\Exceptions\PDO\PDOLogger;
use Doctrine\ORM\EntityManager;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class DoctrineMorfologiasFacialesRepositorio
 * @package Siacme\Infraestructura\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class DoctrineMorfologiasFacialesRepositorio
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
     * @return MorfologiaFacial
     */
    public function obtenerPorId($id)
    {
        // TODO: Implement obtenerTodos() method.
        try {
            $query      = $this->entityManager->createQuery("SELECT m FROM Expedientes:MorfologiaFacial m WHERE m.id = :id")
                ->setParameter('id', $id);

            $morfologias = $query->getResult();

            if (count($morfologias) === 0) {
                return null;
            }

            return $morfologias[0];

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
            $query      = $this->entityManager->createQuery("SELECT m FROM Expedientes:MorfologiaFacial m ORDER BY m.morfologiaFacial");
            $morfologias = $query->getResult();

            if (count($morfologias) === 0) {
                return null;
            }

            return $morfologias;

        } catch (PDOException $e) {
            $pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return null;
        }
    }
}