<?php

namespace DoctrineProxies\__CG__\Siacme\Dominio\Expedientes;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class ExpedienteRigoberto extends \Siacme\Dominio\Expedientes\ExpedienteRigoberto implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteRigoberto' . "\0" . 'representanteLegal', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteRigoberto' . "\0" . 'perioricidadBanio', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteRigoberto' . "\0" . 'perioricidadHigieneBucal', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteRigoberto' . "\0" . 'perioricidadLavaManos', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteRigoberto' . "\0" . 'frecuenciaCambioRopa', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteRigoberto' . "\0" . 'vecesComeDia', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteRigoberto' . "\0" . 'tiempoEntreComidas', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteRigoberto' . "\0" . 'horasDuerme', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteRigoberto' . "\0" . 'frecuenciaEjercicio', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteRigoberto' . "\0" . 'regimenAlimenticio', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteRigoberto' . "\0" . 'descripcionRegimen', 'id', 'primeraVez', 'revisado', 'expediente'];
        }

        return ['__isInitialized__', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteRigoberto' . "\0" . 'representanteLegal', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteRigoberto' . "\0" . 'perioricidadBanio', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteRigoberto' . "\0" . 'perioricidadHigieneBucal', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteRigoberto' . "\0" . 'perioricidadLavaManos', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteRigoberto' . "\0" . 'frecuenciaCambioRopa', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteRigoberto' . "\0" . 'vecesComeDia', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteRigoberto' . "\0" . 'tiempoEntreComidas', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteRigoberto' . "\0" . 'horasDuerme', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteRigoberto' . "\0" . 'frecuenciaEjercicio', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteRigoberto' . "\0" . 'regimenAlimenticio', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\ExpedienteRigoberto' . "\0" . 'descripcionRegimen', 'id', 'primeraVez', 'revisado', 'expediente'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (ExpedienteRigoberto $proxy) {
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
    public function agregarDatosPersonales($nombrePadre, $ocupacionPadre, $nombreMadre, $ocupacionMadre)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'agregarDatosPersonales', [$nombrePadre, $ocupacionPadre, $nombreMadre, $ocupacionMadre]);

        return parent::agregarDatosPersonales($nombrePadre, $ocupacionPadre, $nombreMadre, $ocupacionMadre);
    }

    /**
     * {@inheritDoc}
     */
    public function getRepresentanteLegal()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRepresentanteLegal', []);

        return parent::getRepresentanteLegal();
    }

    /**
     * {@inheritDoc}
     */
    public function getPerioricidadBanio()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPerioricidadBanio', []);

        return parent::getPerioricidadBanio();
    }

    /**
     * {@inheritDoc}
     */
    public function getPerioricidadHigieneBucal()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPerioricidadHigieneBucal', []);

        return parent::getPerioricidadHigieneBucal();
    }

    /**
     * {@inheritDoc}
     */
    public function getPerioricidadLavaManos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPerioricidadLavaManos', []);

        return parent::getPerioricidadLavaManos();
    }

    /**
     * {@inheritDoc}
     */
    public function getFrecuenciaCambioRopa()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFrecuenciaCambioRopa', []);

        return parent::getFrecuenciaCambioRopa();
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
    public function getTiempoEntreComidas()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTiempoEntreComidas', []);

        return parent::getTiempoEntreComidas();
    }

    /**
     * {@inheritDoc}
     */
    public function getHorasDuerme()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHorasDuerme', []);

        return parent::getHorasDuerme();
    }

    /**
     * {@inheritDoc}
     */
    public function getFrecuenciaEjercicio()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFrecuenciaEjercicio', []);

        return parent::getFrecuenciaEjercicio();
    }

    /**
     * {@inheritDoc}
     */
    public function getRegimenAlimenticio()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRegimenAlimenticio', []);

        return parent::getRegimenAlimenticio();
    }

    /**
     * {@inheritDoc}
     */
    public function getDescripcionRegimen()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDescripcionRegimen', []);

        return parent::getDescripcionRegimen();
    }

    /**
     * {@inheritDoc}
     */
    public function agregarDatosNoPatologicos($perioricidadBanio, $perioricidadHigieneBucal, $perioricidadLavaManos, $frecuenciaCambioRopa, $vecesComeDia, $tiempoEntreComidas, $regimenAlimenticio, $especifiqueRegimen, $horasDuerme, $frecuenciaEjercicio)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'agregarDatosNoPatologicos', [$perioricidadBanio, $perioricidadHigieneBucal, $perioricidadLavaManos, $frecuenciaCambioRopa, $vecesComeDia, $tiempoEntreComidas, $regimenAlimenticio, $especifiqueRegimen, $horasDuerme, $frecuenciaEjercicio]);

        return parent::agregarDatosNoPatologicos($perioricidadBanio, $perioricidadHigieneBucal, $perioricidadLavaManos, $frecuenciaCambioRopa, $vecesComeDia, $tiempoEntreComidas, $regimenAlimenticio, $especifiqueRegimen, $horasDuerme, $frecuenciaEjercicio);
    }

    /**
     * {@inheritDoc}
     */
    public function dadoDeAlta()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'dadoDeAlta', []);

        return parent::dadoDeAlta();
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

    /**
     * {@inheritDoc}
     */
    public function marcarComoSubsecuente()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'marcarComoSubsecuente', []);

        return parent::marcarComoSubsecuente();
    }

    /**
     * {@inheritDoc}
     */
    public function getExpediente()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getExpediente', []);

        return parent::getExpediente();
    }

}
