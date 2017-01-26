<?php

namespace DoctrineProxies\__CG__\Siacme\Dominio\Expedientes;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class ExpedienteJohanna extends \Siacme\Dominio\Expedientes\ExpedienteJohanna implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', 'nombrePadre', 'nombreMadre', 'ocupacionPadre', 'ocupacionMadre', 'fechaUltimoExamenBucal', 'motivoVisitaDentista', 'reaccionAnestesico', 'descripcionHabito', 'especifiqueAuxiliar', 'notas', 'edadErupcionoPrimerDiente', 'haPresentadoDolorBoca', 'presentaMalOlorBoca', 'haNotadoSangradoEncias', 'sienteDienteFlojo', 'primeraVisitaDentista', 'leHanColocadoAnestesico', 'tuvoMalaReaccionAnestesico', 'tipoCepillo', 'vecesCepillaDiente', 'alguienAyudaACepillarse', 'vecesComeDia', 'hiloDental', 'enjuagueBucal', 'limpiadorLingual', 'tabletasReveladoras', 'otroAuxiliar', 'succionDigital', 'succionLingual', 'biberon', 'bruxismo', 'succionLabial', 'respiracionBucal', 'onicofagia', 'chupon', 'otroHabito', 'posturaRectaCaminar', 'posturaRectaSentar', 'mordidaBordeBorde', 'sobremordidaVertical', 'sobremordidaHorizontal', 'mordidaAbiertaAnterior', 'mordidaCruzadaAnterior', 'mordidaCruzadaPosterior', 'lineaMediaDental', 'lineaMediaEsqueletica', 'alteracionesTamanio', 'alteracionesForma', 'alteracionesNumero', 'alteracionesEstructura', 'alteracionesTextura', 'alteracionesColor', 'traumatismoBucal', 'marcaPasta', 'comportamientoInicial', 'comportamientoFrankl', 'trastornoLenguaje', 'examenExtraoral', 'examenIntraoral', 'dentincionTemporal', 'relacionMolar', 'relacionCanina', 'tipoArcoI', 'tipoArcoII', 'odontogramas', 'planesTratamiento', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteJohanna' . "\0" . 'morfologiaCraneofacial', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteJohanna' . "\0" . 'morfologiaFacial', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteJohanna' . "\0" . 'convexividadFacial', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteJohanna' . "\0" . 'atm', 'id', 'primeraVez', 'revisado', 'expediente'];
        }

        return ['__isInitialized__', 'nombrePadre', 'nombreMadre', 'ocupacionPadre', 'ocupacionMadre', 'fechaUltimoExamenBucal', 'motivoVisitaDentista', 'reaccionAnestesico', 'descripcionHabito', 'especifiqueAuxiliar', 'notas', 'edadErupcionoPrimerDiente', 'haPresentadoDolorBoca', 'presentaMalOlorBoca', 'haNotadoSangradoEncias', 'sienteDienteFlojo', 'primeraVisitaDentista', 'leHanColocadoAnestesico', 'tuvoMalaReaccionAnestesico', 'tipoCepillo', 'vecesCepillaDiente', 'alguienAyudaACepillarse', 'vecesComeDia', 'hiloDental', 'enjuagueBucal', 'limpiadorLingual', 'tabletasReveladoras', 'otroAuxiliar', 'succionDigital', 'succionLingual', 'biberon', 'bruxismo', 'succionLabial', 'respiracionBucal', 'onicofagia', 'chupon', 'otroHabito', 'posturaRectaCaminar', 'posturaRectaSentar', 'mordidaBordeBorde', 'sobremordidaVertical', 'sobremordidaHorizontal', 'mordidaAbiertaAnterior', 'mordidaCruzadaAnterior', 'mordidaCruzadaPosterior', 'lineaMediaDental', 'lineaMediaEsqueletica', 'alteracionesTamanio', 'alteracionesForma', 'alteracionesNumero', 'alteracionesEstructura', 'alteracionesTextura', 'alteracionesColor', 'traumatismoBucal', 'marcaPasta', 'comportamientoInicial', 'comportamientoFrankl', 'trastornoLenguaje', 'examenExtraoral', 'examenIntraoral', 'dentincionTemporal', 'relacionMolar', 'relacionCanina', 'tipoArcoI', 'tipoArcoII', 'odontogramas', 'planesTratamiento', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteJohanna' . "\0" . 'morfologiaCraneofacial', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteJohanna' . "\0" . 'morfologiaFacial', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteJohanna' . "\0" . 'convexividadFacial', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteJohanna' . "\0" . 'atm', 'id', 'primeraVez', 'revisado', 'expediente'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (ExpedienteJohanna $proxy) {
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
    public function getNombrePadre()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNombrePadre', []);

        return parent::getNombrePadre();
    }

    /**
     * {@inheritDoc}
     */
    public function getNombreMadre()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNombreMadre', []);

        return parent::getNombreMadre();
    }

    /**
     * {@inheritDoc}
     */
    public function getOcupacionPadre()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOcupacionPadre', []);

        return parent::getOcupacionPadre();
    }

    /**
     * {@inheritDoc}
     */
    public function getOcupacionMadre()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOcupacionMadre', []);

        return parent::getOcupacionMadre();
    }

    /**
     * {@inheritDoc}
     */
    public function getFechaUltimoExamenBucal()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFechaUltimoExamenBucal', []);

        return parent::getFechaUltimoExamenBucal();
    }

    /**
     * {@inheritDoc}
     */
    public function getMotivoVisitaDentista()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMotivoVisitaDentista', []);

        return parent::getMotivoVisitaDentista();
    }

    /**
     * {@inheritDoc}
     */
    public function getReaccionAnestesico()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getReaccionAnestesico', []);

        return parent::getReaccionAnestesico();
    }

    /**
     * {@inheritDoc}
     */
    public function getDescripcionHabito()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDescripcionHabito', []);

        return parent::getDescripcionHabito();
    }

    /**
     * {@inheritDoc}
     */
    public function getEspecifiqueAuxiliar()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEspecifiqueAuxiliar', []);

        return parent::getEspecifiqueAuxiliar();
    }

    /**
     * {@inheritDoc}
     */
    public function getNotas()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNotas', []);

        return parent::getNotas();
    }

    /**
     * {@inheritDoc}
     */
    public function getEdadErupcionoPrimerDiente()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEdadErupcionoPrimerDiente', []);

        return parent::getEdadErupcionoPrimerDiente();
    }

    /**
     * {@inheritDoc}
     */
    public function haPresentadoDolorBoca()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'haPresentadoDolorBoca', []);

        return parent::haPresentadoDolorBoca();
    }

    /**
     * {@inheritDoc}
     */
    public function presentaMalOlorBoca()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'presentaMalOlorBoca', []);

        return parent::presentaMalOlorBoca();
    }

    /**
     * {@inheritDoc}
     */
    public function haNotadoSangradoEncias()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'haNotadoSangradoEncias', []);

        return parent::haNotadoSangradoEncias();
    }

    /**
     * {@inheritDoc}
     */
    public function sienteDienteFlojo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'sienteDienteFlojo', []);

        return parent::sienteDienteFlojo();
    }

    /**
     * {@inheritDoc}
     */
    public function primeraVisitaDentista()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'primeraVisitaDentista', []);

        return parent::primeraVisitaDentista();
    }

    /**
     * {@inheritDoc}
     */
    public function leHanColocadoAnestesico()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'leHanColocadoAnestesico', []);

        return parent::leHanColocadoAnestesico();
    }

    /**
     * {@inheritDoc}
     */
    public function tuvoMalaReaccionAnestesico()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'tuvoMalaReaccionAnestesico', []);

        return parent::tuvoMalaReaccionAnestesico();
    }

    /**
     * {@inheritDoc}
     */
    public function getTipoCepillo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTipoCepillo', []);

        return parent::getTipoCepillo();
    }

    /**
     * {@inheritDoc}
     */
    public function getVecesCepillaDiente()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getVecesCepillaDiente', []);

        return parent::getVecesCepillaDiente();
    }

    /**
     * {@inheritDoc}
     */
    public function alguienAyudaACepillarse()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'alguienAyudaACepillarse', []);

        return parent::alguienAyudaACepillarse();
    }

    /**
     * {@inheritDoc}
     */
    public function getVecesComeDia()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getVecesComeDia', []);

        return parent::getVecesComeDia();
    }

    /**
     * {@inheritDoc}
     */
    public function hiloDental()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'hiloDental', []);

        return parent::hiloDental();
    }

    /**
     * {@inheritDoc}
     */
    public function enjuagueBucal()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'enjuagueBucal', []);

        return parent::enjuagueBucal();
    }

    /**
     * {@inheritDoc}
     */
    public function limpiadorLingual()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'limpiadorLingual', []);

        return parent::limpiadorLingual();
    }

    /**
     * {@inheritDoc}
     */
    public function tabletasReveladoras()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'tabletasReveladoras', []);

        return parent::tabletasReveladoras();
    }

    /**
     * {@inheritDoc}
     */
    public function otroAuxiliar()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'otroAuxiliar', []);

        return parent::otroAuxiliar();
    }

    /**
     * {@inheritDoc}
     */
    public function succionDigital()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'succionDigital', []);

        return parent::succionDigital();
    }

    /**
     * {@inheritDoc}
     */
    public function succionLingual()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'succionLingual', []);

        return parent::succionLingual();
    }

    /**
     * {@inheritDoc}
     */
    public function biberon()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'biberon', []);

        return parent::biberon();
    }

    /**
     * {@inheritDoc}
     */
    public function bruxismo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'bruxismo', []);

        return parent::bruxismo();
    }

    /**
     * {@inheritDoc}
     */
    public function succionLabial()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'succionLabial', []);

        return parent::succionLabial();
    }

    /**
     * {@inheritDoc}
     */
    public function respiracionBucal()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'respiracionBucal', []);

        return parent::respiracionBucal();
    }

    /**
     * {@inheritDoc}
     */
    public function onicofagia()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'onicofagia', []);

        return parent::onicofagia();
    }

    /**
     * {@inheritDoc}
     */
    public function chupon()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'chupon', []);

        return parent::chupon();
    }

    /**
     * {@inheritDoc}
     */
    public function otroHabito()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'otroHabito', []);

        return parent::otroHabito();
    }

    /**
     * {@inheritDoc}
     */
    public function posturaRectaCaminar()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'posturaRectaCaminar', []);

        return parent::posturaRectaCaminar();
    }

    /**
     * {@inheritDoc}
     */
    public function posturaRectaSentar()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'posturaRectaSentar', []);

        return parent::posturaRectaSentar();
    }

    /**
     * {@inheritDoc}
     */
    public function getMordidaBordeBorde()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMordidaBordeBorde', []);

        return parent::getMordidaBordeBorde();
    }

    /**
     * {@inheritDoc}
     */
    public function getMobremordidaVertical()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMobremordidaVertical', []);

        return parent::getMobremordidaVertical();
    }

    /**
     * {@inheritDoc}
     */
    public function getMobremordidaHorizontal()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMobremordidaHorizontal', []);

        return parent::getMobremordidaHorizontal();
    }

    /**
     * {@inheritDoc}
     */
    public function getMordidaAbiertaAnterior()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMordidaAbiertaAnterior', []);

        return parent::getMordidaAbiertaAnterior();
    }

    /**
     * {@inheritDoc}
     */
    public function getMordidaCruzadaAnterior()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMordidaCruzadaAnterior', []);

        return parent::getMordidaCruzadaAnterior();
    }

    /**
     * {@inheritDoc}
     */
    public function getMordidaCruzadaPosterior()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMordidaCruzadaPosterior', []);

        return parent::getMordidaCruzadaPosterior();
    }

    /**
     * {@inheritDoc}
     */
    public function getLineaMediaDental()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLineaMediaDental', []);

        return parent::getLineaMediaDental();
    }

    /**
     * {@inheritDoc}
     */
    public function getLineaMediaEsqueletica()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLineaMediaEsqueletica', []);

        return parent::getLineaMediaEsqueletica();
    }

    /**
     * {@inheritDoc}
     */
    public function getAlteracionesTamanio()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAlteracionesTamanio', []);

        return parent::getAlteracionesTamanio();
    }

    /**
     * {@inheritDoc}
     */
    public function getAlteracionesForma()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAlteracionesForma', []);

        return parent::getAlteracionesForma();
    }

    /**
     * {@inheritDoc}
     */
    public function getAlteracionesNumero()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAlteracionesNumero', []);

        return parent::getAlteracionesNumero();
    }

    /**
     * {@inheritDoc}
     */
    public function getAlteracionesEstructura()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAlteracionesEstructura', []);

        return parent::getAlteracionesEstructura();
    }

    /**
     * {@inheritDoc}
     */
    public function getAlteracionesTextura()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAlteracionesTextura', []);

        return parent::getAlteracionesTextura();
    }

    /**
     * {@inheritDoc}
     */
    public function getAlteracionesColor()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAlteracionesColor', []);

        return parent::getAlteracionesColor();
    }

    /**
     * {@inheritDoc}
     */
    public function getTraumatismoBucal()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTraumatismoBucal', []);

        return parent::getTraumatismoBucal();
    }

    /**
     * {@inheritDoc}
     */
    public function getMarcaPasta()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMarcaPasta', []);

        return parent::getMarcaPasta();
    }

    /**
     * {@inheritDoc}
     */
    public function getComportamientoInicial()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getComportamientoInicial', []);

        return parent::getComportamientoInicial();
    }

    /**
     * {@inheritDoc}
     */
    public function getComportamientoFrankl()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getComportamientoFrankl', []);

        return parent::getComportamientoFrankl();
    }

    /**
     * {@inheritDoc}
     */
    public function getTrastornoLenguaje()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTrastornoLenguaje', []);

        return parent::getTrastornoLenguaje();
    }

    /**
     * {@inheritDoc}
     */
    public function getExamenExtraoral()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getExamenExtraoral', []);

        return parent::getExamenExtraoral();
    }

    /**
     * {@inheritDoc}
     */
    public function agregarDatosPersonales($nombrePadre, $ocupacionPadre, $nombreMadre, $ocupacionMadre)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'agregarDatosPersonales', [$nombrePadre, $ocupacionPadre, $nombreMadre, $ocupacionMadre]);

        return parent::agregarDatosPersonales($nombrePadre, $ocupacionPadre, $nombreMadre, $ocupacionMadre);
    }

    /**
     * {@inheritDoc}
     */
    public function agregarAntecedentesOdontopatologicos($dolorBoca, $sangradoEncias, $malOlor, $dienteFlojo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'agregarAntecedentesOdontopatologicos', [$dolorBoca, $sangradoEncias, $malOlor, $dienteFlojo]);

        return parent::agregarAntecedentesOdontopatologicos($dolorBoca, $sangradoEncias, $malOlor, $dienteFlojo);
    }

    /**
     * {@inheritDoc}
     */
    public function agregarAntecedentesNoPatologicos($primeraVisita, \DateTime $fechaUltimoExamen = NULL, $motivoUltimoExamen, $anestesico, $malaReaccion, $queReaccion, $traumatismo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'agregarAntecedentesNoPatologicos', [$primeraVisita, $fechaUltimoExamen, $motivoUltimoExamen, $anestesico, $malaReaccion, $queReaccion, $traumatismo]);

        return parent::agregarAntecedentesNoPatologicos($primeraVisita, $fechaUltimoExamen, $motivoUltimoExamen, $anestesico, $malaReaccion, $queReaccion, $traumatismo);
    }

    /**
     * {@inheritDoc}
     */
    public function agregarHigieneBucodental($tipoCepillo, $marcaPasta, $vecesCepilla, $edadErupcionaPrimerDiente, $ayudaAlCepillarse, $vecesCome, $hiloDental, $enjuagueBucal, $limpiadorLingual, $tabletasReveladoras, $otroAuxiliar, $especifiqueAuxiliar)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'agregarHigieneBucodental', [$tipoCepillo, $marcaPasta, $vecesCepilla, $edadErupcionaPrimerDiente, $ayudaAlCepillarse, $vecesCome, $hiloDental, $enjuagueBucal, $limpiadorLingual, $tabletasReveladoras, $otroAuxiliar, $especifiqueAuxiliar]);

        return parent::agregarHigieneBucodental($tipoCepillo, $marcaPasta, $vecesCepilla, $edadErupcionaPrimerDiente, $ayudaAlCepillarse, $vecesCome, $hiloDental, $enjuagueBucal, $limpiadorLingual, $tabletasReveladoras, $otroAuxiliar, $especifiqueAuxiliar);
    }

    /**
     * {@inheritDoc}
     */
    public function agregarHabitosOrales($succionDigital, $succionLingual, $biberon, $bruxismo, $succionLabial, $respiracionBucal, $onicofagia, $chupon, $otroHabito, $especifiqueHabito)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'agregarHabitosOrales', [$succionDigital, $succionLingual, $biberon, $bruxismo, $succionLabial, $respiracionBucal, $onicofagia, $chupon, $otroHabito, $especifiqueHabito]);

        return parent::agregarHabitosOrales($succionDigital, $succionLingual, $biberon, $bruxismo, $succionLabial, $respiracionBucal, $onicofagia, $chupon, $otroHabito, $especifiqueHabito);
    }

    /**
     * {@inheritDoc}
     */
    public function agregarExamenExtraoral(\Siacme\Dominio\Expedientes\MorfologiaCraneofacial $morfologiaCraneofacial, \Siacme\Dominio\Expedientes\MorfologiaFacial $morfologiaFacial, \Siacme\Dominio\Expedientes\ConvexividadFacial $convexividadFacial, \Siacme\Dominio\Expedientes\ATM $atm)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'agregarExamenExtraoral', [$morfologiaCraneofacial, $morfologiaFacial, $convexividadFacial, $atm]);

        return parent::agregarExamenExtraoral($morfologiaCraneofacial, $morfologiaFacial, $convexividadFacial, $atm);
    }

    /**
     * {@inheritDoc}
     */
    public function agregarExamenIntraoral(\Siacme\Dominio\Expedientes\ExamenIntraoral $examen)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'agregarExamenIntraoral', [$examen]);

        return parent::agregarExamenIntraoral($examen);
    }

    /**
     * {@inheritDoc}
     */
    public function agregarArcos($arcoI, $arcoII)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'agregarArcos', [$arcoI, $arcoII]);

        return parent::agregarArcos($arcoI, $arcoII);
    }

    /**
     * {@inheritDoc}
     */
    public function tipoArco()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'tipoArco', []);

        return parent::tipoArco();
    }

    /**
     * {@inheritDoc}
     */
    public function getSobremordidaVertical()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSobremordidaVertical', []);

        return parent::getSobremordidaVertical();
    }

    /**
     * {@inheritDoc}
     */
    public function getSobremordidaHorizontal()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSobremordidaHorizontal', []);

        return parent::getSobremordidaHorizontal();
    }

    /**
     * {@inheritDoc}
     */
    public function getExamenIntraoral()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getExamenIntraoral', []);

        return parent::getExamenIntraoral();
    }

    /**
     * {@inheritDoc}
     */
    public function getDentincionTemporal()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDentincionTemporal', []);

        return parent::getDentincionTemporal();
    }

    /**
     * {@inheritDoc}
     */
    public function getRelacionMolar()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRelacionMolar', []);

        return parent::getRelacionMolar();
    }

    /**
     * {@inheritDoc}
     */
    public function getRelacionCanina()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRelacionCanina', []);

        return parent::getRelacionCanina();
    }

    /**
     * {@inheritDoc}
     */
    public function tipoArcoI()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'tipoArcoI', []);

        return parent::tipoArcoI();
    }

    /**
     * {@inheritDoc}
     */
    public function tipoArcoII()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'tipoArcoII', []);

        return parent::tipoArcoII();
    }

    /**
     * {@inheritDoc}
     */
    public function getMorfologiaCraneofacial()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMorfologiaCraneofacial', []);

        return parent::getMorfologiaCraneofacial();
    }

    /**
     * {@inheritDoc}
     */
    public function getMorfologiaFacial()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMorfologiaFacial', []);

        return parent::getMorfologiaFacial();
    }

    /**
     * {@inheritDoc}
     */
    public function getConvexividadFacial()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getConvexividadFacial', []);

        return parent::getConvexividadFacial();
    }

    /**
     * {@inheritDoc}
     */
    public function getAtm()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAtm', []);

        return parent::getAtm();
    }

    /**
     * {@inheritDoc}
     */
    public function agregarDentincionTemporal(\Siacme\Dominio\Expedientes\DentincionTemporal $dentincionTemporal)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'agregarDentincionTemporal', [$dentincionTemporal]);

        return parent::agregarDentincionTemporal($dentincionTemporal);
    }

    /**
     * {@inheritDoc}
     */
    public function agregarDentincionMixtaPermanente(\Siacme\Dominio\Expedientes\DentincionMixtaPermanente $relacionMolar, \Siacme\Dominio\Expedientes\DentincionMixtaPermanente $relacionCanina)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'agregarDentincionMixtaPermanente', [$relacionMolar, $relacionCanina]);

        return parent::agregarDentincionMixtaPermanente($relacionMolar, $relacionCanina);
    }

    /**
     * {@inheritDoc}
     */
    public function agregarMordidas(\Siacme\Dominio\Expedientes\Mordida $mordidaBordeBorde, \Siacme\Dominio\Expedientes\Mordida $sobremordidaVertical, \Siacme\Dominio\Expedientes\Mordida $sobremordidaHorizontal, \Siacme\Dominio\Expedientes\Mordida $mordidaAbiertaAnterior, \Siacme\Dominio\Expedientes\Mordida $mordidaCruzadaAnterior, \Siacme\Dominio\Expedientes\Mordida $mordidaCruzadaPosterior, \Siacme\Dominio\Expedientes\Mordida $lineaMediaDental, \Siacme\Dominio\Expedientes\Mordida $lineaMediaEsqueletica, \Siacme\Dominio\Expedientes\Mordida $alteracionTamanio, \Siacme\Dominio\Expedientes\Mordida $alteracionForma, \Siacme\Dominio\Expedientes\Mordida $alteracionNumero, \Siacme\Dominio\Expedientes\Mordida $alteracionEstructura, \Siacme\Dominio\Expedientes\Mordida $alteracionTextura, \Siacme\Dominio\Expedientes\Mordida $alteracionColor)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'agregarMordidas', [$mordidaBordeBorde, $sobremordidaVertical, $sobremordidaHorizontal, $mordidaAbiertaAnterior, $mordidaCruzadaAnterior, $mordidaCruzadaPosterior, $lineaMediaDental, $lineaMediaEsqueletica, $alteracionTamanio, $alteracionForma, $alteracionNumero, $alteracionEstructura, $alteracionTextura, $alteracionColor]);

        return parent::agregarMordidas($mordidaBordeBorde, $sobremordidaVertical, $sobremordidaHorizontal, $mordidaAbiertaAnterior, $mordidaCruzadaAnterior, $mordidaCruzadaPosterior, $lineaMediaDental, $lineaMediaEsqueletica, $alteracionTamanio, $alteracionForma, $alteracionNumero, $alteracionEstructura, $alteracionTextura, $alteracionColor);
    }

    /**
     * {@inheritDoc}
     */
    public function agregarOdontograma(\Siacme\Dominio\Expedientes\Odontograma $odontograma)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'agregarOdontograma', [$odontograma]);

        return parent::agregarOdontograma($odontograma);
    }

    /**
     * {@inheritDoc}
     */
    public function agregarPlanTratamiento(\Siacme\Dominio\Expedientes\PlanTratamiento $plan)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'agregarPlanTratamiento', [$plan]);

        return parent::agregarPlanTratamiento($plan);
    }

    /**
     * {@inheritDoc}
     */
    public function obtenerOdontogramaActivo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'obtenerOdontogramaActivo', []);

        return parent::obtenerOdontogramaActivo();
    }

    /**
     * {@inheritDoc}
     */
    public function inicializarTemp(\Siacme\Dominio\Listas\IColeccion $odontogramas)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'inicializarTemp', [$odontogramas]);

        return parent::inicializarTemp($odontogramas);
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
    public function primeraVez()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'primeraVez', []);

        return parent::primeraVez();
    }

    /**
     * {@inheritDoc}
     */
    public function revisado()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'revisado', []);

        return parent::revisado();
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
    public function expediente(\Siacme\Dominio\Expedientes\Expediente $expediente)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'expediente', [$expediente]);

        return parent::expediente($expediente);
    }

    /**
     * {@inheritDoc}
     */
    public function numero()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'numero', []);

        return parent::numero();
    }

}