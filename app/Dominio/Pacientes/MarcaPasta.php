<?php
namespace Siacme\Dominio\Pacientes;

/**
* @author Gerardo Adrián Gómez Ruiz
*/
class MarcaPasta
{
	/**
	 * el id de la marca
	 * @var int
	 */
	private $id;

	/**
	 * la marca
	 * @var string
	 */
	private $marcaPasta;

    /**
     * MarcaPasta constructor.
     * @param int    $id
     * @param string $marcaPasta
     */
    public function __construct($id = null, $marcaPasta = null)
    {
        $this->id         = $id;
        $this->marcaPasta = $marcaPasta;
    }


    /**
     * Gets the el id de la marca.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the el id de la marca.
     *
     * @param int $id the id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Gets the la marca.
     *
     * @return string
     */
    public function getMarcaPasta()
    {
        return $this->marcaPasta;
    }

    /**
     * Sets the la marca.
     *
     * @param string $marcaPasta the marca pasta
     */
    public function setMarcaPasta($marcaPasta)
    {
        $this->marcaPasta = $marcaPasta;
    }
}