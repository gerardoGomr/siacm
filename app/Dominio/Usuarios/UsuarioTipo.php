<?php
namespace Siacme\Dominio\Usuarios;

/**
 * Class UsuarioTipo
 * @package Siacme\Dominio\Usuarios
 * @author  Gerardo Adrián Gómez Ruiz
 */
class UsuarioTipo
{
    /**
     * @var int
     */
	private $id;

    /**
     * @var string
     */
    private $usuarioTipo;

    /**
     * UsuarioTipo constructor.
     * @param null $id
     * @param null $usuarioTipo
     */
    public function __construct($id = null, $usuarioTipo = null)
    {
        $this->id          = $id;
        $this->usuarioTipo = $usuarioTipo;
    }

    public function getId()
    {
    	return $this->id;
    }

    public function getUsuarioTipo()
    {
    	return $this->usuarioTipo;
    }

    public function setId($id)
    {
    	$this->id = $id;
    }

    public function setUsuarioTipo($usuarioTipo)
    {
    	$this->usuarioTipo = $usuarioTipo;
    }
}
