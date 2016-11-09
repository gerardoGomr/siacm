<?php
namespace Siacme\Infraestructura\Interconsultas;

use Siacme\Dominio\Interconsultas\Repositorios\MedicosReferenciaRepositorio;
use Siacme\Dominio\Interconsultas\MedicoReferencia;
use Siacme\Exceptions\PDO\PDOLogger;
use Doctrine\ORM\EntityManager;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PDOException;

/**
 * Class DoctrineMedicosReferenciaRepositorio
 * @package Siacme\Infraestructura\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 */
class DoctrineMedicosReferenciaRepositorio implements MedicosReferenciaRepositorio
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
     * @return MedicoReferencia
     */
    public function obtenerPorId($id)
    {
        // TODO: Implement obtenerPorId() method.
        try {
            $query   = $this->entityManager->createQuery("SELECT m, e FROM Interconsultas:MedicoReferencia m INNER JOIN m.especialidad e WHERE m.id = :id")
                ->setParameter('id', $id);

            $medicosReferencia = $query->getResult();

            if (count($medicosReferencia) === 0) {
                return null;
            }

            return $medicosReferencia[0];

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
            $query   = $this->entityManager->createQuery("SELECT m FROM Interconsultas:MedicoReferencia m ORDER BY m.nombre");
            $medicosReferencia = $query->getResult();

            if (count($medicosReferencia) === 0) {
                return null;
            }

            return $medicosReferencia;

        } catch (PDOException $e) {
            $pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return null;
        }
    }
}