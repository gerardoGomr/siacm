<?php
namespace Siacme\Dominio\Pacientes;

/**
 * Class PacienteJohanna
 * @package Siacme\Dominio\Pacientes;
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class PacienteJohanna extends Paciente
{
    /**
     * @var string
     */
    protected $nombrePadre;

    /**
     * @var string
     */
    protected $nombreMadre;

    /**
     * @var string
     */
    protected $ocupacionPadre;

    /**
     * @var string
     */
    protected $ocupacionMadre;

    /**
     * @var string
     */
    protected $nombreEdadesHermanos;

    /**
     * @var string
     */
    protected $fechaUltimoExamenBucal;

    /**
     * @var string
     */
    protected $motivoVisitaDentista;

    /**
     * @var string
     */
    protected $reaccionAnestesico;

    /**
     * @var string
     */
    protected $descripcionHabito;

    /**
     * @var string
     */
    protected $especifiqueAuxiliar;

    /**
     * @var string
     */
    protected $notas;

    /**
     * @var string
     */
    protected $labios;

    /**
     * @var string
     */
    protected $carrillos;

    /**
     * @var string
     */
    protected $frenillos;

    /**
     * @var string
     */
    protected $paladar;

    /**
     * @var string
     */
    protected $lengua;

    /**
     * @var string
     */
    protected $pisoDeBoca;

    /**
     * @var string
     */
    protected $parodonto;

    /**
     * @var string
     */
    protected $uvula;

    /**
     * @var string
     */
    protected $amigdalas;

    /**
     * @var string
     */
    protected $orofaringe;

    /**
     * @var int
     */
    protected $edadErupcionoPrimerDiente;

    /**
     * @var bool
     */
    protected $haPresentadoDolorBoca;

    /**
     * @var bool
     */
    protected $presentaMalOlorBoca;

    /**
     * @var bool
     */
    protected $haNotadoSangradoEncias;

    /**
     * @var bool
     */
    protected $sienteDienteFlojo;

    /**
     * @var bool
     */
    protected $disartria;

    /**
     * @var bool
     */
    protected $dislalia;

    /**
     * @var bool
     */
    protected $afasia;

    /**
     * @var bool
     */
    protected $otroTrastorno;

    /**
     * @var bool
     */
    protected $negadoTrastorno;

    /**
     * @var bool
     */
    protected $primeraVisitaDentista;

    /**
     * @var bool
     */
    protected $leHanColocadoAnestesico;

    /**
     * @var bool
     */
    protected $tuvoMalaReaccionAnestesico;

    /**
     * @var bool
     */
    protected $tipoCepilloAdulto;

    /**
     * @var int
     */
    protected $vecesCepillaDiente;

    /**
     * @var bool
     */
    protected $alguienAyudaACepillarse;

    /**
     * @var int
     */
    protected $vecesComeDia;

    /**
     * @var bool
     */
    protected $hiloDental;

    /**
     * @var bool
     */
    protected $enjuagueBucal;

    /**
     * @var bool
     */
    protected $limpiadorLingual;

    /**
     * @var bool
     */
    protected $tabletasReveladoras;

    /**
     * @var bool
     */
    protected $otroAuxiliar;

    /**
     * @var bool
     */
    protected $succionDigital;

    /**
     * @var bool
     */
    protected $succionLingual;

    /**
     * @var bool
     */
    protected $biberon;

    /**
     * @var bool
     */
    protected $bruxismo;

    /**
     * @var bool
     */
    protected $succionLabial;

    /**
     * @var bool
     */
    protected $respiracionBucal;

    /**
     * @var bool
     */
    protected $onicofagia;

    /**
     * @var bool
     */
    protected $chupon;

    /**
     * @var bool
     */
    protected $otroHabito;

    /**
     * @var bool
     */
    protected $posturaRectaCaminar;

    /**
     * @var bool
     */
    protected $posturaRectaSentar;

    /**
     * @var bool
     */
    protected $escalonMesialDerecho;

    /**
     * @var bool
     */
    protected $escalonMesialIzquierdo;

    /**
     * @var bool
     */
    protected $escalonDistalDerecho;

    /**
     * @var bool
     */
    protected $escalonDistalIzquierdo;

    /**
     * @var bool
     */
    protected $escalonRectoDerecho;

    /**
     * @var bool
     */
    protected $escalonRectoIzquierdo;

    /**
     * @var bool
     */
    protected $mesialExageradoDerecho;

    /**
     * @var bool
     */
    protected $mesialExageradoIzquierdo;

    /**
     * @var bool
     */
    protected $noDeterminadoDerecho;

    /**
     * @var bool
     */
    protected $noDeterminadoIzquierdo;

    /**
     * @var bool
     */
    protected $relacionCaninaDerecha;

    /**
     * @var bool
     */
    protected $relacionCaninaIzquierda;

    /**
     * @var bool
     */
    protected $relacionMolarDerechaI;

    /**
     * @var bool
     */
    protected $relacionMolarDerechaII;

    /**
     * @var bool
     */
    protected $relacionMolarDerechaIII;

    /**
     * @var bool
     */
    protected $relacionMolarIzquierdaI;

    /**
     * @var bool
     */
    protected $relacionMolarIzquierdaII;

    /**
     * @var bool
     */
    protected $relacionMolarIzquierdaIII;

    /**
     * @var bool
     */
    protected $relacionCaninaDerechaI;

    /**
     * @var bool
     */
    protected $relacionCaninaDerechaII;

    /**
     * @var bool
     */
    protected $relacionCaninaDerechaIII;

    /**
     * @var bool
     */
    protected $relacionCaninaIzquierdaI;

    /**
     * @var bool
     */
    protected $relacionCaninaIzquierdaII;

    /**
     * @var bool
     */
    protected $relacionCaninaIzquierdaIII;

    /**
     * @var bool
     */
    protected $tipoArcoI;

    /**
     * @var bool
     */
    protected $mordidaBordeBorde;

    /**
     * @var double
     */
    protected $medidaBordeBorde;

    /**
     * @var bool
     */
    protected $sobremordidaVertical;

    /**
     * @var double
     */
    protected $medidaSobremordidaVertical;

    /**
     * @var bool
     */
    protected $sobremordidaHorizontal;

    /**
     * @var double
     */
    protected $medidaSobremordidaHorizontal;

    /**
     * @var bool
     */
    protected $mordidaAbiertaAnterior;

    /**
     * @var double
     */
    protected $medidaMedidaAbiertaAnterior;

    /**
     * @var bool
     */
    protected $mordidaCruzadaAnterior;

    /**
     * @var double
     */
    protected $medidaMordidaCruzadaAnterior;

    /**
     * @var bool
     */
    protected $mordidaCruzadaPosterior;

    /**
     * @var double
     */
    protected $medidaMordidaCruzadaPosterior;

    /**
     * @var bool
     */
    protected $lineaMediaDental;

    /**
     * @var double
     */
    protected $medidaLineaMediaDental;

    /**
     * @var bool
     */
    protected $lineaMediaEsqueletica;

    /**
     * @var double
     */
    protected $medidaLineaMediaEsqueletica;

    /**
     * @var bool
     */
    protected $alteracionesTamanio;

    /**
     * @var double
     */
    protected $medidaAlteracionesTamanio;

    /**
     * @var bool
     */
    protected $alteracionesForma;

    /**
     * @var double
     */
    protected $medidaAlteracionesForma;

    /**
     * @var bool
     */
    protected $alteracionesNumero;

    /**
     * @var double
     */
    protected $medidaAlteracionesNumero;

    /**
     * @var bool
     */
    protected $alteracionesEstructura;

    /**
     * @var double
     */
    protected $medidaAlteracionesEstructura;

    /**
     * @var bool
     */
    protected $alteracionesTextura;

    /**
     * @var double
     */
    protected $medidaAlteracionesTextura;

    /**
     * @var bool
     */
    protected $alteracionesColor;

    /**
     * @var double
     */
    protected $medidaAlteracionesColor;

    /**
     * @var TraumatismoBucal
     */
    protected $traumatismoBucal;

    /**
     * @var MarcaPasta
     */
    protected $marcaPasta;

    /**
     * @var ComportamientoInicial
     */
    protected $comportamientoInicial;

    /**
     * @var ComportamientoFrankl
     */
    protected $comportamientoFrankl;

    /**
     * @var TrastornoLenguaje
     */
    protected $trastornoLenguaje;

    /**
     * @var MorfologiaCraneofacial
     */
    protected $morfologiaCraneofacial;

    /**
     * @var MorfologiaFacial
     */
    protected $morfologiaFacial;

    /**
     * @var ConvexividadFacial
     */
    protected $convexividadFacial;

    /**
     * @var ATM
     */
    protected $atm;

    /**
     * @var Collection
     */
    protected $listaTratamientosOdontologicos;
}