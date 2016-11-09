<?php
namespace Siacme\Infraestructura\Interconsultas;

use Siacme\Dominio\Interconsultas\Interconsulta;
use Siacme\Dominio\Interconsultas\Repositorios\InterconsultasRepositorio;
use Doctrine\ORM\EntityManager;
use Siacme\Exceptions\PDO\PDOLogger;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PDOException;

/**
 * Class DoctrineInterconsultasRepositorio
 * @package Siacme\Infraestructura\Interconsultas
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class DoctrineInterconsultasRepositorio implements InterconsultasRepositorio
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
     * @return Interconsulta|null
     */
    public function obtenerPorId($id)
    {
        // TODO: Implement obtenerPorId() method.
        try {
            $query = $this->entityManager->createQuery("SELECT i, m FROM Interconsultas:Interconsulta i JOIN i.medico m WHERE i.id = :id")
                ->setParameter('id', $id);

            $interconsulta = $query->getResult();

            if (count($interconsulta) === 0) {
                return null;
            }

            return $interconsulta[0];

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
}