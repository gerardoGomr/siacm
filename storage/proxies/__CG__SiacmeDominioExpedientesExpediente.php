<?php

namespace DoctrineProxies\__CG__\Siacme\Dominio\Expedientes;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Expediente extends \Siacme\Dominio\Expedientes\Expediente implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = [];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', 'id', 'numero', 'firma', 'expedienteEspecialidad', 'paciente', 'fechaCreacion', 'fotografia', 'nombrePediatra', 'nombreRecomienda', 'seHaAutomedicado', 'esAlergico', 'viveMadre', 'vivePadre', 'numHermanos', 'numHermanosVivos', 'numHermanosFinados', 'nombresEdadesHermanos', 'seLeHacenMoretones', 'haRequeridoTransfusion', 'haTenidoFracturas', 'haSidoIntervenido', 'haSidoHospitalizado', 'exFumador', 'exAlcoholico', 'exAdicto', 'estaBajoTratamiento', 'conQueSeHaAutomedicado', 'aQueMedicamentoEsAlergico', 'causaMuerteMadre', 'enfermedadesMadre', 'causaMuertePadre', 'enfermedadesPadre', 'causaMuerteHermanos', 'enfermedadesHermanos', 'enfermedadesAbuelosPaternos', 'enfermedadesAbuelosMaternos', 'especifiqueFracturas', 'especifiqueIntervencion', 'especifiqueHospitalizacion', 'especifiqueTratamiento', 'nombreRepresentante', 'nombreTutor', 'ocupacionTutor', 'motivoConsulta', 'historiaEnfermedad', 'estadoCivil', 'religion', 'escolaridad', 'institucionMedica', 'consultas', 'interconsultas'];
        }

        return ['__isInitialized__', 'id', 'numero', 'firma', 'expedienteEspecialidad', 'paciente', 'fechaCreacion', 'fotografia', 'nombrePediatra', 'nombreRecomienda', 'seHaAutomedicado', 'esAlergico', 'viveMadre', 'vivePadre', 'numHermanos', 'numHermanosVivos', 'numHermanosFinados', 'nombresEdadesHermanos', 'seLeHacenMoretones', 'haRequeridoTransfusion', 'haTenidoFracturas', 'haSidoIntervenido', 'haSidoHospitalizado', 'exFumador', 'exAlcoholico', 'exAdicto', 'estaBajoTratamiento', 'conQueSeHaAutomedicado', 'aQueMedicamentoEsAlergico', 'causaMuerteMadre', 'enfermedadesMadre', 'causaMuertePadre', 'enfermedadesPadre', 'causaMuerteHermanos', 'enfermedadesHermanos', 'enfermedadesAbuelosPaternos', 'enfermedadesAbuelosMaternos', 'especifiqueFracturas', 'especifiqueIntervencion', 'especifiqueHospitalizacion', 'especifiqueTratamiento', 'nombreRepresentante', 'nombreTutor', 'ocupacionTutor', 'motivoConsulta', 'historiaEnfermedad', 'estadoCivil', 'religion', 'escolaridad', 'institucionMedica', 'consultas', 'interconsultas'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Expediente $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getNumero()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNumero', []);

        return parent::getNumero();
    }

    /**
     * {@inheritDoc}
     */
    public function getFirma()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFirma', []);

        return parent::getFirma();
    }

    /**
     * {@inheritDoc}
     */
    public function getPaciente()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPaciente', []);

        return parent::getPaciente();
    }

    /**
     * {@inheritDoc}
     */
    public function getFechaCreacion()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFechaCreacion', []);

        return parent::getFechaCreacion();
    }

    /**
     * {@inheritDoc}
     */
    public function getFotografia()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFotografia', []);

        return parent::getFotografia();
    }

    /**
     * {@inheritDoc}
     */
    public function getNombrePediatra()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNombrePediatra', []);

        return parent::getNombrePediatra();
    }

    /**
     * {@inheritDoc}
     */
    public function getNombreRecomienda()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNombreRecomienda', []);

        return parent::getNombreRecomienda();
    }

    /**
     * {@inheritDoc}
     */
    public function seHaAutomedicado()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'seHaAutomedicado', []);

        return parent::seHaAutomedicado();
    }

    /**
     * {@inheritDoc}
     */
    public function esAlergico()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'esAlergico', []);

        return parent::esAlergico();
    }

    /**
     * {@inheritDoc}
     */
    public function viveMadre()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'viveMadre', []);

        return parent::viveMadre();
    }

    /**
     * {@inheritDoc}
     */
    public function vivePadre()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'vivePadre', []);

        return parent::vivePadre();
    }

    /**
     * {@inheritDoc}
     */
    public function getNumHermanos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNumHermanos', []);

        return parent::getNumHermanos();
    }

    /**
     * {@inheritDoc}
     */
    public function getNumHermanosVivos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNumHermanosVivos', []);

        return parent::getNumHermanosVivos();
    }

    /**
     * {@inheritDoc}
     */
    public function getNumHermanosFinados()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNumHermanosFinados', []);

        return parent::getNumHermanosFinados();
    }

    /**
     * {@inheritDoc}
     */
    public function seLeHacenMoretones()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'seLeHacenMoretones', []);

        return parent::seLeHacenMoretones();
    }

    /**
     * {@inheritDoc}
     */
    public function haRequeridoTransfusion()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'haRequeridoTransfusion', []);

        return parent::haRequeridoTransfusion();
    }

    /**
     * {@inheritDoc}
     */
    public function haTenidoFracturas()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'haTenidoFracturas', []);

        return parent::haTenidoFracturas();
    }

    /**
     * {@inheritDoc}
     */
    public function haSidoIntervenido()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'haSidoIntervenido', []);

        return parent::haSidoIntervenido();
    }

    /**
     * {@inheritDoc}
     */
    public function haSidoHospitalizado()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'haSidoHospitalizado', []);

        return parent::haSidoHospitalizado();
    }

    /**
     * {@inheritDoc}
     */
    public function exFumador()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'exFumador', []);

        return parent::exFumador();
    }

    /**
     * {@inheritDoc}
     */
    public function exAlcoholico()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'exAlcoholico', []);

        return parent::exAlcoholico();
    }

    /**
     * {@inheritDoc}
     */
    public function exAdicto()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'exAdicto', []);

        return parent::exAdicto();
    }

    /**
     * {@inheritDoc}
     */
    public function estaBajoTratamiento()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'estaBajoTratamiento', []);

        return parent::estaBajoTratamiento();
    }

    /**
     * {@inheritDoc}
     */
    public function getConQueSeHaAutomedicado()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getConQueSeHaAutomedicado', []);

        return parent::getConQueSeHaAutomedicado();
    }

    /**
     * {@inheritDoc}
     */
    public function getAQueMedicamentoEsAlergico()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAQueMedicamentoEsAlergico', []);

        return parent::getAQueMedicamentoEsAlergico();
    }

    /**
     * {@inheritDoc}
     */
    public function getCausaMuerteMadre()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCausaMuerteMadre', []);

        return parent::getCausaMuerteMadre();
    }

    /**
     * {@inheritDoc}
     */
    public function getEnfermedadesMadre()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEnfermedadesMadre', []);

        return parent::getEnfermedadesMadre();
    }

    /**
     * {@inheritDoc}
     */
    public function getCausaMuertePadre()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCausaMuertePadre', []);

        return parent::getCausaMuertePadre();
    }

    /**
     * {@inheritDoc}
     */
    public function getEnfermedadesPadre()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEnfermedadesPadre', []);

        return parent::getEnfermedadesPadre();
    }

    /**
     * {@inheritDoc}
     */
    public function getCausaMuerteHermanos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCausaMuerteHermanos', []);

        return parent::getCausaMuerteHermanos();
    }

    /**
     * {@inheritDoc}
     */
    public function getEnfermedadesHermanos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEnfermedadesHermanos', []);

        return parent::getEnfermedadesHermanos();
    }

    /**
     * {@inheritDoc}
     */
    public function getEnfermedadesAbuelosPaternos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEnfermedadesAbuelosPaternos', []);

        return parent::getEnfermedadesAbuelosPaternos();
    }

    /**
     * {@inheritDoc}
     */
    public function getEnfermedadesAbuelosMaternos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEnfermedadesAbuelosMaternos', []);

        return parent::getEnfermedadesAbuelosMaternos();
    }

    /**
     * {@inheritDoc}
     */
    public function getEspecifiqueFracturas()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEspecifiqueFracturas', []);

        return parent::getEspecifiqueFracturas();
    }

    /**
     * {@inheritDoc}
     */
    public function getEspecifiqueIntervencion()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEspecifiqueIntervencion', []);

        return parent::getEspecifiqueIntervencion();
    }

    /**
     * {@inheritDoc}
     */
    public function getEspecifiqueHospitalizacion()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEspecifiqueHospitalizacion', []);

        return parent::getEspecifiqueHospitalizacion();
    }

    /**
     * {@inheritDoc}
     */
    public function getEspecifiqueTratamiento()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEspecifiqueTratamiento', []);

        return parent::getEspecifiqueTratamiento();
    }

    /**
     * {@inheritDoc}
     */
    public function getNombreRepresentante()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNombreRepresentante', []);

        return parent::getNombreRepresentante();
    }

    /**
     * {@inheritDoc}
     */
    public function getNombreTutor()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNombreTutor', []);

        return parent::getNombreTutor();
    }

    /**
     * {@inheritDoc}
     */
    public function getOcupacionTutor()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOcupacionTutor', []);

        return parent::getOcupacionTutor();
    }

    /**
     * {@inheritDoc}
     */
    public function getMotivoConsulta()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMotivoConsulta', []);

        return parent::getMotivoConsulta();
    }

    /**
     * {@inheritDoc}
     */
    public function getHistoriaEnfermedad()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHistoriaEnfermedad', []);

        return parent::getHistoriaEnfermedad();
    }

    /**
     * {@inheritDoc}
     */
    public function getNombresEdadesHermanos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNombresEdadesHermanos', []);

        return parent::getNombresEdadesHermanos();
    }

    /**
     * {@inheritDoc}
     */
    public function getEstadoCivil()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEstadoCivil', []);

        return parent::getEstadoCivil();
    }

    /**
     * {@inheritDoc}
     */
    public function getReligion()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getReligion', []);

        return parent::getReligion();
    }

    /**
     * {@inheritDoc}
     */
    public function getEscolaridad()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEscolaridad', []);

        return parent::getEscolaridad();
    }

    /**
     * {@inheritDoc}
     */
    public function getInstitucionMedica()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getInstitucionMedica', []);

        return parent::getInstitucionMedica();
    }

    /**
     * {@inheritDoc}
     */
    public function getExpedienteEspecialidad()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getExpedienteEspecialidad', []);

        return parent::getExpedienteEspecialidad();
    }

    /**
     * {@inheritDoc}
     */
    public function getConsultas()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getConsultas', []);

        return parent::getConsultas();
    }

    /**
     * {@inheritDoc}
     */
    public function tieneFoto()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'tieneFoto', []);

        return parent::tieneFoto();
    }

    /**
     * {@inheritDoc}
     */
    public function asignarFoto(\Siacme\Dominio\Expedientes\Fotografia $fotografia)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'asignarFoto', [$fotografia]);

        return parent::asignarFoto($fotografia);
    }

    /**
     * {@inheritDoc}
     */
    public function revisaFoto()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'revisaFoto', []);

        return parent::revisaFoto();
    }

    /**
     * {@inheritDoc}
     */
    public function firmado()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'firmado', []);

        return parent::firmado();
    }

    /**
     * {@inheritDoc}
     */
    public function agregarDatosPersonales($pediatra, $quienRecomienda, $motivoConsulta, $historiaEnfermedad, $automedicado, $conQueHaAutomedicado, $alergico, $aCualEsAlergico)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'agregarDatosPersonales', [$pediatra, $quienRecomienda, $motivoConsulta, $historiaEnfermedad, $automedicado, $conQueHaAutomedicado, $alergico, $aCualEsAlergico]);

        return parent::agregarDatosPersonales($pediatra, $quienRecomienda, $motivoConsulta, $historiaEnfermedad, $automedicado, $conQueHaAutomedicado, $alergico, $aCualEsAlergico);
    }

    /**
     * {@inheritDoc}
     */
    public function agregarAntecedentesHeredofamiliares($viveMadre, $causaMuerteMadre, $enfermedadesMadre, $vivePadre, $causaMuertePadre, $enfermedadesPadre, $enfermedadesAbuelosPaternos, $enfermedadesAbuelosMaternos, $numHermanos, $numHermanosVivos, $enfermedadesHermanos, $nombresEdades)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'agregarAntecedentesHeredofamiliares', [$viveMadre, $causaMuerteMadre, $enfermedadesMadre, $vivePadre, $causaMuertePadre, $enfermedadesPadre, $enfermedadesAbuelosPaternos, $enfermedadesAbuelosMaternos, $numHermanos, $numHermanosVivos, $enfermedadesHermanos, $nombresEdades]);

        return parent::agregarAntecedentesHeredofamiliares($viveMadre, $causaMuerteMadre, $enfermedadesMadre, $vivePadre, $causaMuertePadre, $enfermedadesPadre, $enfermedadesAbuelosPaternos, $enfermedadesAbuelosMaternos, $numHermanos, $numHermanosVivos, $enfermedadesHermanos, $nombresEdades);
    }

    /**
     * {@inheritDoc}
     */
    public function agregarAntecedentesPatologicos($moretones, $transfusion, $fracturas, $cirugia, $hospitalizado, $tratamiento, $especifiqueFractura, $especifiqueCirugia, $especifiqueHospitalizado, $especifiqueTratamiento)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'agregarAntecedentesPatologicos', [$moretones, $transfusion, $fracturas, $cirugia, $hospitalizado, $tratamiento, $especifiqueFractura, $especifiqueCirugia, $especifiqueHospitalizado, $especifiqueTratamiento]);

        return parent::agregarAntecedentesPatologicos($moretones, $transfusion, $fracturas, $cirugia, $hospitalizado, $tratamiento, $especifiqueFractura, $especifiqueCirugia, $especifiqueHospitalizado, $especifiqueTratamiento);
    }

    /**
     * {@inheritDoc}
     */
    public function generarPara(\Siacme\Dominio\Expedientes\AbstractExpediente $expediente)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'generarPara', [$expediente]);

        return parent::generarPara($expediente);
    }

    /**
     * {@inheritDoc}
     */
    public function revisadoPorPaciente()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'revisadoPorPaciente', []);

        return parent::revisadoPorPaciente();
    }

    /**
     * {@inheritDoc}
     */
    public function agregarConsulta(\Siacme\Dominio\Consultas\Consulta $consulta)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'agregarConsulta', [$consulta]);

        return parent::agregarConsulta($consulta);
    }

    /**
     * {@inheritDoc}
     */
    public function agregarInterconsulta(\Siacme\Dominio\Interconsultas\Interconsulta $interconsulta)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'agregarInterconsulta', [$interconsulta]);

        return parent::agregarInterconsulta($interconsulta);
    }

}
