<?php
namespace Siacme\Dominio\Pacientes;
use Illuminate\Support\Collection;

/**
 * Class Anexo
 * @package Siacme\Dominio\Pacientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class Anexo
{
    private $nombre;
    private $anexo;

    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }

    public function preparar()
    {
        return str_replace(' ', '_', $this->nombre);
    }

    public function nombre()
    {
        return $this->nombre;
    }

    public function nombreFormal()
    {
        return str_replace('_', ' ', $this->nombre);
    }
}