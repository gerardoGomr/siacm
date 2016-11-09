<?php
namespace Siacme\Infraestructura\Consultas;

use Siacme\Dominio\Consultas\ConsultaCosto;
use Siacme\Dominio\Consultas\Repositorios\ConsultaCostosRepositorio;
use Siacme\Exceptions\PDO\PDOLogger;
use Doctrine\ORM\EntityManager;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PDOException;

/**
 * Class DoctrineConsultaCostosRepositorio
 * @package Siacme\Infraestructura\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class DoctrineConsultaCostosRepositorio implements ConsultaCostosRepositorio
{
    /**
     * DoctrineConsultaCostosRepositorio constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
    }

    /**
     * @param int $id
     * @return ConsultaCosto|null
     */
    public function obtenerPorId($id)
    {
        // TODO: Implement obtenerPorId() method.
        try {
            $query   = $this->entityManager->createQuery("SELECT c FROM Consultas:ConsultaCosto c WHERE c.id = :id")
                ->setParameter('id', $id);
            $consultaCosto = $query->getResult();

            if (count($consultaCosto) === 0) {
                return null;
            }

            return $consultaCosto[0];

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
            $query   = $this->entityManager->createQuery("SELECT c FROM Consultas:ConsultaCosto c ORDER BY c.concepto");
            $consultaCostos = $query->getResult();

            if (count($consultaCostos) === 0) {
                return null;
            }

            return $consultaCostos;

        } catch (PDOException $e) {
            $pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return null;
        }
    }
}