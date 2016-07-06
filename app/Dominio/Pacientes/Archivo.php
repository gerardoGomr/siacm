<?php
namespace Siacme\Dominio\Pacientes;

/**
 * Class Archivo
 * @package Siacme\Dominio\Pacientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class Archivo
{
    /**
     * @var string
     */
    private $nombre;

    /**
     * @var double
     */
    private $peso;

    /**
     * tipo de archivo (mime-type)
     * @var string
     */
    private $tipo;

    /**
     * Anexo constructor.
     * @param string $nombre
     * @param string $ruta
     * @param string $tipo
     * @throws \Exception
     */
    public function __construct($nombre, $tipo = null)
    {
        $this->nombre = $nombre;
        $this->tipo   = $tipo;
    }

    /**
     * @return float
     */
    public function getPeso()
    {
        return $this->peso;
    }

    /**
     * devuelve el peso del anexo en megabytes
     */
    public function setPeso()
    {
        $this->peso = filesize($this->ruta);
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param string $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * formatea el peso del anexo
     * @return string
     */
    public function peso()
    {
        return (string)$this->peso.'MB';
    }
}