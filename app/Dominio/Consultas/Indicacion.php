<?php
namespace Siacme\Dominio\Consultas;

/**
 *
 * @package Siacme\Dominio\Consultas
 * @category Entity Class
 * @author Gerardo Adrián Gómez Ruiz
 */
class Indicacion
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
    private $cuerpo;

    /**
     * Indicacion constructor.
     *
     * @param string $cuerpo
     * @param string $nombre
     */
    public function __construct($cuerpo, $nombre = '')
    {
        $this->nombre = $nombre;
        $this->cuerpo = $cuerpo;
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
    public function getCuerpo()
    {
        return $this->cuerpo;
    }
}