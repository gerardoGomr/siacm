<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class Anexo
 * @package Siacme\Dominio\Expedientes
 * @author  Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class Anexo
{
    /**
     * @var string
     */
    private $nombre;

    /**
     * Anexo Constructor
     * @param string $nombre
     */
    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * elimina espacios en blanco y diagonales del nombre
     * @return string
     */
    public function preparar()
    {
        $this->nombre = str_replace('/', '_', $this->nombre);
        $this->nombre = str_replace(' ', '_', $this->nombre);
        $this->nombre = str_replace('\\', '_', $this->nombre);

        return $this->nombre;
    }

    /**
     * devuelve el nombre del anexo
     * @return string
     */
    public function nombre()
    {
        return $this->nombre;
    }

    /**
     * Nombre real del anexo
     * @return string
     */
    public function nombreFormal()
    {
        return str_replace('_', ' ', $this->nombre);
    }
}