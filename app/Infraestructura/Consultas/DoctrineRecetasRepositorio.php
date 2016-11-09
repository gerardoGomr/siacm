<?php
namespace Siacme\Infraestructura\Consultas;

use Siacme\Dominio\Consultas\Receta;
use Siacme\Dominio\Consultas\Repositorios\RecetasRepositorio;
use Siacme\Exceptions\PDO\PDOLogger;
use Doctrine\ORM\EntityManager;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PDOException;

/**
 * Class DoctrineRecetasRepositorio
 * @package Siacme\Infraestructura\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 */
class DoctrineRecetasRepositorio implements RecetasRepositorio
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
     * @return Receta|null
     */
    public function obtenerPorId($id)
    {
        // TODO: Implement obtenerPorId() method.
        try {
            $query   = $this->entityManager->createQuery("SELECT r FROM Consultas:RecetaConsulta r WHERE r.id = :id")
                ->setParameter('id', $id);

            $recetas = $query->getResult();

            if (count($recetas) === 0) {
                return null;
            }

            return $recetas[0];

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
            $query   = $this->entityManager->createQuery("SELECT r FROM Consultas:Receta r ORDER BY r.nombre");
            $recetas = $query->getResult();

            if (count($recetas) === 0) {
                return null;
            }

            return $recetas;

        } catch (PDOException $e) {
            $pdoLogger = new PDOLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return null;
        }
    }
}