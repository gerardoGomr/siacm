<?php
namespace Siacme\Dominio\Pacientes;

use Siacme\Dominio\Personas\Persona;

/**
 * Class Paciente
 * @package Siacme\Dominio\Pacientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class Paciente extends Persona
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var Domicilio
     */
    protected $domicilio;

    /**
     * @var Fotografia
     */
    protected $fotografia;

    /**
     * @var string
     */
    protected $fechaNacimiento;

    /**
     * @var int
     */
    protected $edadAnios;

    /**
     * @var int
     */
    protected $edadMeses;

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
     * Paciente constructor.
     * @param string $nombre
     * @param string $paterno
     * @param string $materno
     * @param string $telefono
     * @param string $celular
     * @param string $email
     */
    public function __construct($nombre, $paterno, $materno, $telefono, $celular, $email)
    {
        $this->telefono = $telefono;
        $this->celular  = $celular;
        $this->email    = $email;

        parent::__construct($nombre, $paterno, $materno);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Domicilio
     */
    public function getDomicilio()
    {
        return $this->domicilio;
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
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * @return int
     */
    public function getEdadAnios()
    {
        return $this->edadAnios;
    }

    /**
     * @return int
     */
    public function getEdadMeses()
    {
        return $this->edadMeses;
    }

    /**
     * @return string
     */
    public function getLugarNacimiento()
    {
        return $this->lugarNacimiento;
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

    /**
     * obtiene la foto del paciente
     */
    public function revisaFoto()
    {
        $id = $this->id;
        if(file_exists("public/pacientesFotografias/$id.jpg")) {
            $this->fotografia = new FotografiaPaciente("public/pacientesFotografias/$id.jpg");
        }
    }

    /**
     * buscar un padecimiento de los agregados
     * @param  Padecimiento $padecimiento
     * @return bool
     */
    /*public function buscarPadecimiento(Padecimiento $padecimiento)
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
    }*/

    public function edadCompleta()
    {

    }
}