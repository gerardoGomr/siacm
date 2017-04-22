<?php
namespace Siacme\Infraestructura\Expedientes;

use Siacme\Dominio\Expedientes\OtroTratamiento;
use Siacme\Dominio\Expedientes\Repositorios\OtrosTratamientosRepositorio;
use Siacme\Exceptions\PDO\PDOLogger;
use Doctrine\ORM\EntityManager;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PDOException;

/**
 * Class DoctrineOtrosTratamientosRepositorio
 * @package Siacme\Infraestructura\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class DoctrineOtrosTratamientosRepositorio implements OtrosTratamientosRepositorio
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
     * @return OtroTratamiento
     */
    public function obtenerPorId($id)
    {
        // TODO: Implement obtenerPorId() method.
        try {
            $query = $this->entityManager->createQuery("SELECT o FROM Expedientes:OtroTratamiento o WHERE o.id = :id")
                ->setParameter('id', $id);

            $otroTratamiento = $query->getResult();

            if (count($otroTratamiento) === 0) {
                return null;
            }

            return $otroTratamiento[0];

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
            $query             = $this->entityManager->createQuery("SELECT o FROM Expedientes:OtroTratamiento o ORDER BY o.tratamiento");
            $otrosTratamientos = $query->getResult();

            if (count($otrosTratamientos) === 0) {
                return null;
            }

            return $otrosTratamientos;

        } catch (PDOException $e) {
            $pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return null;
        }
    }
}