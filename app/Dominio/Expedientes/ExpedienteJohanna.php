<?php
namespace Siacme\Dominio\Expedientes;

use DateTime;
use Siacme\Dominio\Listas\IColeccion;

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
     * @var Mordida
     */
    protected $mordidaBordeBorde;

    /**
     * @var Mordida
     */
    protected $sobremordidaVertical;

    /**
     * @var Mordida
     */
    protected $sobremordidaHorizontal;

    /**
     * @var Mordida
     */
    protected $mordidaAbiertaAnterior;

    /**
     * @var Mordida
     */
    protected $mordidaCruzadaAnterior;

    /**
     * @var Mordida
     */
    protected $mordidaCruzadaPosterior;

    /**
     * @var Mordida
     */
    protected $lineaMediaDental;

    /**
     * @var Mordida
     */
    protected $lineaMediaEsqueletica;

    /**
     * @var Mordida
     */
    protected $alteracionesTamanio;

    /**
     * @var Mordida
     */
    protected $alteracionesForma;

    /**
     * @var Mordida
     */
    protected $alteracionesNumero;

    /**
     * @var Mordida
     */
    protected $alteracionesEstructura;

    /**
     * @var Mordida
     */
    protected $alteracionesTextura;

    /**
     * @var Mordida
     */
    protected $alteracionesColor;

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
     * @var ExamenExtraoral
     */
    protected $examenExtraoral;

    /**
     * @var ExamenIntraoral
     */
    protected $examenIntraoral;

    /**
     * @var DentincionTemporal
     */
    protected $dentincionTemporal;

    /**
     * @var DentincionMixtaPermanente
     */
    protected $relacionMolar;

    /**
     * @var DentincionMixtaPermanente
     */
    protected $relacionCanina;

    /**
     * @var bool
     */
    protected $tipoArcoI;

    /**
     * @var bool
     */
    protected $tipoArcoII;

    /**
     * @var IColeccion
     */
    protected $odontogramas;

    /**
     * @var IColeccion
     */
    protected $planesTratamiento;

    /**
     * @var MorfologiaCraneofacial
     */
    private $morfologiaCraneofacial;

    /**
     * @var MorfologiaFacial
     */
    private $morfologiaFacial;

    /**
     * @var ConvexividadFacial
     */
    private $convexividadFacial;

    /**
     * @var ATM
     */
    private $atm;

    /**
     * @var IColeccion
     */
    private $otrosTratamientos;

    /**
     * ExpedienteJohanna constructor.
     * @param IColeccion $odontogramas
     * @param IColeccion $planesTratamiento
     */
    public function __construct(IColeccion $odontogramas, IColeccion $planesTratamiento)
    {
        $this->odontogramas      = $odontogramas;
        $this->planesTratamiento = $planesTratamiento;
        $this->primeraVez        = true;
    }

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
     * @return bool
     */
    public function posturaRectaCaminar()
    {
        return $this->posturaRectaCaminar;
    }

    /**
     * @return bool
     */
    public function posturaRectaSentar()
    {
        return $this->posturaRectaSentar;
    }

    /**
     * @return Mordida
     */
    public function getMordidaBordeBorde()
    {
        return $this->mordidaBordeBorde;
    }

    /**
     * @return Mordida
     */
    public function getSobremordidaVertical()
    {
        return $this->sobremordidaVertical;
    }

    /**
     * @return Mordida
     */
    public function getSobremordidaHorizontal()
    {
        return $this->sobremordidaHorizontal;
    }

    /**
     * @return Mordida
     */
    public function getMordidaAbiertaAnterior()
    {
        return $this->mordidaAbiertaAnterior;
    }

    /**
     * @return Mordida
     */
    public function getMordidaCruzadaAnterior()
    {
        return $this->mordidaCruzadaAnterior;
    }

    /**
     * @return Mordida
     */
    public function getMordidaCruzadaPosterior()
    {
        return $this->mordidaCruzadaPosterior;
    }

    /**
     * @return Mordida
     */
    public function getLineaMediaDental()
    {
        return $this->lineaMediaDental;
    }

    /**
     * @return Mordida
     */
    public function getLineaMediaEsqueletica()
    {
        return $this->lineaMediaEsqueletica;
    }

    /**
     * @return Mordida
     */
    public function getAlteracionesTamanio()
    {
        return $this->alteracionesTamanio;
    }

    /**
     * @return Mordida
     */
    public function getAlteracionesForma()
    {
        return $this->alteracionesForma;
    }

    /**
     * @return Mordida
     */
    public function getAlteracionesNumero()
    {
        return $this->alteracionesNumero;
    }

    /**
     * @return Mordida
     */
    public function getAlteracionesEstructura()
    {
        return $this->alteracionesEstructura;
    }

    /**
     * @return Mordida
     */
    public function getAlteracionesTextura()
    {
        return $this->alteracionesTextura;
    }

    /**
     * @return Mordida
     */
    public function getAlteracionesColor()
    {
        return $this->alteracionesColor;
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
     * @return ExamenExtraoral
     */
    public function getExamenExtraoral()
    {
        return $this->examenExtraoral;
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

        if (!$this->primeraVisitaDentista) {
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

    /**
     * @param MorfologiaCraneofacial $morfologiaCraneofacial
     * @param MorfologiaFacial $morfologiaFacial
     * @param ConvexividadFacial $convexividadFacial
     * @param ATM $atm
     */
    public function agregarExamenExtraoral(MorfologiaCraneofacial $morfologiaCraneofacial, MorfologiaFacial $morfologiaFacial, ConvexividadFacial $convexividadFacial, ATM $atm)
    {
        $this->morfologiaCraneofacial = $morfologiaCraneofacial;
        $this->morfologiaFacial       = $morfologiaFacial;
        $this->convexividadFacial     = $convexividadFacial;
        $this->atm                    = $atm;
    }

    /**
     * @param ExamenIntraoral $examen
     */
    public function agregarExamenIntraoral(ExamenIntraoral $examen)
    {
        $this->examenIntraoral = $examen;
    }

    /**
     * agregar los tipos de arco
     * @param $arcoI
     * @param $arcoII
     */
    public function agregarArcos($arcoI, $arcoII)
    {
        $this->tipoArcoI  = $arcoI;
        $this->tipoArcoII = $arcoII;
    }

    /**
     * @return string
     */
    public function tipoArco()
    {
        $arcos = '';

        if ($this->tipoArcoI) {
            $arcos .= 'Tipo Arco I';
        }

        if ($this->tipoArcoII) {
            strlen($arcos) ? $arcos .= ' -- Tipo Arco II' : $arcos .= 'Tipo Arco II';
        }

        return $arcos;
    }

    /**
     * @return ExamenIntraoral
     */
    public function getExamenIntraoral()
    {
        return $this->examenIntraoral;
    }

    /**
     * @return DentincionTemporal
     */
    public function getDentincionTemporal()
    {
        return $this->dentincionTemporal;
    }

    /**
     * @return DentincionMixtaPermanente
     */
    public function getRelacionMolar()
    {
        return $this->relacionMolar;
    }

    /**
     * @return DentincionMixtaPermanente
     */
    public function getRelacionCanina()
    {
        return $this->relacionCanina;
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
    public function tipoArcoII()
    {
        return $this->tipoArcoII;
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
     * se agrega la dentinción temporal encontrada
     * @param DentincionTemporal $dentincionTemporal
     */
    public function agregarDentincionTemporal(DentincionTemporal $dentincionTemporal)
    {
        $this->dentincionTemporal = $dentincionTemporal;
    }

    /**
     * se agrega la dentincion mixta - permanente
     * @param DentincionMixtaPermanente $relacionMolar
     * @param DentincionMixtaPermanente $relacionCanina
     */
    public function agregarDentincionMixtaPermanente(DentincionMixtaPermanente $relacionMolar, DentincionMixtaPermanente $relacionCanina)
    {
        $this->relacionMolar  = $relacionMolar;
        $this->relacionCanina = $relacionCanina;
    }

    /**
     * agregar mordidas
     * @param Mordida $mordidaBordeBorde
     * @param Mordida $sobremordidaVertical
     * @param Mordida $sobremordidaHorizontal
     * @param Mordida $mordidaAbiertaAnterior
     * @param Mordida $mordidaCruzadaAnterior
     * @param Mordida $mordidaCruzadaPosterior
     * @param Mordida $lineaMediaDental
     * @param Mordida $lineaMediaEsqueletica
     * @param Mordida $alteracionTamanio
     * @param Mordida $alteracionForma
     * @param Mordida $alteracionNumero
     * @param Mordida $alteracionEstructura
     * @param Mordida $alteracionTextura
     * @param Mordida $alteracionColor
     */
    public function agregarMordidas(Mordida $mordidaBordeBorde, Mordida $sobremordidaVertical, Mordida $sobremordidaHorizontal, Mordida $mordidaAbiertaAnterior, Mordida $mordidaCruzadaAnterior, Mordida $mordidaCruzadaPosterior, Mordida $lineaMediaDental, Mordida $lineaMediaEsqueletica, Mordida $alteracionTamanio, Mordida $alteracionForma, Mordida $alteracionNumero, Mordida $alteracionEstructura, Mordida $alteracionTextura, Mordida $alteracionColor)
    {
        $this->mordidaBordeBorde       = $mordidaBordeBorde;
        $this->sobremordidaVertical    = $sobremordidaVertical;
        $this->sobremordidaHorizontal  = $sobremordidaHorizontal;
        $this->mordidaAbiertaAnterior  = $mordidaAbiertaAnterior;
        $this->mordidaCruzadaAnterior  = $mordidaCruzadaAnterior;
        $this->mordidaCruzadaPosterior = $mordidaCruzadaPosterior;
        $this->lineaMediaDental        = $lineaMediaDental;
        $this->lineaMediaEsqueletica   = $lineaMediaEsqueletica;
        $this->alteracionesTamanio     = $alteracionTamanio;
        $this->alteracionesForma       = $alteracionForma;
        $this->alteracionesNumero      = $alteracionNumero;
        $this->alteracionesEstructura  = $alteracionEstructura;
        $this->alteracionesTextura     = $alteracionTextura;
        $this->alteracionesColor       = $alteracionColor;
    }

    /**
     * agregar un odontograma a la lista
     * @param Odontograma $odontograma
     */
    public function agregarOdontograma(Odontograma $odontograma)
    {
        $this->odontogramas->add($odontograma);
    }

    /**
     * agregar un plan de tratamiento
     * @param PlanTratamiento $plan
     */
    public function agregarPlanTratamiento(PlanTratamiento $plan)
    {
        $this->planesTratamiento->add($plan);
    }

    /**
     * obtener al plan de tratamiento que esté marcado como activo
     * @return PlanTratamiento|null
     */
    public function obtenerOdontogramaActivo()
    {
        if ($this->odontogramas->count() === 0) {
            return null;
        }

        foreach ( $this->odontogramas as $odontograma ) {
            if (!$odontograma->atendido()) {
                return $odontograma;
            }
        }

        return null;
    }

    /**
     * devolver los odontogramas
     * @return IColeccion
     */
    public function odontogramas()
    {
        return $this->odontogramas;
    }

    /**
     * verifica si tiene odontogramas
     * @return bool
     */
    public function tieneOdontogramas()
    {
        return $this->odontogramas->count() > 0;
    }

    /**
     * una vez se genere de manera correcta la consulta, eliminar este metodo e inicializar
     * las colecciones al generar el expediente
     *
     * @param IColeccion $odontogramas
     */
    public function inicializarTemp(IColeccion $odontogramas)
    {
        $this->odontogramas = $odontogramas;
    }

    /**
     * @return IColeccion
     */
    public function getOtrosTratamientos()
    {
        return $this->otrosTratamientos;
    }

    /**
     * inicializar otros tratamientos
     * @param IColeccion $otrosTratamientos
     */
    public function inicializarOtrosTratamientos(IColeccion $otrosTratamientos)
    {
        $this->otrosTratamientos = $otrosTratamientos;
    }

    /**
     * agregar otro tratamiento
     * @param TratamientoOdontologia $tratamientoOdontologia
     */
    public function asignarOtroTratamiento(TratamientoOdontologia $tratamientoOdontologia)
    {
        $this->otrosTratamientos->add($tratamientoOdontologia);
    }

    /**
     * verifica si tiene asignados otros tratamientos
     * @return bool
     */
    public function tieneOtrosTratamientos()
    {
        return $this->otrosTratamientos->count() > 0;
    }

    /**
     * recorre los otros tratamientos y evaluda si ya estan todos atendidos o no
     * con al menos uno no atendido, retornar false
     * @return bool
     */
    public function otrosTratamientosAtendidos()
    {
        foreach ($this->otrosTratamientos as $tratamientoOdontologia) {
            if (!$tratamientoOdontologia->atendido()) {
                return false;
            }
        }

        return true;
    }

    /**
     * obtener otro tratamiento en base a su id
     * @param int $tratamientoOdontologiaId
     * @return TratamientoOdontologia
     */
    public function obtenerOtroTratamiento($tratamientoOdontologiaId)
    {
        foreach ($this->otrosTratamientos as $otroTratamiento) {
            if ($otroTratamiento->getId() === $tratamientoOdontologiaId) {
                return $otroTratamiento;
            }
        }
    }

    /**
     * obtener otro tratamiento en base a que esté activo
     * @return TratamientoOdontologia
     */
    public function obtenerOtroTratamientoActivo()
    {
        foreach ($this->otrosTratamientos as $otroTratamiento) {
            if (!$otroTratamiento->atendido()) {
                return $otroTratamiento;
            }
        }
    }

    /**
     * verifica que todos los tratamientos y odontogramas estén atendidos
     * @return bool
     */
    public function dadoDeAlta()
    {
        if ($this->tieneOdontogramas()) {
            if ($this->tieneOtrosTratamientos()) {
                return $this->otrosTratamientosAtendidos() && $this->odontogramasAtendidos();

            } else {
                return $this->odontogramasAtendidos();
            }
        } elseif ($this->tieneOtrosTratamientos()) {
            return $this->otrosTratamientosAtendidos();

        } else {
            return false;
        }
    }

    /**
     * verifica que todos los odontogramas estén atendidos
     * @return bool
     */
    public function odontogramasAtendidos()
    {
        foreach ($this->odontogramas as $odontograma) {
            if (!$odontograma->atendido()) {
                return false;
            }
        }

        return true;
    }
}