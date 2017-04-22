<?php

namespace DoctrineProxies\__CG__\Siacme\Dominio\Citas;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Cita extends \Siacme\Dominio\Citas\Cita implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'Siacme\\Dominio\\Citas\\Cita' . "\0" . 'id', '' . "\0" . 'Siacme\\Dominio\\Citas\\Cita' . "\0" . 'fecha', '' . "\0" . 'Siacme\\Dominio\\Citas\\Cita' . "\0" . 'hora', '' . "\0" . 'Siacme\\Dominio\\Citas\\Cita' . "\0" . 'medico', '' . "\0" . 'Siacme\\Dominio\\Citas\\Cita' . "\0" . 'estatus', '' . "\0" . 'Siacme\\Dominio\\Citas\\Cita' . "\0" . 'paciente', '' . "\0" . 'Siacme\\Dominio\\Citas\\Cita' . "\0" . 'comentario'];
        }

        return ['__isInitialized__', '' . "\0" . 'Siacme\\Dominio\\Citas\\Cita' . "\0" . 'id', '' . "\0" . 'Siacme\\Dominio\\Citas\\Cita' . "\0" . 'fecha', '' . "\0" . 'Siacme\\Dominio\\Citas\\Cita' . "\0" . 'hora', '' . "\0" . 'Siacme\\Dominio\\Citas\\Cita' . "\0" . 'medico', '' . "\0" . 'Siacme\\Dominio\\Citas\\Cita' . "\0" . 'estatus', '' . "\0" . 'Siacme\\Dominio\\Citas\\Cita' . "\0" . 'paciente', '' . "\0" . 'Siacme\\Dominio\\Citas\\Cita' . "\0" . 'comentario'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Cita $proxy) {
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
    public function getFecha()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFecha', []);

        return parent::getFecha();
    }

    /**
     * {@inheritDoc}
     */
    public function getHora()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHora', []);

        return parent::getHora();
    }

    /**
     * {@inheritDoc}
     */
    public function getMedico()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMedico', []);

        return parent::getMedico();
    }

    /**
     * {@inheritDoc}
     */
    public function getEstatus()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEstatus', []);

        return parent::getEstatus();
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
    public function getComentario()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getComentario', []);

        return parent::getComentario();
    }

    /**
     * {@inheritDoc}
     */
    public function getFinCita()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFinCita', []);

        return parent::getFinCita();
    }

    /**
     * {@inheritDoc}
     */
    public function atendida()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'atendida', []);

        return parent::atendida();
    }

    /**
     * {@inheritDoc}
     */
    public function estatus()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'estatus', []);

        return parent::estatus();
    }

    /**
     * {@inheritDoc}
     */
    public function agendar($fecha, $hora, \Siacme\Dominio\Pacientes\Paciente $paciente, \Siacme\Dominio\Usuarios\Usuario $medico)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'agendar', [$fecha, $hora, $paciente, $medico]);

        return parent::agendar($fecha, $hora, $paciente, $medico);
    }

    /**
     * {@inheritDoc}
     */
    public function confirmar()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'confirmar', []);

        return parent::confirmar();
    }

    /**
     * {@inheritDoc}
     */
    public function cancelar()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'cancelar', []);

        return parent::cancelar();
    }

    /**
     * {@inheritDoc}
     */
    public function enEsperaDeConsulta()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'enEsperaDeConsulta', []);

        return parent::enEsperaDeConsulta();
    }

    /**
     * {@inheritDoc}
     */
    public function registrarEstatus($accion)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'registrarEstatus', [$accion]);

        return parent::registrarEstatus($accion);
    }

    /**
     * {@inheritDoc}
     */
    public function reprogramar($fecha, $hora)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'reprogramar', [$fecha, $hora]);

        return parent::reprogramar($fecha, $hora);
    }

    /**
     * {@inheritDoc}
     */
    public function getColor()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getColor', []);

        return parent::getColor();
    }

    /**
     * {@inheritDoc}
     */
    public function atender()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'atender', []);

        return parent::atender();
    }

}
