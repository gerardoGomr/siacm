<?php
namespace Siacme\Dominio\Pacientes;

use Illuminate\Support\Collection;

/**
 * Class PacienteOdontopediatria
 * @package Siacme\Dominio\Pacientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class PacienteOdontopediatria extends Paciente
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

    /**
     * PacienteOdontopediatria constructor.
     * @param int|null $id
     */
    public function __construct($id = null)
    {
        parent::__construct($id);

        if (is_null($this->listaTratamientosOdontologicos)) {
            $this->listaTratamientosOdontologicos = new Collection();
        }
    }

    /**
     * @return string
     */
    public function getNombrePadre()
    {
        return $this->nombrePadre;
    }

    /**
     * @param string $nombrePadre
     */
    public function setNombrePadre($nombrePadre)
    {
        $this->nombrePadre = $nombrePadre;
    }

    /**
     * @return string
     */
    public function getNombreMadre()
    {
        return $this->nombreMadre;
    }

    /**
     * @param string $nombreMadre
     */
    public function setNombreMadre($nombreMadre)
    {
        $this->nombreMadre = $nombreMadre;
    }

    /**
     * @return string
     */
    public function getOcupacionPadre()
    {
        return $this->ocupacionPadre;
    }

    /**
     * @param string $ocupacionPadre
     */
    public function setOcupacionPadre($ocupacionPadre)
    {
        $this->ocupacionPadre = $ocupacionPadre;
    }

    /**
     * @return string
     */
    public function getOcupacionMadre()
    {
        return $this->ocupacionMadre;
    }

    /**
     * @param string $ocupacionMadre
     */
    public function setOcupacionMadre($ocupacionMadre)
    {
        $this->ocupacionMadre = $ocupacionMadre;
    }

    /**
     * @return string
     */
    public function getNombreEdadesHermanos()
    {
        return $this->nombreEdadesHermanos;
    }

    /**
     * @param string $nombreEdadesHermanos
     */
    public function setNombreEdadesHermanos($nombreEdadesHermanos)
    {
        $this->nombreEdadesHermanos = $nombreEdadesHermanos;
    }

    /**
     * @return string
     */
    public function getFechaUltimoExamenBucal()
    {
        return $this->fechaUltimoExamenBucal;
    }

    /**
     * @param string $fechaUltimoExamenBucal
     */
    public function setFechaUltimoExamenBucal($fechaUltimoExamenBucal)
    {
        $this->fechaUltimoExamenBucal = $fechaUltimoExamenBucal;
    }

    /**
     * @return string
     */
    public function getMotivoVisitaDentista()
    {
        return $this->motivoVisitaDentista;
    }

    /**
     * @param string $motivoVisitaDentista
     */
    public function setMotivoVisitaDentista($motivoVisitaDentista)
    {
        $this->motivoVisitaDentista = $motivoVisitaDentista;
    }

    /**
     * @return string
     */
    public function getReaccionAnestesico()
    {
        return $this->reaccionAnestesico;
    }

    /**
     * @param string $reaccionAnestesico
     */
    public function setReaccionAnestesico($reaccionAnestesico)
    {
        $this->reaccionAnestesico = $reaccionAnestesico;
    }

    /**
     * @return string
     */
    public function getDescripcionHabito()
    {
        return $this->descripcionHabito;
    }

    /**
     * @param string $descripcionHabito
     */
    public function setDescripcionHabito($descripcionHabito)
    {
        $this->descripcionHabito = $descripcionHabito;
    }

    /**
     * @return string
     */
    public function getEspecifiqueAuxiliar()
    {
        return $this->especifiqueAuxiliar;
    }

    /**
     * @param string $especifiqueAuxiliar
     */
    public function setEspecifiqueAuxiliar($especifiqueAuxiliar)
    {
        $this->especifiqueAuxiliar = $especifiqueAuxiliar;
    }

    /**
     * @return string
     */
    public function getNotas()
    {
        return $this->notas;
    }

    /**
     * @param string $notas
     */
    public function setNotas($notas)
    {
        $this->notas = $notas;
    }

    /**
     * @return string
     */
    public function getLabios()
    {
        return $this->labios;
    }

    /**
     * @param string $labios
     */
    public function setLabios($labios)
    {
        $this->labios = $labios;
    }

    /**
     * @return string
     */
    public function getCarrillos()
    {
        return $this->carrillos;
    }

    /**
     * @param string $carrillos
     */
    public function setCarrillos($carrillos)
    {
        $this->carrillos = $carrillos;
    }

    /**
     * @return string
     */
    public function getFrenillos()
    {
        return $this->frenillos;
    }

    /**
     * @param string $frenillos
     */
    public function setFrenillos($frenillos)
    {
        $this->frenillos = $frenillos;
    }

    /**
     * @return string
     */
    public function getPaladar()
    {
        return $this->paladar;
    }

    /**
     * @param string $paladar
     */
    public function setPaladar($paladar)
    {
        $this->paladar = $paladar;
    }

    /**
     * @return string
     */
    public function getLengua()
    {
        return $this->lengua;
    }

    /**
     * @param string $lengua
     */
    public function setLengua($lengua)
    {
        $this->lengua = $lengua;
    }

    /**
     * @return string
     */
    public function getPisoDeBoca()
    {
        return $this->pisoDeBoca;
    }

    /**
     * @param string $pisoDeBoca
     */
    public function setPisoDeBoca($pisoDeBoca)
    {
        $this->pisoDeBoca = $pisoDeBoca;
    }

    /**
     * @return string
     */
    public function getParodonto()
    {
        return $this->parodonto;
    }

    /**
     * @param string $parodonto
     */
    public function setParodonto($parodonto)
    {
        $this->parodonto = $parodonto;
    }

    /**
     * @return string
     */
    public function getUvula()
    {
        return $this->uvula;
    }

    /**
     * @param string $uvula
     */
    public function setUvula($uvula)
    {
        $this->uvula = $uvula;
    }

    /**
     * @return string
     */
    public function getAmigdalas()
    {
        return $this->amigdalas;
    }

    /**
     * @param string $amigdalas
     */
    public function setAmigdalas($amigdalas)
    {
        $this->amigdalas = $amigdalas;
    }

    /**
     * @return string
     */
    public function getOrofaringe()
    {
        return $this->orofaringe;
    }

    /**
     * @param string $orofaringe
     */
    public function setOrofaringe($orofaringe)
    {
        $this->orofaringe = $orofaringe;
    }

    /**
     * @return int
     */
    public function getEdadErupcionoPrimerDiente()
    {
        return $this->edadErupcionoPrimerDiente;
    }

    /**
     * @param int $edadErupcionoPrimerDiente
     */
    public function setEdadErupcionoPrimerDiente($edadErupcionoPrimerDiente)
    {
        $this->edadErupcionoPrimerDiente = $edadErupcionoPrimerDiente;
    }

    /**
     * @return boolean
     */
    public function getHaPresentadoDolorBoca()
    {
        return $this->haPresentadoDolorBoca;
    }

    /**
     * @param boolean $haPresentadoDolorBoca
     */
    public function setHaPresentadoDolorBoca($haPresentadoDolorBoca)
    {
        $this->haPresentadoDolorBoca = $haPresentadoDolorBoca;
    }

    /**
     * @return boolean
     */
    public function getPresentaMalOlorBoca()
    {
        return $this->presentaMalOlorBoca;
    }

    /**
     * @param boolean $presentaMalOlorBoca
     */
    public function setPresentaMalOlorBoca($presentaMalOlorBoca)
    {
        $this->presentaMalOlorBoca = $presentaMalOlorBoca;
    }

    /**
     * @return boolean
     */
    public function getHaNotadoSangradoEncias()
    {
        return $this->haNotadoSangradoEncias;
    }

    /**
     * @param boolean $haNotadoSangradoEncias
     */
    public function setHaNotadoSangradoEncias($haNotadoSangradoEncias)
    {
        $this->haNotadoSangradoEncias = $haNotadoSangradoEncias;
    }

    /**
     * @return boolean
     */
    public function getSienteDienteFlojo()
    {
        return $this->sienteDienteFlojo;
    }

    /**
     * @param boolean $sienteDienteFlojo
     */
    public function setSienteDienteFlojo($sienteDienteFlojo)
    {
        $this->sienteDienteFlojo = $sienteDienteFlojo;
    }

    /**
     * @return boolean
     */
    public function getDisartria()
    {
        return $this->disartria;
    }

    /**
     * @param boolean $disartria
     */
    public function setDisartria($disartria)
    {
        $this->disartria = $disartria;
    }

    /**
     * @return boolean
     */
    public function getDislalia()
    {
        return $this->dislalia;
    }

    /**
     * @param boolean $dislalia
     */
    public function setDislalia($dislalia)
    {
        $this->dislalia = $dislalia;
    }

    /**
     * @return boolean
     */
    public function getAfasia()
    {
        return $this->afasia;
    }

    /**
     * @param boolean $afasia
     */
    public function setAfasia($afasia)
    {
        $this->afasia = $afasia;
    }

    /**
     * @return boolean
     */
    public function getOtroTrastorno()
    {
        return $this->otroTrastorno;
    }

    /**
     * @param boolean $otroTrastorno
     */
    public function setOtroTrastorno($otroTrastorno)
    {
        $this->otroTrastorno = $otroTrastorno;
    }

    /**
     * @return boolean
     */
    public function getNegadoTrastorno()
    {
        return $this->negadoTrastorno;
    }

    /**
     * @param boolean $negadoTrastorno
     */
    public function setNegadoTrastorno($negadoTrastorno)
    {
        $this->negadoTrastorno = $negadoTrastorno;
    }

    /**
     * @return boolean
     */
    public function getPrimeraVisitaDentista()
    {
        return $this->primeraVisitaDentista;
    }

    /**
     * @param boolean $primeraVisitaDentista
     */
    public function setPrimeraVisitaDentista($primeraVisitaDentista)
    {
        $this->primeraVisitaDentista = $primeraVisitaDentista;
    }

    /**
     * @return boolean
     */
    public function getLeHanColocadoAnestesico()
    {
        return $this->leHanColocadoAnestesico;
    }

    /**
     * @param boolean $leHanColocadoAnestesico
     */
    public function setLeHanColocadoAnestesico($leHanColocadoAnestesico)
    {
        $this->leHanColocadoAnestesico = $leHanColocadoAnestesico;
    }

    /**
     * @return boolean
     */
    public function getTuvoMalaReaccionAnestesico()
    {
        return $this->tuvoMalaReaccionAnestesico;
    }

    /**
     * @param boolean $tuvoMalaReaccionAnestesico
     */
    public function setTuvoMalaReaccionAnestesico($tuvoMalaReaccionAnestesico)
    {
        $this->tuvoMalaReaccionAnestesico = $tuvoMalaReaccionAnestesico;
    }

    /**
     * @return boolean
     */
    public function getTipoCepilloAdulto()
    {
        return $this->tipoCepilloAdulto;
    }

    /**
     * @param boolean $tipoCepilloAdulto
     */
    public function setTipoCepilloAdulto($tipoCepilloAdulto)
    {
        $this->tipoCepilloAdulto = $tipoCepilloAdulto;
    }

    /**
     * @return int
     */
    public function getVecesCepillaDiente()
    {
        return $this->vecesCepillaDiente;
    }

    /**
     * @param int $vecesCepillaDiente
     */
    public function setVecesCepillaDiente($vecesCepillaDiente)
    {
        $this->vecesCepillaDiente = $vecesCepillaDiente;
    }

    /**
     * @return boolean
     */
    public function getAlguienAyudaACepillarse()
    {
        return $this->alguienAyudaACepillarse;
    }

    /**
     * @param boolean $alguienAyudaACepillarse
     */
    public function setAlguienAyudaACepillarse($alguienAyudaACepillarse)
    {
        $this->alguienAyudaACepillarse = $alguienAyudaACepillarse;
    }

    /**
     * @return int
     */
    public function getVecesComeDia()
    {
        return $this->vecesComeDia;
    }

    /**
     * @param int $vecesComeDia
     */
    public function setVecesComeDia($vecesComeDia)
    {
        $this->vecesComeDia = $vecesComeDia;
    }

    /**
     * @return boolean
     */
    public function getHiloDental()
    {
        return $this->hiloDental;
    }

    /**
     * @param boolean $hiloDental
     */
    public function setHiloDental($hiloDental)
    {
        $this->hiloDental = $hiloDental;
    }

    /**
     * @return boolean
     */
    public function getEnjuagueBucal()
    {
        return $this->enjuagueBucal;
    }

    /**
     * @param boolean $enjuagueBucal
     */
    public function setEnjuagueBucal($enjuagueBucal)
    {
        $this->enjuagueBucal = $enjuagueBucal;
    }

    /**
     * @return boolean
     */
    public function getLimpiadorLingual()
    {
        return $this->limpiadorLingual;
    }

    /**
     * @param boolean $limpiadorLingual
     */
    public function setLimpiadorLingual($limpiadorLingual)
    {
        $this->limpiadorLingual = $limpiadorLingual;
    }

    /**
     * @return boolean
     */
    public function getTabletasReveladoras()
    {
        return $this->tabletasReveladoras;
    }

    /**
     * @param boolean $tabletasReveladoras
     */
    public function setTabletasReveladoras($tabletasReveladoras)
    {
        $this->tabletasReveladoras = $tabletasReveladoras;
    }

    /**
     * @return boolean
     */
    public function getOtroAuxiliar()
    {
        return $this->otroAuxiliar;
    }

    /**
     * @param boolean $otroAuxiliar
     */
    public function setOtroAuxiliar($otroAuxiliar)
    {
        $this->otroAuxiliar = $otroAuxiliar;
    }

    /**
     * @return boolean
     */
    public function getSuccionDigital()
    {
        return $this->succionDigital;
    }

    /**
     * @param boolean $succionDigital
     */
    public function setSuccionDigital($succionDigital)
    {
        $this->succionDigital = $succionDigital;
    }

    /**
     * @return boolean
     */
    public function getSuccionLingual()
    {
        return $this->succionLingual;
    }

    /**
     * @param boolean $succionLingual
     */
    public function setSuccionLingual($succionLingual)
    {
        $this->succionLingual = $succionLingual;
    }

    /**
     * @return boolean
     */
    public function getBiberon()
    {
        return $this->biberon;
    }

    /**
     * @param boolean $biberon
     */
    public function setBiberon($biberon)
    {
        $this->biberon = $biberon;
    }

    /**
     * @return boolean
     */
    public function getBruxismo()
    {
        return $this->bruxismo;
    }

    /**
     * @param boolean $bruxismo
     */
    public function setBruxismo($bruxismo)
    {
        $this->bruxismo = $bruxismo;
    }

    /**
     * @return boolean
     */
    public function getSuccionLabial()
    {
        return $this->succionLabial;
    }

    /**
     * @param boolean $succionLabial
     */
    public function setSuccionLabial($succionLabial)
    {
        $this->succionLabial = $succionLabial;
    }

    /**
     * @return boolean
     */
    public function getRespiracionBucal()
    {
        return $this->respiracionBucal;
    }

    /**
     * @param boolean $respiracionBucal
     */
    public function setRespiracionBucal($respiracionBucal)
    {
        $this->respiracionBucal = $respiracionBucal;
    }

    /**
     * @return boolean
     */
    public function getOnicofagia()
    {
        return $this->onicofagia;
    }

    /**
     * @param boolean $onicofagia
     */
    public function setOnicofagia($onicofagia)
    {
        $this->onicofagia = $onicofagia;
    }

    /**
     * @return boolean
     */
    public function getChupon()
    {
        return $this->chupon;
    }

    /**
     * @param boolean $chupon
     */
    public function setChupon($chupon)
    {
        $this->chupon = $chupon;
    }

    /**
     * @return boolean
     */
    public function getOtroHabito()
    {
        return $this->otroHabito;
    }

    /**
     * @param boolean $otroHabito
     */
    public function setOtroHabito($otroHabito)
    {
        $this->otroHabito = $otroHabito;
    }

    /**
     * @return boolean
     */
    public function getPosturaRectaCaminar()
    {
        return $this->posturaRectaCaminar;
    }

    /**
     * @param boolean $posturaRectaCaminar
     */
    public function setPosturaRectaCaminar($posturaRectaCaminar)
    {
        $this->posturaRectaCaminar = $posturaRectaCaminar;
    }

    /**
     * @return boolean
     */
    public function getPosturaRectaSentar()
    {
        return $this->posturaRectaSentar;
    }

    /**
     * @param boolean $posturaRectaSentar
     */
    public function setPosturaRectaSentar($posturaRectaSentar)
    {
        $this->posturaRectaSentar = $posturaRectaSentar;
    }

    /**
     * @return boolean
     */
    public function getEscalonMesialDerecho()
    {
        return $this->escalonMesialDerecho;
    }

    /**
     * @param boolean $escalonMesialDerecho
     */
    public function setEscalonMesialDerecho($escalonMesialDerecho)
    {
        $this->escalonMesialDerecho = $escalonMesialDerecho;
    }

    /**
     * @return boolean
     */
    public function getEscalonMesialIzquierdo()
    {
        return $this->escalonMesialIzquierdo;
    }

    /**
     * @param boolean $escalonMesialIzquierdo
     */
    public function setEscalonMesialIzquierdo($escalonMesialIzquierdo)
    {
        $this->escalonMesialIzquierdo = $escalonMesialIzquierdo;
    }

    /**
     * @return boolean
     */
    public function getEscalonDistalDerecho()
    {
        return $this->escalonDistalDerecho;
    }

    /**
     * @param boolean $escalonDistalDerecho
     */
    public function setEscalonDistalDerecho($escalonDistalDerecho)
    {
        $this->escalonDistalDerecho = $escalonDistalDerecho;
    }

    /**
     * @return boolean
     */
    public function getEscalonDistalIzquierdo()
    {
        return $this->escalonDistalIzquierdo;
    }

    /**
     * @param boolean $escalonDistalIzquierdo
     */
    public function setEscalonDistalIzquierdo($escalonDistalIzquierdo)
    {
        $this->escalonDistalIzquierdo = $escalonDistalIzquierdo;
    }

    /**
     * @return boolean
     */
    public function getEscalonRectoDerecho()
    {
        return $this->escalonRectoDerecho;
    }

    /**
     * @param boolean $escalonRectoDerecho
     */
    public function setEscalonRectoDerecho($escalonRectoDerecho)
    {
        $this->escalonRectoDerecho = $escalonRectoDerecho;
    }

    /**
     * @return boolean
     */
    public function getEscalonRectoIzquierdo()
    {
        return $this->escalonRectoIzquierdo;
    }

    /**
     * @param boolean $escalonRectoIzquierdo
     */
    public function setEscalonRectoIzquierdo($escalonRectoIzquierdo)
    {
        $this->escalonRectoIzquierdo = $escalonRectoIzquierdo;
    }

    /**
     * @return boolean
     */
    public function getMesialExageradoDerecho()
    {
        return $this->mesialExageradoDerecho;
    }

    /**
     * @param boolean $mesialExageradoDerecho
     */
    public function setMesialExageradoDerecho($mesialExageradoDerecho)
    {
        $this->mesialExageradoDerecho = $mesialExageradoDerecho;
    }

    /**
     * @return boolean
     */
    public function getMesialExageradoIzquierdo()
    {
        return $this->mesialExageradoIzquierdo;
    }

    /**
     * @param boolean $mesialExageradoIzquierdo
     */
    public function setMesialExageradoIzquierdo($mesialExageradoIzquierdo)
    {
        $this->mesialExageradoIzquierdo = $mesialExageradoIzquierdo;
    }

    /**
     * @return boolean
     */
    public function getNoDeterminadoDerecho()
    {
        return $this->noDeterminadoDerecho;
    }

    /**
     * @param boolean $noDeterminadoDerecho
     */
    public function setNoDeterminadoDerecho($noDeterminadoDerecho)
    {
        $this->noDeterminadoDerecho = $noDeterminadoDerecho;
    }

    /**
     * @return boolean
     */
    public function getNoDeterminadoIzquierdo()
    {
        return $this->noDeterminadoIzquierdo;
    }

    /**
     * @param boolean $noDeterminadoIzquierdo
     */
    public function setNoDeterminadoIzquierdo($noDeterminadoIzquierdo)
    {
        $this->noDeterminadoIzquierdo = $noDeterminadoIzquierdo;
    }

    /**
     * @return boolean
     */
    public function getRelacionCaninaDerecha()
    {
        return $this->relacionCaninaDerecha;
    }

    /**
     * @param boolean $relacionCaninaDerecha
     */
    public function setRelacionCaninaDerecha($relacionCaninaDerecha)
    {
        $this->relacionCaninaDerecha = $relacionCaninaDerecha;
    }

    /**
     * @return boolean
     */
    public function getRelacionCaninaIzquierda()
    {
        return $this->relacionCaninaIzquierda;
    }

    /**
     * @param boolean $relacionCaninaIzquierda
     */
    public function setRelacionCaninaIzquierda($relacionCaninaIzquierda)
    {
        $this->relacionCaninaIzquierda = $relacionCaninaIzquierda;
    }

    /**
     * @return boolean
     */
    public function getRelacionMolarDerechaI()
    {
        return $this->relacionMolarDerechaI;
    }

    /**
     * @param boolean $relacionMolarDerechaI
     */
    public function setRelacionMolarDerechaI($relacionMolarDerechaI)
    {
        $this->relacionMolarDerechaI = $relacionMolarDerechaI;
    }

    /**
     * @return boolean
     */
    public function getRelacionMolarDerechaII()
    {
        return $this->relacionMolarDerechaII;
    }

    /**
     * @param boolean $relacionMolarDerechaII
     */
    public function setRelacionMolarDerechaII($relacionMolarDerechaII)
    {
        $this->relacionMolarDerechaII = $relacionMolarDerechaII;
    }

    /**
     * @return boolean
     */
    public function getRelacionMolarDerechaIII()
    {
        return $this->relacionMolarDerechaIII;
    }

    /**
     * @param boolean $relacionMolarDerechaIII
     */
    public function setRelacionMolarDerechaIII($relacionMolarDerechaIII)
    {
        $this->relacionMolarDerechaIII = $relacionMolarDerechaIII;
    }

    /**
     * @return boolean
     */
    public function getRelacionMolarIzquierdaI()
    {
        return $this->relacionMolarIzquierdaI;
    }

    /**
     * @param boolean $relacionMolarIzquierdaI
     */
    public function setRelacionMolarIzquierdaI($relacionMolarIzquierdaI)
    {
        $this->relacionMolarIzquierdaI = $relacionMolarIzquierdaI;
    }

    /**
     * @return boolean
     */
    public function getRelacionMolarIzquierdaII()
    {
        return $this->relacionMolarIzquierdaII;
    }

    /**
     * @param boolean $relacionMolarIzquierdaII
     */
    public function setRelacionMolarIzquierdaII($relacionMolarIzquierdaII)
    {
        $this->relacionMolarIzquierdaII = $relacionMolarIzquierdaII;
    }

    /**
     * @return boolean
     */
    public function getRelacionMolarIzquierdaIII()
    {
        return $this->relacionMolarIzquierdaIII;
    }

    /**
     * @param boolean $relacionMolarIzquierdaIII
     */
    public function setRelacionMolarIzquierdaIII($relacionMolarIzquierdaIII)
    {
        $this->relacionMolarIzquierdaIII = $relacionMolarIzquierdaIII;
    }

    /**
     * @return boolean
     */
    public function getRelacionCaninaDerechaI()
    {
        return $this->relacionCaninaDerechaI;
    }

    /**
     * @param boolean $relacionCaninaDerechaI
     */
    public function setRelacionCaninaDerechaI($relacionCaninaDerechaI)
    {
        $this->relacionCaninaDerechaI = $relacionCaninaDerechaI;
    }

    /**
     * @return boolean
     */
    public function getRelacionCaninaDerechaII()
    {
        return $this->relacionCaninaDerechaII;
    }

    /**
     * @param boolean $relacionCaninaDerechaII
     */
    public function setRelacionCaninaDerechaII($relacionCaninaDerechaII)
    {
        $this->relacionCaninaDerechaII = $relacionCaninaDerechaII;
    }

    /**
     * @return boolean
     */
    public function getRelacionCaninaDerechaIII()
    {
        return $this->relacionCaninaDerechaIII;
    }

    /**
     * @param boolean $relacionCaninaDerechaIII
     */
    public function setRelacionCaninaDerechaIII($relacionCaninaDerechaIII)
    {
        $this->relacionCaninaDerechaIII = $relacionCaninaDerechaIII;
    }

    /**
     * @return boolean
     */
    public function getRelacionCaninaIzquierdaI()
    {
        return $this->relacionCaninaIzquierdaI;
    }

    /**
     * @param boolean $relacionCaninaIzquierdaI
     */
    public function setRelacionCaninaIzquierdaI($relacionCaninaIzquierdaI)
    {
        $this->relacionCaninaIzquierdaI = $relacionCaninaIzquierdaI;
    }

    /**
     * @return boolean
     */
    public function getRelacionCaninaIzquierdaII()
    {
        return $this->relacionCaninaIzquierdaII;
    }

    /**
     * @param boolean $relacionCaninaIzquierdaII
     */
    public function setRelacionCaninaIzquierdaII($relacionCaninaIzquierdaII)
    {
        $this->relacionCaninaIzquierdaII = $relacionCaninaIzquierdaII;
    }

    /**
     * @return boolean
     */
    public function getRelacionCaninaIzquierdaIII()
    {
        return $this->relacionCaninaIzquierdaIII;
    }

    /**
     * @param boolean $relacionCaninaIzquierdaIII
     */
    public function setRelacionCaninaIzquierdaIII($relacionCaninaIzquierdaIII)
    {
        $this->relacionCaninaIzquierdaIII = $relacionCaninaIzquierdaIII;
    }

    /**
     * @return boolean
     */
    public function getTipoArcoI()
    {
        return $this->tipoArcoI;
    }

    /**
     * @param boolean $tipoArcoI
     */
    public function setTipoArcoI($tipoArcoI)
    {
        $this->tipoArcoI = $tipoArcoI;
    }

    /**
     * @return boolean
     */
    public function getMordidaBordeBorde()
    {
        return $this->mordidaBordeBorde;
    }

    /**
     * @param boolean $mordidaBordeBorde
     */
    public function setMordidaBordeBorde($mordidaBordeBorde)
    {
        $this->mordidaBordeBorde = $mordidaBordeBorde;
    }

    /**
     * @return float
     */
    public function getMedidaBordeBorde()
    {
        return $this->medidaBordeBorde;
    }

    /**
     * @param float $medidaBordeBorde
     */
    public function setMedidaBordeBorde($medidaBordeBorde)
    {
        $this->medidaBordeBorde = $medidaBordeBorde;
    }

    /**
     * @return boolean
     */
    public function getSobremordidaVertical()
    {
        return $this->sobremordidaVertical;
    }

    /**
     * @param boolean $sobremordidaVertical
     */
    public function setSobremordidaVertical($sobremordidaVertical)
    {
        $this->sobremordidaVertical = $sobremordidaVertical;
    }

    /**
     * @return float
     */
    public function getMedidaSobremordidaVertical()
    {
        return $this->medidaSobremordidaVertical;
    }

    /**
     * @param float $medidaSobremordidaVertical
     */
    public function setMedidaSobremordidaVertical($medidaSobremordidaVertical)
    {
        $this->medidaSobremordidaVertical = $medidaSobremordidaVertical;
    }

    /**
     * @return boolean
     */
    public function getSobremordidaHorizontal()
    {
        return $this->sobremordidaHorizontal;
    }

    /**
     * @param boolean $sobremordidaHorizontal
     */
    public function setSobremordidaHorizontal($sobremordidaHorizontal)
    {
        $this->sobremordidaHorizontal = $sobremordidaHorizontal;
    }

    /**
     * @return float
     */
    public function getMedidaSobremordidaHorizontal()
    {
        return $this->medidaSobremordidaHorizontal;
    }

    /**
     * @param float $medidaSobremordidaHorizontal
     */
    public function setMedidaSobremordidaHorizontal($medidaSobremordidaHorizontal)
    {
        $this->medidaSobremordidaHorizontal = $medidaSobremordidaHorizontal;
    }

    /**
     * @return boolean
     */
    public function getMordidaAbiertaAnterior()
    {
        return $this->mordidaAbiertaAnterior;
    }

    /**
     * @param boolean $mordidaAbiertaAnterior
     */
    public function setMordidaAbiertaAnterior($mordidaAbiertaAnterior)
    {
        $this->mordidaAbiertaAnterior = $mordidaAbiertaAnterior;
    }

    /**
     * @return float
     */
    public function getMedidaMordidaAbiertaAnterior()
    {
        return $this->medidaMedidaAbiertaAnterior;
    }

    /**
     * @param float $medidaMedidaAbiertaAnterior
     */
    public function setMedidaMordidaAbiertaAnterior($medidaMedidaAbiertaAnterior)
    {
        $this->medidaMedidaAbiertaAnterior = $medidaMedidaAbiertaAnterior;
    }

    /**
     * @return boolean
     */
    public function getMordidaCruzadaAnterior()
    {
        return $this->mordidaCruzadaAnterior;
    }

    /**
     * @param boolean $mordidaCruzadaAnterior
     */
    public function setMordidaCruzadaAnterior($mordidaCruzadaAnterior)
    {
        $this->mordidaCruzadaAnterior = $mordidaCruzadaAnterior;
    }

    /**
     * @return float
     */
    public function getMedidaMordidaCruzadaAnterior()
    {
        return $this->medidaMordidaCruzadaAnterior;
    }

    /**
     * @param float $medidaMordidaCruzadaAnterior
     */
    public function setMedidaMordidaCruzadaAnterior($medidaMordidaCruzadaAnterior)
    {
        $this->medidaMordidaCruzadaAnterior = $medidaMordidaCruzadaAnterior;
    }

    /**
     * @return boolean
     */
    public function getMordidaCruzadaPosterior()
    {
        return $this->mordidaCruzadaPosterior;
    }

    /**
     * @param boolean $mordidaCruzadaPosterior
     */
    public function setMordidaCruzadaPosterior($mordidaCruzadaPosterior)
    {
        $this->mordidaCruzadaPosterior = $mordidaCruzadaPosterior;
    }

    /**
     * @return float
     */
    public function getMedidaMordidaCruzadaPosterior()
    {
        return $this->medidaMordidaCruzadaPosterior;
    }

    /**
     * @param float $medidaMordidaCruzadaPosterior
     */
    public function setMedidaMordidaCruzadaPosterior($medidaMordidaCruzadaPosterior)
    {
        $this->medidaMordidaCruzadaPosterior = $medidaMordidaCruzadaPosterior;
    }

    /**
     * @return boolean
     */
    public function getLineaMediaDental()
    {
        return $this->lineaMediaDental;
    }

    /**
     * @param boolean $lineaMediaDental
     */
    public function setLineaMediaDental($lineaMediaDental)
    {
        $this->lineaMediaDental = $lineaMediaDental;
    }

    /**
     * @return float
     */
    public function getMedidaLineaMediaDental()
    {
        return $this->medidaLineaMediaDental;
    }

    /**
     * @param float $medidaLineaMediaDental
     */
    public function setMedidaLineaMediaDental($medidaLineaMediaDental)
    {
        $this->medidaLineaMediaDental = $medidaLineaMediaDental;
    }

    /**
     * @return boolean
     */
    public function getLineaMediaEsqueletica()
    {
        return $this->lineaMediaEsqueletica;
    }

    /**
     * @param boolean $lineaMediaEsqueletica
     */
    public function setLineaMediaEsqueletica($lineaMediaEsqueletica)
    {
        $this->lineaMediaEsqueletica = $lineaMediaEsqueletica;
    }

    /**
     * @return float
     */
    public function getMedidaLineaMediaEsqueletica()
    {
        return $this->medidaLineaMediaEsqueletica;
    }

    /**
     * @param float $medidaLineaMediaEsqueletica
     */
    public function setMedidaLineaMediaEsqueletica($medidaLineaMediaEsqueletica)
    {
        $this->medidaLineaMediaEsqueletica = $medidaLineaMediaEsqueletica;
    }

    /**
     * @return boolean
     */
    public function getAlteracionesTamanio()
    {
        return $this->alteracionesTamanio;
    }

    /**
     * @param boolean $alteracionTamanio
     */
    public function setAlteracionesTamanio($alteracionTamanio)
    {
        $this->alteracionesTamanio = $alteracionTamanio;
    }

    /**
     * @return float
     */
    public function getMedidaAlteracionesTamanio()
    {
        return $this->medidaAlteracionesTamanio;
    }

    /**
     * @param float $medidaAlteracionTamanio
     */
    public function setMedidaAlteracionesTamanio($medidaAlteracionTamanio)
    {
        $this->medidaAlteracionesTamanio = $medidaAlteracionTamanio;
    }

    /**
     * @return boolean
     */
    public function getAlteracionesForma()
    {
        return $this->alteracionesForma;
    }

    /**
     * @param boolean $alteracionForma
     */
    public function setAlteracionesForma($alteracionForma)
    {
        $this->alteracionesForma = $alteracionForma;
    }

    /**
     * @return float
     */
    public function getMedidaAlteracionesForma()
    {
        return $this->medidaAlteracionesForma;
    }

    /**
     * @param float $medidaAlteracionForma
     */
    public function setMedidaAlteracionesForma($medidaAlteracionForma)
    {
        $this->medidaAlteracionesForma = $medidaAlteracionForma;
    }

    /**
     * @return boolean
     */
    public function getAlteracionesNumero()
    {
        return $this->alteracionesNumero;
    }

    /**
     * @param boolean $alteracionNumero
     */
    public function setAlteracionesNumero($alteracionNumero)
    {
        $this->alteracionesNumero = $alteracionNumero;
    }

    /**
     * @return float
     */
    public function getMedidaAlteracionesNumero()
    {
        return $this->medidaAlteracionesNumero;
    }

    /**
     * @param float $medidaAlteracionNumero
     */
    public function setMedidaAlteracionesNumero($medidaAlteracionNumero)
    {
        $this->medidaAlteracionesNumero = $medidaAlteracionNumero;
    }

    /**
     * @return boolean
     */
    public function getAlteracionesEstructura()
    {
        return $this->alteracionesEstructura;
    }

    /**
     * @param boolean $alteracionEstructura
     */
    public function setAlteracionesEstructura($alteracionEstructura)
    {
        $this->alteracionesEstructura = $alteracionEstructura;
    }

    /**
     * @return float
     */
    public function getMedidaAlteracionesEstructura()
    {
        return $this->medidaAlteracionesEstructura;
    }

    /**
     * @param float $medidaAlteracionEstructura
     */
    public function setMedidaAlteracionesEstructura($medidaAlteracionEstructura)
    {
        $this->medidaAlteracionesEstructura = $medidaAlteracionEstructura;
    }

    /**
     * @return boolean
     */
    public function getAlteracionesTextura()
    {
        return $this->alteracionesTextura;
    }

    /**
     * @param boolean $alteracionTextura
     */
    public function setAlteracionesTextura($alteracionTextura)
    {
        $this->alteracionesTextura = $alteracionTextura;
    }

    /**
     * @return float
     */
    public function getMedidaAlteracionesTextura()
    {
        return $this->medidaAlteracionesTextura;
    }

    /**
     * @param float $medidaAlteracionTextura
     */
    public function setMedidaAlteracionesTextura($medidaAlteracionTextura)
    {
        $this->medidaAlteracionesTextura = $medidaAlteracionTextura;
    }

    /**
     * @return boolean
     */
    public function getAlteracionesColor()
    {
        return $this->alteracionesColor;
    }

    /**
     * @param boolean $alteracionColor
     */
    public function setAlteracionesColor($alteracionColor)
    {
        $this->alteracionesColor = $alteracionColor;
    }

    /**
     * @return float
     */
    public function getMedidaAlteracionesColor()
    {
        return $this->medidaAlteracionesColor;
    }

    /**
     * @param float $medidaAlteracionColor
     */
    public function setMedidaAlteracionesColor($medidaAlteracionColor)
    {
        $this->medidaAlteracionesColor = $medidaAlteracionColor;
    }

    /**
     * @return mixed
     */
    public function getTraumatismoBucal()
    {
        return $this->traumatismoBucal;
    }

    /**
     * @param mixed $traumatismoBucal
     */
    public function setTraumatismoBucal($traumatismoBucal)
    {
        $this->traumatismoBucal = $traumatismoBucal;
    }

    /**
     * @return MarcaPasta
     */
    public function getMarcaPasta()
    {
        return $this->marcaPasta;
    }

    /**
     * @param MarcaPasta $marcaPasta
     */
    public function setMarcaPasta(MarcaPasta $marcaPasta)
    {
        $this->marcaPasta = $marcaPasta;
    }

    /**
     * @return ComportamientoInicial
     */
    public function getComportamientoInicial()
    {
        return $this->comportamientoInicial;
    }

    /**
     * @param ComportamientoInicial $comportamientoInicial
     */
    public function setComportamientoInicial(ComportamientoInicial $comportamientoInicial)
    {
        $this->comportamientoInicial = $comportamientoInicial;
    }

    /**
     * @return ComportamientoFrankl
     */
    public function getComportamientoFrankl()
    {
        return $this->comportamientoFrankl;
    }

    /**
     * @param ComportamientoFrankl $comportamientoFrankl
     */
    public function setComportamientoFrankl(ComportamientoFrankl $comportamientoFrankl)
    {
        $this->comportamientoFrankl = $comportamientoFrankl;
    }

    /**
     * @return TrastornoLenguaje
     */
    public function getTrastornoLenguaje()
    {
        return $this->trastornoLenguaje;
    }

    /**
     * @param TrastornoLenguaje $trastornoLenguaje
     */
    public function setTrastornoLenguaje(TrastornoLenguaje $trastornoLenguaje)
    {
        $this->trastornoLenguaje = $trastornoLenguaje;
    }

    /**
     * @return MorfologiaCraneofacial
     */
    public function getMorfologiaCraneofacial()
    {
        return $this->morfologiaCraneofacial;
    }

    /**
     * @param MorfologiaCraneofacial $morfologiaCraneofacial
     */
    public function setMorfologiaCraneofacial(MorfologiaCraneofacial $morfologiaCraneofacial)
    {
        $this->morfologiaCraneofacial = $morfologiaCraneofacial;
    }

    /**
     * @return MorfologiaFacial
     */
    public function getMorfologiaFacial()
    {
        return $this->morfologiaFacial;
    }

    /**
     * @param MorfologiaFacial $morfologiaFacial
     */
    public function setMorfologiaFacial(MorfologiaFacial $morfologiaFacial)
    {
        $this->morfologiaFacial = $morfologiaFacial;
    }

    /**
     * @return ConvexividadFacial
     */
    public function getConvexividadFacial()
    {
        return $this->convexividadFacial;
    }

    /**
     * @param ConvexividadFacial $convexividadFacial
     */
    public function setConvexividadFacial(ConvexividadFacial $convexividadFacial)
    {
        $this->convexividadFacial = $convexividadFacial;
    }

    /**
     * @return ATM
     */
    public function getAtm()
    {
        return $this->atm;
    }

    /**
     * @param ATM $atm
     */
    public function setAtm(ATM $atm)
    {
        $this->atm = $atm;
    }

    /**
     * comprobar que el trastorno especificado es el mismo que está asignado
     * @param  TrastornoLenguaje $trastorno
     * @return bool
     */
    public function compruebaTrastorno(TrastornoLenguaje $trastorno)
    {
        if($this->trastornoLenguaje->getId() === $trastorno->getId()) {
            return true;
        }

        return false;
    }

    /**
     * comprobar que la marca de pasta especificada es la misma que la asignada al expediente
     * @param  MarcaPasta $marcaPasta
     * @return bool
     */
    public function compruebaMarcaPasta(MarcaPasta $marcaPasta)
    {
        if($this->marcaPasta->getId() === $marcaPasta->getId()) {
            return true;
        }

        return false;
    }
}