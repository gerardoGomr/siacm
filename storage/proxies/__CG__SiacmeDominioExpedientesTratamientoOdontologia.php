<?php

namespace DoctrineProxies\__CG__\Siacme\Dominio\Expedientes;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class TratamientoOdontologia extends \Siacme\Dominio\Expedientes\TratamientoOdontologia implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'id', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'dx', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'observaciones', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'tx', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'costo', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'fechaInicio', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'fechaTermino', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'mensualidades', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'ortopedia', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'ortodoncia', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'atendido', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'saldo', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'expedienteEspecialidad', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'pagos', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'pagado'];
        }

        return ['__isInitialized__', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'id', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'dx', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'observaciones', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'tx', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'costo', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'fechaInicio', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'fechaTermino', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'mensualidades', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'ortopedia', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'ortodoncia', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'atendido', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'saldo', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'expedienteEspecialidad', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'pagos', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\TratamientoOdontologia' . "\0" . 'pagado'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (TratamientoOdontologia $proxy) {
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
    public function generarTratamientos($ortopedia, $ortodoncia)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'generarTratamientos', [$ortopedia, $ortodoncia]);

        return parent::generarTratamientos($ortopedia, $ortodoncia);
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
    public function getDx()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDx', []);

        return parent::getDx();
    }

    /**
     * {@inheritDoc}
     */
    public function getObservaciones()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getObservaciones', []);

        return parent::getObservaciones();
    }

    /**
     * {@inheritDoc}
     */
    public function getTx()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTx', []);

        return parent::getTx();
    }

    /**
     * {@inheritDoc}
     */
    public function getCosto()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCosto', []);

        return parent::getCosto();
    }

    /**
     * {@inheritDoc}
     */
    public function getDuracion()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDuracion', []);

        return parent::getDuracion();
    }

    /**
     * {@inheritDoc}
     */
    public function getFechaInicio(): \DateTime
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFechaInicio', []);

        return parent::getFechaInicio();
    }

    /**
     * {@inheritDoc}
     */
    public function getFechaTermino(): \DateTime
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFechaTermino', []);

        return parent::getFechaTermino();
    }

    /**
     * {@inheritDoc}
     */
    public function getMensualidades()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMensualidades', []);

        return parent::getMensualidades();
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
    public function getSaldo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSaldo', []);

        return parent::getSaldo();
    }

    /**
     * {@inheritDoc}
     */
    public function getPagos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPagos', []);

        return parent::getPagos();
    }

    /**
     * {@inheritDoc}
     */
    public function ortopedia()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'ortopedia', []);

        return parent::ortopedia();
    }

    /**
     * {@inheritDoc}
     */
    public function ortodoncia()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'ortodoncia', []);

        return parent::ortodoncia();
    }

    /**
     * {@inheritDoc}
     */
    public function atendido()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'atendido', []);

        return parent::atendido();
    }

    /**
     * {@inheritDoc}
     */
    public function pagado()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'pagado', []);

        return parent::pagado();
    }

    /**
     * {@inheritDoc}
     */
    public function descripcionTratamientos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'descripcionTratamientos', []);

        return parent::descripcionTratamientos();
    }

    /**
     * {@inheritDoc}
     */
    public function costo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'costo', []);

        return parent::costo();
    }

    /**
     * {@inheritDoc}
     */
    public function abonoMinimo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'abonoMinimo', []);

        return parent::abonoMinimo();
    }

    /**
     * {@inheritDoc}
     */
    public function estaPagado()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'estaPagado', []);

        return parent::estaPagado();
    }

    /**
     * {@inheritDoc}
     */
    public function obtenerSaldo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'obtenerSaldo', []);

        return parent::obtenerSaldo();
    }

    /**
     * {@inheritDoc}
     */
    public function saldoFormateado()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'saldoFormateado', []);

        return parent::saldoFormateado();
    }

    /**
     * {@inheritDoc}
     */
    public function registrarPago(\Siacme\Dominio\Cobros\Cobro $cobroTratamientoOdontologia)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'registrarPago', [$cobroTratamientoOdontologia]);

        return parent::registrarPago($cobroTratamientoOdontologia);
    }

    /**
     * {@inheritDoc}
     */
    public function finalizarAtencion()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'finalizarAtencion', []);

        return parent::finalizarAtencion();
    }

    /**
     * {@inheritDoc}
     */
    public function actualizar($dx, $observaciones, $tx, $costo, $fechaInicio, $fechaTermino, $mensualidades)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'actualizar', [$dx, $observaciones, $tx, $costo, $fechaInicio, $fechaTermino, $mensualidades]);

        return parent::actualizar($dx, $observaciones, $tx, $costo, $fechaInicio, $fechaTermino, $mensualidades);
    }

}
