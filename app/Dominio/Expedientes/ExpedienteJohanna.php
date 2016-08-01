<?php
namespace Siacme\Dominio\Expedientes;
use DateTime;

/**
 * Class PacienteJohanna
 * @package Siacme\Dominio\Pacientes;
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class ExpedienteJohanna extends AbstractExpediente
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
     * @var DateTime
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
     * @var int
     */
    protected $tipoCepillo;

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
     * @var string
     */
    protected $traumatismoBucal;

    /**
     * @var int
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
     * @return string
     */
    public function getNombrePadre()
    {
        return $this->nombrePadre;
    }

    /**
     * @return string
     */
    public function getNombreMadre()
    {
        return $this->nombreMadre;
    }

    /**
     * @return string
     */
    public function getOcupacionPadre()
    {
        return $this->ocupacionPadre;
    }

    /**
     * @return string
     */
    public function getOcupacionMadre()
    {
        return $this->ocupacionMadre;
    }

    /**
     * @return string
     */
    public function getFechaUltimoExamenBucal()
    {
        return $this->fechaUltimoExamenBucal->format('Y-m-d');
    }

    /**
     * @return string
     */
    public function getMotivoVisitaDentista()
    {
        return $this->motivoVisitaDentista;
    }

    /**
     * @return string
     */
    public function getReaccionAnestesico()
    {
        return $this->reaccionAnestesico;
    }

    /**
     * @return string
     */
    public function getDescripcionHabito()
    {
        return $this->descripcionHabito;
    }

    /**
     * @return string
     */
    public function getEspecifiqueAuxiliar()
    {
        return $this->especifiqueAuxiliar;
    }

    /**
     * @return string
     */
    public function getNotas()
    {
        return $this->notas;
    }

    /**
     * @return string
     */
    public function getLabios()
    {
        return $this->labios;
    }

    /**
     * @return string
     */
    public function getCarrillos()
    {
        return $this->carrillos;
    }

    /**
     * @return string
     */
    public function getFrenillos()
    {
        return $this->frenillos;
    }

    /**
     * @return string
     */
    public function getPaladar()
    {
        return $this->paladar;
    }

    /**
     * @return string
     */
    public function getLengua()
    {
        return $this->lengua;
    }

    /**
     * @return string
     */
    public function getPisoDeBoca()
    {
        return $this->pisoDeBoca;
    }

    /**
     * @return string
     */
    public function getParodonto()
    {
        return $this->parodonto;
    }

    /**
     * @return string
     */
    public function getUvula()
    {
        return $this->uvula;
    }

    /**
     * @return string
     */
    public function getAmigdalas()
    {
        return $this->amigdalas;
    }

    /**
     * @return string
     */
    public function getOrofaringe()
    {
        return $this->orofaringe;
    }

    /**
     * @return int
     */
    public function getEdadErupcionoPrimerDiente()
    {
        return $this->edadErupcionoPrimerDiente;
    }

    /**
     * @return boolean
     */
    public function haPresentadoDolorBoca()
    {
        return $this->haPresentadoDolorBoca;
    }

    /**
     * @return boolean
     */
    public function presentaMalOlorBoca()
    {
        return $this->presentaMalOlorBoca;
    }

    /**
     * @return boolean
     */
    public function haNotadoSangradoEncias()
    {
        return $this->haNotadoSangradoEncias;
    }

    /**
     * @return boolean
     */
    public function sienteDienteFlojo()
    {
        return $this->sienteDienteFlojo;
    }

    /**
     * @return boolean
     */
    public function primeraVisitaDentista()
    {
        return $this->primeraVisitaDentista;
    }

    /**
     * @return boolean
     */
    public function leHanColocadoAnestesico()
    {
        return $this->leHanColocadoAnestesico;
    }

    /**
     * @return boolean
     */
    public function tuvoMalaReaccionAnestesico()
    {
        return $this->tuvoMalaReaccionAnestesico;
    }

    /**
     * @return int
     */
    public function getTipoCepillo()
    {
        return $this->tipoCepillo;
    }

    /**
     * @return int
     */
    public function getVecesCepillaDiente()
    {
        return $this->vecesCepillaDiente;
    }

    /**
     * @return boolean
     */
    public function alguienAyudaACepillarse()
    {
        return $this->alguienAyudaACepillarse;
    }

    /**
     * @return int
     */
    public function getVecesComeDia()
    {
        return $this->vecesComeDia;
    }

    /**
     * @return boolean
     */
    public function hiloDental()
    {
        return $this->hiloDental;
    }

    /**
     * @return boolean
     */
    public function enjuagueBucal()
    {
        return $this->enjuagueBucal;
    }

    /**
     * @return boolean
     */
    public function limpiadorLingual()
    {
        return $this->limpiadorLingual;
    }

    /**
     * @return boolean
     */
    public function tabletasReveladoras()
    {
        return $this->tabletasReveladoras;
    }

    /**
     * @return boolean
     */
    public function otroAuxiliar()
    {
        return $this->otroAuxiliar;
    }

    /**
     * @return boolean
     */
    public function succionDigital()
    {
        return $this->succionDigital;
    }

    /**
     * @return boolean
     */
    public function succionLingual()
    {
        return $this->succionLingual;
    }

    /**
     * @return boolean
     */
    public function biberon()
    {
        return $this->biberon;
    }

    /**
     * @return boolean
     */
    public function bruxismo()
    {
        return $this->bruxismo;
    }

    /**
     * @return boolean
     */
    public function succionLabial()
    {
        return $this->succionLabial;
    }

    /**
     * @return boolean
     */
    public function respiracionBucal()
    {
        return $this->respiracionBucal;
    }

    /**
     * @return boolean
     */
    public function onicofagia()
    {
        return $this->onicofagia;
    }

    /**
     * @return boolean
     */
    public function chupon()
    {
        return $this->chupon;
    }

    /**
     * @return boolean
     */
    public function otroHabito()
    {
        return $this->otroHabito;
    }

    /**
     * @return boolean
     */
    public function posturaRectaCaminar()
    {
        return $this->posturaRectaCaminar;
    }

    /**
     * @return boolean
     */
    public function posturaRectaSentar()
    {
        return $this->posturaRectaSentar;
    }

    /**
     * @return boolean
     */
    public function escalonMesialDerecho()
    {
        return $this->escalonMesialDerecho;
    }

    /**
     * @return boolean
     */
    public function escalonMesialIzquierdo()
    {
        return $this->escalonMesialIzquierdo;
    }

    /**
     * @return boolean
     */
    public function escalonDistalDerecho()
    {
        return $this->escalonDistalDerecho;
    }

    /**
     * @return boolean
     */
    public function escalonDistalIzquierdo()
    {
        return $this->escalonDistalIzquierdo;
    }

    /**
     * @return boolean
     */
    public function escalonRectoDerecho()
    {
        return $this->escalonRectoDerecho;
    }

    /**
     * @return boolean
     */
    public function escalonRectoIzquierdo()
    {
        return $this->escalonRectoIzquierdo;
    }

    /**
     * @return boolean
     */
    public function mesialExageradoDerecho()
    {
        return $this->mesialExageradoDerecho;
    }

    /**
     * @return boolean
     */
    public function mesialExageradoIzquierdo()
    {
        return $this->mesialExageradoIzquierdo;
    }

    /**
     * @return boolean
     */
    public function noDeterminadoDerecho()
    {
        return $this->noDeterminadoDerecho;
    }

    /**
     * @return boolean
     */
    public function noDeterminadoIzquierdo()
    {
        return $this->noDeterminadoIzquierdo;
    }

    /**
     * @return boolean
     */
    public function relacionCaninaDerecha()
    {
        return $this->relacionCaninaDerecha;
    }

    /**
     * @return boolean
     */
    public function relacionCaninaIzquierda()
    {
        return $this->relacionCaninaIzquierda;
    }

    /**
     * @return boolean
     */
    public function relacionMolarDerechaI()
    {
        return $this->relacionMolarDerechaI;
    }

    /**
     * @return boolean
     */
    public function relacionMolarDerechaII()
    {
        return $this->relacionMolarDerechaII;
    }

    /**
     * @return boolean
     */
    public function relacionMolarDerechaIII()
    {
        return $this->relacionMolarDerechaIII;
    }

    /**
     * @return boolean
     */
    public function relacionMolarIzquierdaI()
    {
        return $this->relacionMolarIzquierdaI;
    }

    /**
     * @return boolean
     */
    public function relacionMolarIzquierdaII()
    {
        return $this->relacionMolarIzquierdaII;
    }

    /**
     * @return boolean
     */
    public function relacionMolarIzquierdaIII()
    {
        return $this->relacionMolarIzquierdaIII;
    }

    /**
     * @return boolean
     */
    public function relacionCaninaDerechaI()
    {
        return $this->relacionCaninaDerechaI;
    }

    /**
     * @return boolean
     */
    public function relacionCaninaDerechaII()
    {
        return $this->relacionCaninaDerechaII;
    }

    /**
     * @return boolean
     */
    public function relacionCaninaDerechaIII()
    {
        return $this->relacionCaninaDerechaIII;
    }

    /**
     * @return boolean
     */
    public function relacionCaninaIzquierdaI()
    {
        return $this->relacionCaninaIzquierdaI;
    }

    /**
     * @return boolean
     */
    public function relacionCaninaIzquierdaII()
    {
        return $this->relacionCaninaIzquierdaII;
    }

    /**
     * @return boolean
     */
    public function relacionCaninaIzquierdaIII()
    {
        return $this->relacionCaninaIzquierdaIII;
    }

    /**
     * @return boolean
     */
    public function tipoArcoI()
    {
        return $this->tipoArcoI;
    }

    /**
     * @return boolean
     */
    public function mordidaBordeBorde()
    {
        return $this->mordidaBordeBorde;
    }

    /**
     * @return float
     */
    public function getMedidaBordeBorde()
    {
        return $this->medidaBordeBorde;
    }

    /**
     * @return boolean
     */
    public function sobremordidaVertical()
    {
        return $this->sobremordidaVertical;
    }

    /**
     * @return float
     */
    public function getMedidaSobremordidaVertical()
    {
        return $this->medidaSobremordidaVertical;
    }

    /**
     * @return boolean
     */
    public function sobremordidaHorizontal()
    {
        return $this->sobremordidaHorizontal;
    }

    /**
     * @return float
     */
    public function getMedidaSobremordidaHorizontal()
    {
        return $this->medidaSobremordidaHorizontal;
    }

    /**
     * @return boolean
     */
    public function mordidaAbiertaAnterior()
    {
        return $this->mordidaAbiertaAnterior;
    }

    /**
     * @return float
     */
    public function getMedidaMedidaAbiertaAnterior()
    {
        return $this->medidaMedidaAbiertaAnterior;
    }

    /**
     * @return boolean
     */
    public function mordidaCruzadaAnterior()
    {
        return $this->mordidaCruzadaAnterior;
    }

    /**
     * @return float
     */
    public function getMedidaMordidaCruzadaAnterior()
    {
        return $this->medidaMordidaCruzadaAnterior;
    }

    /**
     * @return boolean
     */
    public function mordidaCruzadaPosterior()
    {
        return $this->mordidaCruzadaPosterior;
    }

    /**
     * @return float
     */
    public function getMedidaMordidaCruzadaPosterior()
    {
        return $this->medidaMordidaCruzadaPosterior;
    }

    /**
     * @return boolean
     */
    public function lineaMediaDental()
    {
        return $this->lineaMediaDental;
    }

    /**
     * @return float
     */
    public function getMedidaLineaMediaDental()
    {
        return $this->medidaLineaMediaDental;
    }

    /**
     * @return boolean
     */
    public function lineaMediaEsqueletica()
    {
        return $this->lineaMediaEsqueletica;
    }

    /**
     * @return float
     */
    public function getMedidaLineaMediaEsqueletica()
    {
        return $this->medidaLineaMediaEsqueletica;
    }

    /**
     * @return boolean
     */
    public function alteracionesTamanio()
    {
        return $this->alteracionesTamanio;
    }

    /**
     * @return float
     */
    public function getMedidaAlteracionesTamanio()
    {
        return $this->medidaAlteracionesTamanio;
    }

    /**
     * @return boolean
     */
    public function alteracionesForma()
    {
        return $this->alteracionesForma;
    }

    /**
     * @return float
     */
    public function getMedidaAlteracionesForma()
    {
        return $this->medidaAlteracionesForma;
    }

    /**
     * @return boolean
     */
    public function alteracionesNumero()
    {
        return $this->alteracionesNumero;
    }

    /**
     * @return float
     */
    public function getMedidaAlteracionesNumero()
    {
        return $this->medidaAlteracionesNumero;
    }

    /**
     * @return boolean
     */
    public function alteracionesEstructura()
    {
        return $this->alteracionesEstructura;
    }

    /**
     * @return float
     */
    public function getMedidaAlteracionesEstructura()
    {
        return $this->medidaAlteracionesEstructura;
    }

    /**
     * @return boolean
     */
    public function alteracionesTextura()
    {
        return $this->alteracionesTextura;
    }

    /**
     * @return float
     */
    public function getMedidaAlteracionesTextura()
    {
        return $this->medidaAlteracionesTextura;
    }

    /**
     * @return boolean
     */
    public function alteracionesColor()
    {
        return $this->alteracionesColor;
    }

    /**
     * @return float
     */
    public function getMedidaAlteracionesColor()
    {
        return $this->medidaAlteracionesColor;
    }

    /**
     * @return string
     */
    public function getTraumatismoBucal()
    {
        return $this->traumatismoBucal;
    }

    /**
     * @return int
     */
    public function getMarcaPasta()
    {
        return $this->marcaPasta;
    }

    /**
     * @return ComportamientoInicial
     */
    public function getComportamientoInicial()
    {
        return $this->comportamientoInicial;
    }

    /**
     * @return ComportamientoFrankl
     */
    public function getComportamientoFrankl()
    {
        return $this->comportamientoFrankl;
    }

    /**
     * @return TrastornoLenguaje
     */
    public function getTrastornoLenguaje()
    {
        return $this->trastornoLenguaje;
    }

    /**
     * @return MorfologiaCraneofacial
     */
    public function getMorfologiaCraneofacial()
    {
        return $this->morfologiaCraneofacial;
    }

    /**
     * @return MorfologiaFacial
     */
    public function getMorfologiaFacial()
    {
        return $this->morfologiaFacial;
    }

    /**
     * @return ConvexividadFacial
     */
    public function getConvexividadFacial()
    {
        return $this->convexividadFacial;
    }

    /**
     * @return ATM
     */
    public function getAtm()
    {
        return $this->atm;
    }

    /**
     * completar los datos personales
     * @param string $nombrePadre
     * @param string $ocupacionPadre
     * @param string $nombreMadre
     * @param string $ocupacionMadre
     */
    public function agregarDatosPersonales($nombrePadre, $ocupacionPadre, $nombreMadre, $ocupacionMadre)
    {
        $this->nombrePadre    = $nombrePadre;
        $this->ocupacionPadre = $ocupacionPadre;
        $this->nombreMadre    = $nombreMadre;
        $this->ocupacionMadre = $ocupacionMadre;
    }

    /**
     * completar los datos de antecedentes odontopatológicos
     * @param bool $dolorBoca
     * @param bool $sangradoEncias
     * @param bool $malOlor
     * @param bool $dienteFlojo
     */
    public function agregarAntecedentesOdontopatologicos($dolorBoca, $sangradoEncias, $malOlor, $dienteFlojo)
    {
        $this->haPresentadoDolorBoca  = $dolorBoca;
        $this->haNotadoSangradoEncias = $sangradoEncias;
        $this->presentaMalOlorBoca    = $malOlor;
        $this->sienteDienteFlojo      = $dienteFlojo;
    }

    /**
     * completar los datos de antecedentes no patológicos
     * @param bool $primeraVisita
     * @param $fechaUltimoExamen
     * @param string $motivoUltimoExamen
     * @param bool $anestesico
     * @param bool $malaReaccion
     * @param string $queReaccion
     * @param string $traumatismo
     */
    public function agregarAntecedentesNoPatologicos($primeraVisita, DateTime $fechaUltimoExamen = null, $motivoUltimoExamen, $anestesico, $malaReaccion, $queReaccion, $traumatismo)
    {
        $this->primeraVisitaDentista   = $primeraVisita;
        $this->leHanColocadoAnestesico = $anestesico;
        $this->traumatismoBucal        = $traumatismo;

        if ($this->primeraVisitaDentista) {
            $this->fechaUltimoExamenBucal = $fechaUltimoExamen;
            $this->motivoVisitaDentista   = $motivoUltimoExamen;
        }

        if ($this->leHanColocadoAnestesico) {
            $this->tuvoMalaReaccionAnestesico = $malaReaccion;

            if ($this->tuvoMalaReaccionAnestesico) {
                $this->reaccionAnestesico = $queReaccion;
            }
        }
    }

    /**
     * agregar datos de higiene bucodental
     * @param int $tipoCepillo
     * @param int $marcaPasta
     * @param int $vecesCepilla
     * @param int $edadErupcionaPrimerDiente
     * @param bool $ayudaAlCepillarse
     * @param int $vecesCome
     * @param bool $hiloDental
     * @param bool $enjuagueBucal
     * @param bool $limpiadorLingual
     * @param bool $tabletasReveladoras
     * @param bool $otroAuxiliar
     * @param string $especifiqueAuxiliar
     */
    public function agregarHigieneBucodental($tipoCepillo, $marcaPasta, $vecesCepilla, $edadErupcionaPrimerDiente, $ayudaAlCepillarse, $vecesCome, $hiloDental, $enjuagueBucal, $limpiadorLingual, $tabletasReveladoras, $otroAuxiliar, $especifiqueAuxiliar)
    {
        $this->tipoCepillo               = $tipoCepillo;
        $this->marcaPasta                = $marcaPasta;
        $this->vecesCepillaDiente        = $vecesCepilla;
        $this->edadErupcionoPrimerDiente = $edadErupcionaPrimerDiente;
        $this->alguienAyudaACepillarse   = $ayudaAlCepillarse;
        $this->vecesComeDia              = $vecesCome;
        $this->hiloDental                = $hiloDental;
        $this->enjuagueBucal             = $enjuagueBucal;
        $this->limpiadorLingual          = $limpiadorLingual;
        $this->tabletasReveladoras       = $tabletasReveladoras;
        $this->otroAuxiliar              = $otroAuxiliar;

        if ($this->otroAuxiliar) {
            $this->especifiqueAuxiliar = $especifiqueAuxiliar;
        }
    }

    /**
     * completar datos de hábitos orales
     * @param bool $succionDigital
     * @param bool $succionLingual
     * @param bool $biberon
     * @param bool $bruxismo
     * @param bool $succionLabial
     * @param bool $respiracionBucal
     * @param bool $onicofagia
     * @param bool $chupon
     * @param bool $otroHabito
     * @param string $especifiqueHabito
     */
    public function agregarHabitosOrales($succionDigital, $succionLingual, $biberon, $bruxismo, $succionLabial, $respiracionBucal, $onicofagia, $chupon, $otroHabito, $especifiqueHabito)
    {
        $this->succionDigital   = $succionDigital;
        $this->succionLingual   = $succionLingual;
        $this->biberon          = $biberon;
        $this->bruxismo         = $bruxismo;
        $this->succionLabial    = $succionLabial;
        $this->respiracionBucal = $respiracionBucal;
        $this->onicofagia       = $onicofagia;
        $this->chupon           = $chupon;
        $this->otroHabito       = $otroHabito;

        if ($this->otroHabito) {
            $this->descripcionHabito = $especifiqueHabito;
        }
    }
}