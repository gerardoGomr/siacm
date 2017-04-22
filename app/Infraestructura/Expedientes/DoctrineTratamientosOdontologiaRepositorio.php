<?php
namespace Siacme\Infraestructura\Expedientes;

use Siacme\Dominio\Expedientes\Repositorios\TratamientosOdontologiaRepositorio;
use Doctrine\ORM\EntityManager;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PDOException;
use Siacme\Dominio\Expedientes\TratamientoOdontologia;
use Siacme\Exceptions\SiacmeLogger;

/**
 * Class DoctrineTratamientosOdontologiaRepositorio
 * @package Siacme\Infraestructura\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class DoctrineTratamientosOdontologiaRepositorio implements TratamientosOdontologiaRepositorio
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
     * obtener un tratamiento de odontologia en base a su id
     *
     * @param int $id
     * @return TratamientoOdontologia
     */
    public function obtenerPorId($id)
    {
        // TODO: Implement obtenerPorId() method.
        try {
            $tratamiento = $this->entityManager->createQuery("SELECT t FROM Expedientes:TratamientoOdontologia t WHERE t.id = :id")
                ->setParameter('id', $id)
                ->getResult();

            if (count($tratamiento) === 0) {
                return null;
            }

            return $tratamiento[0];

        } catch (PDOException $e) {
            $pdoLogger = new SiacmeLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
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
            $pdoLogger = new SiacmeLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return null;
        }
    }

    /**
     * @inheritdoc
     */
    public function persistir(TratamientoOdontologia $tratamientoOdontologia)
    {
        try {
            if (is_null($tratamientoOdontologia->getId())) {
                $this->entityManager->persist($tratamientoOdontologia);
            }

            $this->entityManager->flush();

            return true;

        } catch (PDOException $e) {
            $pdoLogger = new SiacmeLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return false;
        }
    }
}