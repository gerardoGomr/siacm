<?php
namespace Siacme\Dominio\Consultas;

class ExploracionOtorrino
{
    private $conductoDerecho;
    private $conductoIzquierdo;
    private $membranaDerecha;
    private $membranaIzquierda;
    private $piramideNasal;
    private $septumNasal;
    private $cornetes;
    private $amigdalas;
    private $paredOrofaringe;

    public function addConductores($derecho, $izquierdo)
    {
        $this->conductoDerecho   = $derecho;
        $this->conductoIzquierdo = $izquierdo;

        return $this;
    }

    public function addMembranas($derecha, $izquierda)
    {
        $this->membranaDerecha   = $derecha;
        $this->membranaIzquierda = $izquierda;

        return $this;
    }

    public function addOtrosDatos($piramide, $septum, $cornetes, $amigdalas, $pared)
    {
        $this->piramideNasal = $piramide;
        $this->septumNasal   = $septum;
        $this->cornetes      = $cornetes;
        $this->amigdalas     = $amigdalas;
        $this->paredOrofaringe = $pared;

        return $this;
    }
}
