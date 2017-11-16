<?php
namespace Siacme\Dominio\Consultas;

/**
 * Class HigieneConsultaReceta
 *
 * @package Siacme\Dominio\Consultas
 * @category Domain class
 * @author Gerardo Gomez <gerardo.gomr@gmail.com>
 */
class HigieneDentalConsulta
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