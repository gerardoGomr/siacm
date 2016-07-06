<?php
namespace Siacme\Dominio\Pacientes;

use Siacme\Dominio\Personas\Persona;

/**
 * Class Paciente
 * @package Siacme\Dominio\Pacientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class Paciente extends Persona
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var Fotografia
     */
    protected $fotografia;

    /**
     * @var int
     */
    protected $edadAnios;

    /**
     * @var int
     */
    protected $edadMeses;

    /**
     * @var bool
     */
    protected $seHaAutomedicado;

    /**
     * @var bool
     */
    protected $esAlergico;

    /**
     * @var bool
     */
    protected $viveMadre;

    /**
     * @var bool
     */
    protected $vivePadre;

    /**
     * @var int
     */
    protected $numHermanos;

    /**
     * @var int
     */
    protected $numHermanosVivos;

    /**
     * @var int
     */
    protected $numHermanosFinados;

    /**
     * @var bool
     */
    protected $seLeHacenMoretones;

    /**
     * @var bool
     */
    protected $haRequeridoTransfusion;

    /**
     * @var bool
     */
    protected $haTenidoFracturas;

    /**
     * @var bool
     */
    protected $haSidoIntervenido;

    /**
     * @var bool
     */
    protected $haSidoHospitalizado;

    /**
     * @var bool
     */
    protected $exFumador;

    /**
     * @var bool
     */
    protected $exAlcoholico;

    /**
     * @var bool
     */
    protected $exAdicto;

    /**
     * @var bool
     */
    protected $estaBajoTratamiento;

    /**
     * @var string
     */
    protected $direccion;

    /**
     * @var string
     */
    protected $cp;

    /**
     * @var string
     */
    protected $municipio;

    /**
     * @var string
     */
    protected $lugarNacimiento;

    /**
     * @var string
     */
    protected $nombrePediatra;

    /**
     * @var string
     */
    protected $nombreRecomienda;

    /**
     * @var string
     */
    protected $conQueSeHaAutomedicado;

    /**
     * @var string
     */
    protected $aQueMedicamentoEsAlergico;

    /**
     * @var string
     */
    protected $causaMuerteMadre;

    /**
     * @var string
     */
    protected $enfermedadesMadre;

    /**
     * @var string
     */
    protected $causaMuertePadre;

    /**
     * @var string
     */
    protected $enfermedadesPadre;

    /**
     * @var string
     */
    protected $causaMuerteHermanos;

    /**
     * @var string
     */
    protected $enfermedadesHermanos;

    /**
     * @var string
     */
    protected $enfermedadesAbuelosPaternos;

    /**
     * @var string
     */
    protected $enfermedadesAbuelosMaternos;

    /**
     * @var string
     */
    protected $especifiqueFracturas;

    /**
     * @var string
     */
    protected $especifiqueIntervencion;

    /**
     * @var string
     */
    protected $especifiqueHospitalizacion;

    /**
     * @var string
     */
    protected $especifiqueTratamiento;

    /**
     * @var string
     */
    protected $nombreRepresentante;

    /**
     * @var string
     */
    protected $nombreTutor;

    /**
     * @var string
     */
    protected $ocupacionTutor;

    /**
     * @var string
     */
    protected $motivoConsulta;

    /**
     * @var string
     */
    protected $historiaEnfermedad;

    /**
     * @var string
     */
    protected $padecimientoActual;

    /**
     * @var string
     */
    protected $interrogatorioPorAparatos;

    /**
     * @var string
     */
    protected $resultadosLaboratorio;

    /**
     * @var string
     */
    protected $terapeuticaEmpleada;

    /**
     * @var string
     */
    protected $fechaCreacion;

    /**
     * @var string
     */
    protected $fechaNacimiento;

    /**
     * @var EstadoCivil
     */
    protected $estadoCivil;

    /**
     * @var Religion
     */
    protected $religion;

    /**
     * @var Escolaridad
     */
    protected $escolaridad;

    /**
     * @var Collection
     */
    protected $listaPadecimientos;

    /**
     * @var InstitucionMedica
     */
    protected $institucionMedica;

    /**
     * @var double
     */
    protected $peso;

    /**
     * @var double
     */
    protected $talla;

    /**
     * @var double
     */
    protected $pulso;

    /**
     * @var double
     */
    protected $temperatura;

    /**
     * @var double
     */
    protected $tensionArterial;

    /**
     * @var bool
     */
    protected $nuevoPaciente;

    /**
     * Paciente constructor.
     * @param int $id
     */
    public function __construct($id = null)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return Fotografia
     */
    public function getFotografia()
    {
        return $this->fotografia;
    }

    /**
     * @param Fotografia $fotografia
     */
    public function setFotografia($fotografia)
    {
        $this->fotografia = $fotografia;
    }

    /**
     * @return int
     */
    public function getEdadAnios()
    {
        return $this->edadAnios;
    }

    /**
     * @param int $edadAnios
     */
    public function setEdadAnios($edadAnios)
    {
        $this->edadAnios = $edadAnios;
    }

    /**
     * @return int
     */
    public function getEdadMeses()
    {
        return $this->edadMeses;
    }

    /**
     * @param int $edadMeses
     */
    public function setEdadMeses($edadMeses)
    {
        $this->edadMeses = $edadMeses;
    }

    /**
     * @return boolean
     */
    public function getSeHaAutomedicado()
    {
        return $this->seHaAutomedicado;
    }

    /**
     * @param boolean $seHaAutomedicado
     */
    public function setSeHaAutomedicado($seHaAutomedicado)
    {
        $this->seHaAutomedicado = $seHaAutomedicado;
    }

    /**
     * @return boolean
     */
    public function getEsAlergico()
    {
        return $this->esAlergico;
    }

    /**
     * @param boolean $esAlergico
     */
    public function setEsAlergico($esAlergico)
    {
        $this->esAlergico = $esAlergico;
    }

    /**
     * @return boolean
     */
    public function getViveMadre()
    {
        return $this->viveMadre;
    }

    /**
     * @param boolean $viveMadre
     */
    public function setViveMadre($viveMadre)
    {
        $this->viveMadre = $viveMadre;
    }

    /**
     * @return boolean
     */
    public function getVivePadre()
    {
        return $this->vivePadre;
    }

    /**
     * @param boolean $vivePadre
     */
    public function setVivePadre($vivePadre)
    {
        $this->vivePadre = $vivePadre;
    }

    /**
     * @return int
     */
    public function getNumHermanos()
    {
        return $this->numHermanos;
    }

    /**
     * @param int $numHermanos
     */
    public function setNumHermanos($numHermanos)
    {
        $this->numHermanos = $numHermanos;
    }

    /**
     * @return int
     */
    public function getNumHermanosVivos()
    {
        return $this->numHermanosVivos;
    }

    /**
     * @param int $numHermanosVivos
     */
    public function setNumHermanosVivos($numHermanosVivos)
    {
        $this->numHermanosVivos = $numHermanosVivos;
    }

    /**
     * @return int
     */
    public function getNumHermanosFinados()
    {
        return $this->numHermanosFinados;
    }

    /**
     * @param int $numHermanosFinados
     */
    public function setNumHermanosFinados($numHermanosFinados)
    {
        $this->numHermanosFinados = $numHermanosFinados;
    }

    /**
     * @return boolean
     */
    public function getSeLeHacenMoretones()
    {
        return $this->seLeHacenMoretones;
    }

    /**
     * @param boolean $seLeHacenMoretones
     */
    public function setSeLeHacenMoretones($seLeHacenMoretones)
    {
        $this->seLeHacenMoretones = $seLeHacenMoretones;
    }

    /**
     * @return boolean
     */
    public function getHaRequeridoTransfusion()
    {
        return $this->haRequeridoTransfusion;
    }

    /**
     * @param boolean $haRequeridoTransfusion
     */
    public function setHaRequeridoTransfusion($haRequeridoTransfusion)
    {
        $this->haRequeridoTransfusion = $haRequeridoTransfusion;
    }

    /**
     * @return boolean
     */
    public function getHaTenidoFracturas()
    {
        return $this->haTenidoFracturas;
    }

    /**
     * @param boolean $haTenidoFracturas
     */
    public function setHaTenidoFracturas($haTenidoFracturas)
    {
        $this->haTenidoFracturas = $haTenidoFracturas;
    }

    /**
     * @return boolean
     */
    public function getHaSidoIntervenido()
    {
        return $this->haSidoIntervenido;
    }

    /**
     * @param boolean $haSidoIntervenido
     */
    public function setHaSidoIntervenido($haSidoIntervenido)
    {
        $this->haSidoIntervenido = $haSidoIntervenido;
    }

    /**
     * @return boolean
     */
    public function getHaSidoHospitalizado()
    {
        return $this->haSidoHospitalizado;
    }

    /**
     * @param boolean $haSidoHospitalizado
     */
    public function setHaSidoHospitalizado($haSidoHospitalizado)
    {
        $this->haSidoHospitalizado = $haSidoHospitalizado;
    }

    /**
     * @return boolean
     */
    public function getExFumador()
    {
        return $this->exFumador;
    }

    /**
     * @param boolean $exFumador
     */
    public function setExFumador($exFumador)
    {
        $this->exFumador = $exFumador;
    }

    /**
     * @return boolean
     */
    public function getExAlcoholico()
    {
        return $this->exAlcoholico;
    }

    /**
     * @param boolean $exAlcoholico
     */
    public function setExAlcoholico($exAlcoholico)
    {
        $this->exAlcoholico = $exAlcoholico;
    }

    /**
     * @return boolean
     */
    public function getExAdicto()
    {
        return $this->exAdicto;
    }

    /**
     * @param boolean $exAdicto
     */
    public function setExAdicto($exAdicto)
    {
        $this->exAdicto = $exAdicto;
    }

    /**
     * @return boolean
     */
    public function getEstaBajoTratamiento()
    {
        return $this->estaBajoTratamiento;
    }

    /**
     * @param boolean $estaBajoTratamiento
     */
    public function setEstaBajoTratamiento($estaBajoTratamiento)
    {
        $this->estaBajoTratamiento = $estaBajoTratamiento;
    }

    /**
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param string $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * @return string
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * @param string $cp
     */
    public function setCp($cp)
    {
        $this->cp = $cp;
    }

    /**
     * @return string
     */
    public function getMunicipio()
    {
        return $this->municipio;
    }

    /**
     * @param string $municipio
     */
    public function setMunicipio($municipio)
    {
        $this->municipio = $municipio;
    }

    /**
     * @return string
     */
    public function getLugarNacimiento()
    {
        return $this->lugarNacimiento;
    }

    /**
     * @param string $lugarNacimiento
     */
    public function setLugarNacimiento($lugarNacimiento)
    {
        $this->lugarNacimiento = $lugarNacimiento;
    }

    /**
     * @return string
     */
    public function getNombrePediatra()
    {
        return $this->nombrePediatra;
    }

    /**
     * @param string $nombrePediatra
     */
    public function setNombrePediatra($nombrePediatra)
    {
        $this->nombrePediatra = $nombrePediatra;
    }

    /**
     * @return string
     */
    public function getNombreRecomienda()
    {
        return $this->nombreRecomienda;
    }

    /**
     * @param string $nombreRecomienda
     */
    public function setNombreRecomienda($nombreRecomienda)
    {
        $this->nombreRecomienda = $nombreRecomienda;
    }

    /**
     * @return string
     */
    public function getConQueSeHaAutomedicado()
    {
        return $this->conQueSeHaAutomedicado;
    }

    /**
     * @param string $conQueSeHaAutomedicado
     */
    public function setConQueSeHaAutomedicado($conQueSeHaAutomedicado)
    {
        $this->conQueSeHaAutomedicado = $conQueSeHaAutomedicado;
    }

    /**
     * @return string
     */
    public function getAQueMedicamentoEsAlergico()
    {
        return $this->aQueMedicamentoEsAlergico;
    }

    /**
     * @param string $aQueMedicamentoEsAlergico
     */
    public function setAQueMedicamentoEsAlergico($aQueMedicamentoEsAlergico)
    {
        $this->aQueMedicamentoEsAlergico = $aQueMedicamentoEsAlergico;
    }

    /**
     * @return string
     */
    public function getCausaMuerteMadre()
    {
        return $this->causaMuerteMadre;
    }

    /**
     * @param string $causaMuerteMadre
     */
    public function setCausaMuerteMadre($causaMuerteMadre)
    {
        $this->causaMuerteMadre = $causaMuerteMadre;
    }

    /**
     * @return string
     */
    public function getEnfermedadesMadre()
    {
        return $this->enfermedadesMadre;
    }

    /**
     * @param string $enfermedadesMadre
     */
    public function setEnfermedadesMadre($enfermedadesMadre)
    {
        $this->enfermedadesMadre = $enfermedadesMadre;
    }

    /**
     * @return string
     */
    public function getCausaMuertePadre()
    {
        return $this->causaMuertePadre;
    }

    /**
     * @param string $causaMuertePadre
     */
    public function setCausaMuertePadre($causaMuertePadre)
    {
        $this->causaMuertePadre = $causaMuertePadre;
    }

    /**
     * @return string
     */
    public function getEnfermedadesPadre()
    {
        return $this->enfermedadesPadre;
    }

    /**
     * @param string $enfermedadesPadre
     */
    public function setEnfermedadesPadre($enfermedadesPadre)
    {
        $this->enfermedadesPadre = $enfermedadesPadre;
    }

    /**
     * @return string
     */
    public function getCausaMuerteHermanos()
    {
        return $this->causaMuerteHermanos;
    }

    /**
     * @param string $causaMuerteHermanos
     */
    public function setCausaMuerteHermanos($causaMuerteHermanos)
    {
        $this->causaMuerteHermanos = $causaMuerteHermanos;
    }

    /**
     * @return string
     */
    public function getEnfermedadesHermanos()
    {
        return $this->enfermedadesHermanos;
    }

    /**
     * @param string $enfermedadesHermanos
     */
    public function setEnfermedadesHermanos($enfermedadesHermanos)
    {
        $this->enfermedadesHermanos = $enfermedadesHermanos;
    }

    /**
     * @return string
     */
    public function getEnfermedadesAbuelosPaternos()
    {
        return $this->enfermedadesAbuelosPaternos;
    }

    /**
     * @param string $enfermedadesAbuelosPaternos
     */
    public function setEnfermedadesAbuelosPaternos($enfermedadesAbuelosPaternos)
    {
        $this->enfermedadesAbuelosPaternos = $enfermedadesAbuelosPaternos;
    }

    /**
     * @return string
     */
    public function getEnfermedadesAbuelosMaternos()
    {
        return $this->enfermedadesAbuelosMaternos;
    }

    /**
     * @param string $enfermedadesAbuelosMaternos
     */
    public function setEnfermedadesAbuelosMaternos($enfermedadesAbuelosMaternos)
    {
        $this->enfermedadesAbuelosMaternos = $enfermedadesAbuelosMaternos;
    }

    /**
     * @return string
     */
    public function getEspecifiqueFracturas()
    {
        return $this->especifiqueFracturas;
    }

    /**
     * @param string $especifiqueFracturas
     */
    public function setEspecifiqueFracturas($especifiqueFracturas)
    {
        $this->especifiqueFracturas = $especifiqueFracturas;
    }

    /**
     * @return string
     */
    public function getEspecifiqueIntervencion()
    {
        return $this->especifiqueIntervencion;
    }

    /**
     * @param string $especifiqueIntervencion
     */
    public function setEspecifiqueIntervencion($especifiqueIntervencion)
    {
        $this->especifiqueIntervencion = $especifiqueIntervencion;
    }

    /**
     * @return string
     */
    public function getEspecifiqueHospitalizacion()
    {
        return $this->especifiqueHospitalizacion;
    }

    /**
     * @param string $especifiqueHospitalizacion
     */
    public function setEspecifiqueHospitalizacion($especifiqueHospitalizacion)
    {
        $this->especifiqueHospitalizacion = $especifiqueHospitalizacion;
    }

    /**
     * @return string
     */
    public function getEspecifiqueTratamiento()
    {
        return $this->especifiqueTratamiento;
    }

    /**
     * @param string $especifiqueTratamiento
     */
    public function setEspecifiqueTratamiento($especifiqueTratamiento)
    {
        $this->especifiqueTratamiento = $especifiqueTratamiento;
    }

    /**
     * @return string
     */
    public function getNombreRepresentante()
    {
        return $this->nombreRepresentante;
    }

    /**
     * @param string $nombreRepresentante
     */
    public function setNombreRepresentante($nombreRepresentante)
    {
        $this->nombreRepresentante = $nombreRepresentante;
    }

    /**
     * @return string
     */
    public function getNombreTutor()
    {
        return $this->nombreTutor;
    }

    /**
     * @param string $nombreTutor
     */
    public function setNombreTutor($nombreTutor)
    {
        $this->nombreTutor = $nombreTutor;
    }

    /**
     * @return string
     */
    public function getOcupacionTutor()
    {
        return $this->ocupacionTutor;
    }

    /**
     * @param string $ocupacionTutor
     */
    public function setOcupacionTutor($ocupacionTutor)
    {
        $this->ocupacionTutor = $ocupacionTutor;
    }

    /**
     * @return string
     */
    public function getMotivoConsulta()
    {
        return $this->motivoConsulta;
    }

    /**
     * @param string $motivoConsulta
     */
    public function setMotivoConsulta($motivoConsulta)
    {
        $this->motivoConsulta = $motivoConsulta;
    }

    /**
     * @return string
     */
    public function getHistoriaEnfermedad()
    {
        return $this->historiaEnfermedad;
    }

    /**
     * @param string $historiaEnfermedad
     */
    public function setHistoriaEnfermedad($historiaEnfermedad)
    {
        $this->historiaEnfermedad = $historiaEnfermedad;
    }

    /**
     * @return string
     */
    public function getPadecimientoActual()
    {
        return $this->padecimientoActual;
    }

    /**
     * @param string $padecimientoActual
     */
    public function setPadecimientoActual($padecimientoActual)
    {
        $this->padecimientoActual = $padecimientoActual;
    }

    /**
     * @return string
     */
    public function getInterrogatorioPorAparatos()
    {
        return $this->interrogatorioPorAparatos;
    }

    /**
     * @param string $interrogatorioPorAparatos
     */
    public function setInterrogatorioPorAparatos($interrogatorioPorAparatos)
    {
        $this->interrogatorioPorAparatos = $interrogatorioPorAparatos;
    }

    /**
     * @return string
     */
    public function getResultadosLaboratorio()
    {
        return $this->resultadosLaboratorio;
    }

    /**
     * @param string $resultadosLaboratorio
     */
    public function setResultadosLaboratorio($resultadosLaboratorio)
    {
        $this->resultadosLaboratorio = $resultadosLaboratorio;
    }

    /**
     * @return string
     */
    public function getTerapeuticaEmpleada()
    {
        return $this->terapeuticaEmpleada;
    }

    /**
     * @param string $terapeuticaEmpleada
     */
    public function setTerapeuticaEmpleada($terapeuticaEmpleada)
    {
        $this->terapeuticaEmpleada = $terapeuticaEmpleada;
    }

    /**
     * @return string
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * @param string $fechaCreacion
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    /**
     * @return string
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * @param string $fechaNacimiento
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    /**
     * @return EstadoCivil
     */
    public function getEstadoCivil()
    {
        return $this->estadoCivil;
    }

    /**
     * @param EstadoCivil $estadoCivil
     */
    public function setEstadoCivil(EstadoCivil $estadoCivil)
    {
        $this->estadoCivil = $estadoCivil;
    }

    /**
     * @return Religion
     */
    public function getReligion()
    {
        return $this->religion;
    }

    /**
     * @param Religion $religion
     */
    public function setReligion(Religion $religion)
    {
        $this->religion = $religion;
    }

    /**
     * @return Escolaridad
     */
    public function getEscolaridad()
    {
        return $this->escolaridad;
    }

    /**
     * @param Escolaridad $escolaridad
     */
    public function setEscolaridad(Escolaridad $escolaridad)
    {
        $this->escolaridad = $escolaridad;
    }

    /**
     * @return Collection
     */
    public function getListaPadecimientos()
    {
        return $this->listaPadecimientos;
    }

    /**
     * @param Collection $listaPadecimientos
     */
    public function setListaPadecimientos($listaPadecimientos)
    {
        $this->listaPadecimientos = $listaPadecimientos;
    }

    /**
     * @return InstitucionMedica
     */
    public function getInstitucionMedica()
    {
        return $this->institucionMedica;
    }

    /**
     * @param InstitucionMedica $institucionMedica
     */
    public function setInstitucionMedica(InstitucionMedica $institucionMedica)
    {
        $this->institucionMedica = $institucionMedica;
    }

    /**
     * @return float
     */
    public function getPeso()
    {
        return $this->peso;
    }

    /**
     * @param float $peso
     */
    public function setPeso($peso)
    {
        $this->peso = $peso;
    }

    /**
     * @return float
     */
    public function getTalla()
    {
        return $this->talla;
    }

    /**
     * @param float $talla
     */
    public function setTalla($talla)
    {
        $this->talla = $talla;
    }

    /**
     * @return float
     */
    public function getPulso()
    {
        return $this->pulso;
    }

    /**
     * @param float $pulso
     */
    public function setPulso($pulso)
    {
        $this->pulso = $pulso;
    }

    /**
     * @return float
     */
    public function getTemperatura()
    {
        return $this->temperatura;
    }

    /**
     * @param float $temperatura
     */
    public function setTemperatura($temperatura)
    {
        $this->temperatura = $temperatura;
    }

    /**
     * @return float
     */
    public function getTensionArterial()
    {
        return $this->tensionArterial;
    }

    /**
     * @param float $tensionArterial
     */
    public function setTensionArterial($tensionArterial)
    {
        $this->tensionArterial = $tensionArterial;
    }

    /**
     * devuelve el nombre completo de la persona
     * @return string
     */
    public function getNombreCompleto()
    {
        $nombre = $this->nombre;

        if(strlen($this->paterno)) {
            $nombre .= ' '.$this->paterno;
        }

        if(strlen($this->materno)) {
            $nombre .= ' '.$this->materno;
        }

        return $nombre;
    }

    /**
     * verificar si tiene foto
     * @return bool
     */
    public function tieneFoto()
    {
        if(is_null($this->fotografia)) {
            return false;
        }

        return true;
    }

    public function revisaFoto()
    {
        $id = (string)$this->id;
        if(file_exists("public/pacientesFotografias/$id.jpg")) {
            $this->fotografia = new FotografiaPaciente("public/pacientesFotografias/$id.jpg");
        }
    }

    /**
     * buscar un padecimiento de los agregados
     * @param  Padecimiento $padecimiento
     * @return bool
     */
    public function buscarPadecimiento(Padecimiento $padecimiento)
    {
        //recorrer la lista de padecimientos y verificar si algun id es igual al enviado

        if($this->listaPadecimientos != null) {
            foreach ($this->listaPadecimientos as $padecimientos) {
                // echo $padecimientos->getId()." ".$idPadecimiento;
                if($padecimientos->getId() === $padecimiento->getId()) {
                    return true;
                }
            }
        }

        return false;
    }

    public function edadCompleta()
    {

    }

    /**
     * @param bool $nuevoPaciente
     */
    public function setNuevoPaciente($nuevoPaciente)
    {
        $this->nuevoPaciente = $nuevoPaciente;
    }
}