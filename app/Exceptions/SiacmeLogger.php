<?php
namespace Siacme\Exceptions;

use Exception;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class SiacmeLogger
 * @package Siacme\Exceptions
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class SiacmeLogger
{
    /**
     * @var Logger
     */
    private $logger;

    /**
     * @var StreamHandler
     */
    private $handler;

    /**
     * SidepLogger constructor.
     * @param Logger $logger
     * @param StreamHandler $handler
     */
    public function __construct(Logger $logger, StreamHandler $handler)
    {
        $this->logger  = $logger;
        $this->handler = $handler;
    }

    /**
     * loggear la exception
     * @param Exception $e
     */
    public function log(Exception $e)
    {
        $this->logger->pushHandler($this->handler);
        $this->logger->addError($e->getMessage());
    }
}