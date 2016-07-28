<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class Fotografia
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
abstract class Fotografia
{
	/**
	 * ancho
	 * @var double
	 */
	protected $ancho;

	/**
	 * alto
	 * @var double
	 */
	protected $alto;

	/**
	 * peso en megabytes
	 * @var double
	 */
	protected $peso;

	/**
	 * nombre de la foto
	 * @var string
	 */
	protected $nombre;

	/**
	 * tipo de foto (mime-type)
	 * @var string
	 */
	protected $tipo;

	/**
	 * la ruta de la foto
	 * @var string
	 */
	protected $ruta;

	/**
	 * ruta temporal de la foto
	 * @var string
	 */
	protected $rutaTemporal;

	/**
	 * ruta a guardar la foto
	 * @var string
	 */
	protected $rutaAGuardar;

	/**
	 * indica si se ha subido o no
	 * @var bool
	 */
	protected $seHaSubido;

	/**
	 * indica si se subió con éxito
	 * @var bool
	 */
	protected $subioConExito;

	/**
	 * imagen origen, obtenida con GD
	 * @var resource
	 */
	protected $imgOrigen;

	/**
	 * imagen destino, obtenida con GD
	 * @var resource
	 */
	protected $imgDestino;

	/**
	 * Fotografia constructor.
	 * @param string $ruta
	 * @throws \Exception
	 */
	public function __construct($ruta)
	{
		if(!file_exists($ruta)) {
			throw new \Exception("No existe esta imagen.");

		}

		$this->ruta = $ruta;
		$this->obtenerPesoDeFoto();
	}

	public function obtenerPesoDeFoto()
	{
		$this->peso = filesize($this->ruta);
	}

    /**
     * Gets the ancho.
     *
     * @return double
     */
    public function getAncho()
    {
        return $this->ancho;
    }

    /**
     * Gets the alto.
     *
     * @return double
     */
    public function getAlto()
    {
        return $this->alto;
    }

    /**
     * Gets the peso en megabytes.
     *
     * @return double
     */
    public function getPeso()
    {
        return $this->peso;
    }

    /**
     * Gets the nombre de la foto.
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Gets the tipo de foto (mime-type).
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * devolver el dato completo del peso
     * @return string
     */
    public function peso()
    {
    	return (string)$this->peso.'MB';
    }

    /**
     * mover foto a carpeta temporal
     * @param  string $nombre
     * @return bool
     */
    abstract public function moverATemporal($nombre);

    /**
     * cambiar el tamaño de la imagen
     * @param  int $posX
     * @param  int $posY
     * @param  int $nuevoAncho
     * @param  int $nuevoAlto
     * @return bool
     */
    abstract public function cambiarTamanio($posX, $posY, $nuevoAncho, $nuevoAlto);

    /**
     * guardar en la carpeta real
     * @param  string $nombre
     * @return bool
     */
    abstract public function guardar($nombre);

    /**
     * Gets the la ruta de la foto.
     *
     * @return string
     */
    public function getRuta()
    {
        return $this->ruta;
    }
}