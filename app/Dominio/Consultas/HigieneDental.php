<?php
namespace Siacme\Dominio\Consultas;

/**
 * Class HigieneDental
 *
 * @package Siacme\Dominio\Consultas
 * @category Domain Class
 * @author Gerardo Gomez <gerardo.gomr@hotmail.com>
 */
class HigieneDental
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $indicaciones;

    /**
     * HigieneDental constructor.
     *
     * @param string $indicaciones
     * @param string $nombre
     */
    public function __construct($indicaciones, $nombre = '')
    {
        $this->nombre       = $nombre;
        $this->indicaciones = $indicaciones;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return string
     */
    public function getIndicaciones()
    {
        return $this->indicaciones;
    }
}