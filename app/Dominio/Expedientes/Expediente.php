<?php
namespace Siacme\Dominio\Expedientes;

use Siacme\Dominio\Pacientes\Paciente;
use Siacme\Dominio\Usuarios\Usuario;

/**
 * Class Expediente
 * @package Siacme\Dominio\Expedientes
 * @author  Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class Expediente
{
	/**
	 * @var int
	 */
	protected $id;

	/**
	 * @var int
	 */
	protected $numero;

	/**
	 * @var string
	 */
	protected $firma;

    /**
     * @var AbstractExpediente
     */
    protected $expedienteEspecialidad;

	/**
	 * @var Paciente
	 */
	protected $paciente;

	/**
	 * @var string
	 */
	protected $fechaCreacion;

	/**
     * @var Fotografia
     */
    protected $fotografia;

    /**
     * @var string
     */
    protected $nombrePediatra;

    /**
     * @var string
     */
    protected $nombreRecomienda;

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
     * @var string
     */
    protected $nombresEdadesHermanos;

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
     * @var InstitucionMedica
     */
    protected $institucionMedica;

    /**
     * Expediente constructor.
     * @param Paciente $paciente
     * @param AbstractExpediente $expedienteEspecialidad
     */
	public function __construct(Paciente $paciente = null, AbstractExpediente $expedienteEspecialidad = null)
	{
        $this->paciente               = $paciente;
        $this->expedienteEspecialidad = $expedienteEspecialidad;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return int
	 */
	public function getNumero()
	{
		return $this->numero;
	}

	/**
	 * @return string
	 */
	public function getFirma()
	{
		return $this->firma;
	}

	/**
	 * @return Paciente
	 */
	public function getPaciente()
	{
		return $this->paciente;
	}

	/**
	 * @return string
	 */
	public function getFechaCreacion()
	{
		return $this->fechaCreacion;
	}

	/**
     * @return Fotografia
     */
    public function getFotografia()
    {
        return $this->fotografia;
    }

    /**
     * @return string
     */
    public function getNombrePediatra()
    {
        return $this->nombrePediatra;
    }

    /**
     * @return string
     */
    public function getNombreRecomienda()
    {
        return $this->nombreRecomienda;
    }

    /**
     * @return boolean
     */
    public function seHaAutomedicado()
    {
        return $this->seHaAutomedicado;
    }

    /**
     * @return boolean
     */
    public function esAlergico()
    {
        return $this->esAlergico;
    }

    /**
     * @return boolean
     */
    public function viveMadre()
    {
        return $this->viveMadre;
    }

    /**
     * @return boolean
     */
    public function vivePadre()
    {
        return $this->vivePadre;
    }

    /**
     * @return int
     */
    public function getNumHermanos()
    {
        return $this->numHermanos;
    }

    /**
     * @return int
     */
    public function getNumHermanosVivos()
    {
        return $this->numHermanosVivos;
    }

    /**
     * @return int
     */
    public function getNumHermanosFinados()
    {
        return $this->numHermanosFinados;
    }

    /**
     * @return boolean
     */
    public function seLeHacenMoretones()
    {
        return $this->seLeHacenMoretones;
    }

    /**
     * @return boolean
     */
    public function haRequeridoTransfusion()
    {
        return $this->haRequeridoTransfusion;
    }

    /**
     * @return boolean
     */
    public function haTenidoFracturas()
    {
        return $this->haTenidoFracturas;
    }

    /**
     * @return boolean
     */
    public function haSidoIntervenido()
    {
        return $this->haSidoIntervenido;
    }

    /**
     * @return boolean
     */
    public function haSidoHospitalizado()
    {
        return $this->haSidoHospitalizado;
    }

    /**
     * @return boolean
     */
    public function exFumador()
    {
        return $this->exFumador;
    }

    /**
     * @return boolean
     */
    public function exAlcoholico()
    {
        return $this->exAlcoholico;
    }

    /**
     * @return boolean
     */
    public function exAdicto()
    {
        return $this->exAdicto;
    }

    /**
     * @return boolean
     */
    public function estaBajoTratamiento()
    {
        return $this->estaBajoTratamiento;
    }

    /**
     * @return string
     */
    public function getConQueSeHaAutomedicado()
    {
        return $this->conQueSeHaAutomedicado;
    }

    /**
     * @return string
     */
    public function getAQueMedicamentoEsAlergico()
    {
        return $this->aQueMedicamentoEsAlergico;
    }

    /**
     * @return string
     */
    public function getCausaMuerteMadre()
    {
        return $this->causaMuerteMadre;
    }

    /**
     * @return string
     */
    public function getEnfermedadesMadre()
    {
        return $this->enfermedadesMadre;
    }

    /**
     * @return string
     */
    public function getCausaMuertePadre()
    {
        return $this->causaMuertePadre;
    }

    /**
     * @return string
     */
    public function getEnfermedadesPadre()
    {
        return $this->enfermedadesPadre;
    }

    /**
     * @return string
     */
    public function getCausaMuerteHermanos()
    {
        return $this->causaMuerteHermanos;
    }

    /**
     * @return string
     */
    public function getEnfermedadesHermanos()
    {
        return $this->enfermedadesHermanos;
    }

    /**
     * @return string
     */
    public function getEnfermedadesAbuelosPaternos()
    {
        return $this->enfermedadesAbuelosPaternos;
    }

    /**
     * @return string
     */
    public function getEnfermedadesAbuelosMaternos()
    {
        return $this->enfermedadesAbuelosMaternos;
    }

    /**
     * @return string
     */
    public function getEspecifiqueFracturas()
    {
        return $this->especifiqueFracturas;
    }

    /**
     * @return string
     */
    public function getEspecifiqueIntervencion()
    {
        return $this->especifiqueIntervencion;
    }

    /**
     * @return string
     */
    public function getEspecifiqueHospitalizacion()
    {
        return $this->especifiqueHospitalizacion;
    }

    /**
     * @return string
     */
    public function getEspecifiqueTratamiento()
    {
        return $this->especifiqueTratamiento;
    }

    /**
     * @return string
     */
    public function getNombreRepresentante()
    {
        return $this->nombreRepresentante;
    }

    /**
     * @return string
     */
    public function getNombreTutor()
    {
        return $this->nombreTutor;
    }

    /**
     * @return string
     */
    public function getOcupacionTutor()
    {
        return $this->ocupacionTutor;
    }

    /**
     * @return string
     */
    public function getMotivoConsulta()
    {
        return $this->motivoConsulta;
    }

    /**
     * @return string
     */
    public function getHistoriaEnfermedad()
    {
        return $this->historiaEnfermedad;
    }

    /**
     * @return string
     */
    public function getNombresEdadesHermanos()
    {
        return $this->nombresEdadesHermanos;
    }

    /**
     * @return EstadoCivil
     */
    public function getEstadoCivil()
    {
        return $this->estadoCivil;
    }

    /**
     * @return Religion
     */
    public function getReligion()
    {
        return $this->religion;
    }

    /**
     * @return Escolaridad
     */
    public function getEscolaridad()
    {
        return $this->escolaridad;
    }

    /**
     * @return InstitucionMedica
     */
    public function getInstitucionMedica()
    {
        return $this->institucionMedica;
    }

    /**
     * @return AbstractExpediente
     */
    public function getExpedienteEspecialidad()
    {
        return $this->expedienteEspecialidad;
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

    public function asignarFoto(Fotografia $fotografia)
    {
        $this->fotografia = $fotografia;
    }

    /**
     * obtiene la foto del paciente
     */
    public function revisaFoto()
    {
        $id = $this->id;
        if(file_exists("storage/pacientesFotografias/$id.jpg")) {
            $this->fotografia = new FotografiaPaciente("public/pacientesFotografias/$id.jpg");
        }
    }

    /**
     * @return bool
     */
    public function firmado()
    {
        return !empty($this->firma);
    }

    /**
     * completar los datos personales
     * @param string $pediatra
     * @param string $quienRecomienda
     * @param string $motivoConsulta
     * @param string $historiaEnfermedad
     * @param string $automedicado
     * @param string $conQueHaAutomedicado
     * @param string $alergico
     * @param string $aCualEsAlergico
     */
    public function agregarDatosPersonales($pediatra, $quienRecomienda, $motivoConsulta, $historiaEnfermedad, $automedicado, $conQueHaAutomedicado, $alergico, $aCualEsAlergico)
    {
        $this->nombrePediatra            = $pediatra;
        $this->nombreRecomienda          = $quienRecomienda;
        $this->motivoConsulta            = $motivoConsulta;
        $this->historiaEnfermedad        = $historiaEnfermedad;
        $this->seHaAutomedicado          = $automedicado;
        $this->conQueSeHaAutomedicado    = $conQueHaAutomedicado;
        $this->esAlergico                = $alergico;
        $this->aQueMedicamentoEsAlergico = $aCualEsAlergico;
    }

    /**
     * completar los datos de antecedentes heredofamiliares
     * @param bool $viveMadre
     * @param string $causaMuerteMadre
     * @param string $enfermedadesMadre
     * @param bool $vivePadre
     * @param string $causaMuertePadre
     * @param string $enfermedadesPadre
     * @param string $enfermedadesAbuelosPaternos
     * @param string $enfermedadesAbuelosMaternos
     * @param int $numHermanos
     * @param int $numHermanosVivos
     * @param string $enfermedadesHermanos
     * @param string $nombresEdades
     */
    public function agregarAntecedentesHeredofamiliares($viveMadre, $causaMuerteMadre, $enfermedadesMadre, $vivePadre, $causaMuertePadre, $enfermedadesPadre, $enfermedadesAbuelosPaternos, $enfermedadesAbuelosMaternos, $numHermanos, $numHermanosVivos, $enfermedadesHermanos, $nombresEdades)
    {
        $this->viveMadre                   = $viveMadre;
        $this->causaMuerteMadre            = $causaMuerteMadre;
        $this->enfermedadesMadre           = $enfermedadesMadre;
        $this->vivePadre                   = $vivePadre;
        $this->causaMuertePadre            = $causaMuertePadre;
        $this->enfermedadesPadre           = $enfermedadesPadre;
        $this->enfermedadesAbuelosPaternos = $enfermedadesAbuelosPaternos;
        $this->enfermedadesAbuelosMaternos = $enfermedadesAbuelosMaternos;
        $this->numHermanos                 = $numHermanos;
        $this->numHermanosVivos            = $numHermanosVivos;
        $this->numHermanosFinados          = $this->numHermanos - $this->numHermanosVivos;
        $this->enfermedadesHermanos        = $enfermedadesHermanos;
        $this->nombresEdadesHermanos       = $nombresEdades;
    }

    /**
     * completar los datos de antecedentes patológicos
     * @param bool $moretones
     * @param bool $transfusion
     * @param bool $fracturas
     * @param bool $cirugia
     * @param bool $hospitalizado
     * @param bool $tratamiento
     * @param string $especifiqueFractura
     * @param string $especifiqueCirugia
     * @param string $especifiqueHospitalizado
     * @param string $especifiqueTratamiento
     */
    public function agregarAntecedentesPatologicos($moretones, $transfusion, $fracturas, $cirugia, $hospitalizado, $tratamiento, $especifiqueFractura, $especifiqueCirugia, $especifiqueHospitalizado, $especifiqueTratamiento)
    {
        $this->seLeHacenMoretones     = $moretones;
        $this->haRequeridoTransfusion = $transfusion;
        $this->haTenidoFracturas      = $fracturas;
        $this->haSidoIntervenido      = $cirugia;
        $this->haSidoHospitalizado    = $hospitalizado;
        $this->estaBajoTratamiento    = $tratamiento;

        if ($this->haTenidoFracturas) {
            $this->especifiqueFracturas = $especifiqueFractura;
        }

        if ($this->haSidoIntervenido) {
            $this->especifiqueIntervencion = $especifiqueCirugia;
        }

        if ($this->haSidoHospitalizado) {
            $this->especifiqueHospitalizacion = $especifiqueHospitalizado;
        }

        if ($this->estaBajoTratamiento) {
            $this->especifiqueTratamiento = $especifiqueTratamiento;
        }
    }

    /**
     * especificar especialidad
     * @param AbstractExpediente $expediente
     */
    public function generarPara(AbstractExpediente $expediente)
    {
        $this->expedienteEspecialidad = $expediente;
        $expediente->expediente($this);
    }
}