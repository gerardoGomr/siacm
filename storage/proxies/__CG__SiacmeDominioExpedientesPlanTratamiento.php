<?php

namespace DoctrineProxies\__CG__\Siacme\Dominio\Expedientes;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class PlanTratamiento extends \Siacme\Dominio\Expedientes\PlanTratamiento implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\PlanTratamiento' . "\0" . 'id', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\PlanTratamiento' . "\0" . 'atendido', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\PlanTratamiento' . "\0" . 'costo', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\PlanTratamiento' . "\0" . 'dientes', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\PlanTratamiento' . "\0" . 'aQuienSeDirige', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\PlanTratamiento' . "\0" . 'otrosTratamientos'];
        }

        return ['__isInitialized__', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\PlanTratamiento' . "\0" . 'id', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\PlanTratamiento' . "\0" . 'atendido', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\PlanTratamiento' . "\0" . 'costo', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\PlanTratamiento' . "\0" . 'dientes', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\PlanTratamiento' . "\0" . 'aQuienSeDirige', '' . "\0" . 'Siacme\\Dominio\\Expedientes\\PlanTratamiento' . "\0" . 'otrosTratamientos'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (PlanTratamiento $proxy) {
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
    public function costo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'costo', []);

        return parent::costo();
    }

    /**
     * {@inheritDoc}
     */
    public function tieneOtrosTratamientos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'tieneOtrosTratamientos', []);

        return parent::tieneOtrosTratamientos();
    }

    /**
     * {@inheritDoc}
     */
    public function estaAtendido()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'estaAtendido', []);

        return parent::estaAtendido();
    }

    /**
     * {@inheritDoc}
     */
    public function generarDeOdontograma(\Siacme\Dominio\Expedientes\Odontograma $odontograma)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'generarDeOdontograma', [$odontograma]);

        return parent::generarDeOdontograma($odontograma);
    }

    /**
     * {@inheritDoc}
     */
    public function getDientes()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDientes', []);

        return parent::getDientes();
    }

    /**
     * {@inheritDoc}
     */
    public function diente($numero)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'diente', [$numero]);

        return parent::diente($numero);
    }

    /**
     * {@inheritDoc}
     */
    public function getOtrosTratamientos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOtrosTratamientos', []);

        return parent::getOtrosTratamientos();
    }

    /**
     * {@inheritDoc}
     */
    public function agregarOtroTratamiento(\Siacme\Dominio\Expedientes\OtroTratamiento $tratamiento)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'agregarOtroTratamiento', [$tratamiento]);

        return parent::agregarOtroTratamiento($tratamiento);
    }

    /**
     * {@inheritDoc}
     */
    public function quitarOtroTratamiento(\Siacme\Dominio\Expedientes\OtroTratamiento $tratamiento)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'quitarOtroTratamiento', [$tratamiento]);

        return parent::quitarOtroTratamiento($tratamiento);
    }

    /**
     * {@inheritDoc}
     */
    public function removerOtrosTratamientos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removerOtrosTratamientos', []);

        return parent::removerOtrosTratamientos();
    }

    /**
     * {@inheritDoc}
     */
    public function otroTratamiento($indice)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'otroTratamiento', [$indice]);

        return parent::otroTratamiento($indice);
    }

    /**
     * {@inheritDoc}
     */
    public function agregarTratamiento($numeroDiente, \Siacme\Dominio\Expedientes\DientePlan $dientePlan)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'agregarTratamiento', [$numeroDiente, $dientePlan]);

        return parent::agregarTratamiento($numeroDiente, $dientePlan);
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
    public function eliminarTratamiento($numeroDiente, \Siacme\Dominio\Expedientes\DienteTratamiento $dienteTratamiento)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'eliminarTratamiento', [$numeroDiente, $dienteTratamiento]);

        return parent::eliminarTratamiento($numeroDiente, $dienteTratamiento);
    }

    /**
     * {@inheritDoc}
     */
    public function todosLosDientesTienenTratamientos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'todosLosDientesTienenTratamientos', []);

        return parent::todosLosDientesTienenTratamientos();
    }

    /**
     * {@inheritDoc}
     */
    public function atender()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'atender', []);

        return parent::atender();
    }

    /**
     * {@inheritDoc}
     */
    public function getAQuienSeDirige()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAQuienSeDirige', []);

        return parent::getAQuienSeDirige();
    }

}