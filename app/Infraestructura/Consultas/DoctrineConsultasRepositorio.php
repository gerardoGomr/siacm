<?php
namespace Siacme\Infraestructura\Consultas;

use DateTime;
use Doctrine\ORM\EntityManager;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PDOException;
use Siacme\Dominio\Consultas\Consulta;
use Siacme\Dominio\Consultas\Repositorios\ConsultasRepositorio;
use Siacme\Dominio\Usuarios\Usuario;
use Siacme\Exceptions\SiacmeLogger;

/**
 * Class DoctrineConsultaCostosRepositorio
 * @package Siacme\Infraestructura\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class DoctrineConsultasRepositorio implements ConsultasRepositorio
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
     * @return Consulta|null
     */
    public function obtenerPorId($id)
    {
        // TODO: Implement obtenerPorId() method.
        try {
            $consultas = $this->entityManager->createQuery("SELECT c, e FROM Consultas:Consulta c JOIN c.expediente e WHERE c.id = :id")
                ->setParameter('id', $id)
                ->getResult();

            if (count($consultas) === 0) {
                return null;
            }

            return $consultas[0];

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
            $query   = $this->entityManager->createQuery("SELECT c FROM Consultas:ConsultaCosto c ORDER BY c.concepto");
            $consultaCostos = $query->getResult();

            if (count($consultaCostos) === 0) {
                return null;
            }

            return $consultaCostos;

        } catch (PDOException $e) {
            $pdoLogger = new SiacmeLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return null;
        }
    }

    /**
     * @inheritdoc
     */
    public function obtenerConsultasNoPagadasDelDia(DateTime $fecha)
    {
        // TODO: Implement obtenerConsultasNoPagadasDelDia() method.
        try {
            $consultas = $this->entityManager->createQuery("SELECT c, e FROM Consultas:Consulta c JOIN c.expediente e WHERE c.pagada = false AND c.fecha = :fecha ORDER BY c.fecha")
                ->setParameter('fecha', $fecha->format('Y-m-d'))
                ->getResult();
                
            if (count($consultas) === 0) {
                return null;
            }

            return $consultas;

        } catch (PDOException $e) {
            $pdoLogger = new SiacmeLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return null;
        }
    }

    /**
     * @inheritdoc
     */
    public function persistir(Consulta $consulta)
    {
        // TODO: Implement persistir() method.
        try {
            if (is_null($consulta->getId())) {
                $this->entityManager->persist($consulta);
            }

            $this->entityManager->flush();

            return true;

        } catch (PDOException $e) {
            $pdoLogger = new SiacmeLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function obtenerPorFechaYMedico($fecha, Usuario $medico)
    {
        // TODO: Implement obtenerPorFechaYMedico() method.
        try {
            $consultas = $this->entityManager->createQuery('SELECT c, e, p FROM Consultas:Consulta c JOIN c.expediente e JOIN e.paciente p JOIN c.medico m WHERE c.fecha = :fecha AND m.id = :medicoId')
                ->setParameter('fecha', $fecha)
                ->setParameter('medicoId', $medico->getId())
                ->getResult();

            if (count($consultas) === 0) {
                return null;
            }

            return $consultas;

        } catch (PDOException $e) {
            $pdoLogger = new SiacmeLogger(new Logger('pdo_exception'), new StreamHandler(storage_path() . '/logs/pdo/sqlsrv_' . date('Y-m-d') . '.log', Logger::ERROR));
            $pdoLogger->log($e);
            return null;
        }
    }
}