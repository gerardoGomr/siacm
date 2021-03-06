<?php
namespace Siacme\Dominio\Consultas;

use DateTime;
use Exception;
use Siacme\Aplicacion\ColeccionArray;
use Siacme\Dominio\Cobros\Cobro;
use Siacme\Dominio\Expedientes\ComportamientoFrankl;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Listas\IColeccion;
use Siacme\Dominio\Usuarios\Usuario;
use Siacme\Exceptions\CostoYaHaSidoAgregadoAConsultaException;

/**
 * Class Consulta
 * @package Siacme\Dominio\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class Consulta
{
    /**
     * @var int
     */
	private $id;

    /**
     * @var string
     */
    private $padecimientoActual;

    /**
     * @var string
     */
    private $interrogatorioAparatosSistemas;

    /**
     * @var ExploracionFisica
     */
    private $exploracionFisica;

    /**
     * @var string
     */
    private $notaMedica;

    /**
     * @var ComportamientoFrankl
     */
    private $comportamientoFrankl;

    /**
     * @var double
     */
    private $costo;

    /**
     * @var bool
     */
    private $pagada;

    /**
     * @var string
     */
    private $comentario;

    /**
     * los costos que se asignan al momento de atender
     * @var IColeccion
     */
    private $costos;

    /**
     * @var RecetaConsulta
     */
    private $receta;

    /**
     * @var Expediente
     */
    private $expediente;

    /**
     * @var ConsultaCosto
     */
    private $consultaCosto;

    /**
     * @var DateTime
     */
    private $fecha;

    /**
     * @var Usuario
     */
    private $medico;

    /**
     * los cobros que se hacen a esta consulta
     * 
     * @var IColeccion
     */
    private $cobrosConsulta;

    /**
     * @var string
     */
    private $otrosCostos;

    /**
     * @var string
     */
    private $aRealizarEnProximaCita;

    /**
     * @var HigieneDentalConsulta
     */
    private $higieneDentalConsulta;

    /**
     * @var IndicacionConsulta
     */
    private $indicacionConsulta;

    /**
     * @var ExploracionOtorrino
     */
    private $exploracionOtorrino;

    /**
     * @var string
     */
    private $duracionAproximada;

    /**
     * Consulta constructor.
     * @param string $padecimientoActual
     * @param string $interrogatorioAparatosSistemas
     * @param ExploracionFisica $exploracionFisica
     * @param string $notaMedica
     * @param ComportamientoFrankl $comportamientoFrankl
     * @param double $costo
     * @param DateTime $fecha
     * @param IColeccion $costos
     * @param Usuario $medico
     */
    public function __construct($padecimientoActual, $interrogatorioAparatosSistemas, ExploracionFisica $exploracionFisica, $notaMedica, $costo, $aRealizarEnProximaCita, DateTime $fecha, IColeccion $costos, Usuario $medico, IColeccion $cobrosConsulta, ComportamientoFrankl $comportamientoFrankl = null)
    {
        $this->padecimientoActual             = $padecimientoActual;
        $this->interrogatorioAparatosSistemas = $interrogatorioAparatosSistemas;
        $this->exploracionFisica              = $exploracionFisica;
        $this->notaMedica                     = $notaMedica;
        $this->comportamientoFrankl           = $comportamientoFrankl;
        $this->costo                          = $costo;
        $this->aRealizarEnProximaCita         = $aRealizarEnProximaCita;
        $this->fecha                          = $fecha;
        $this->costos                         = $costos;
        $this->medico                         = $medico;
        $this->pagada                         = false;
        $this->cobrosConsulta                 = $cobrosConsulta;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPadecimientoActual()
    {
        return $this->padecimientoActual;
    }

    /**
     * @return string
     */
    public function getInterrogatorioAparatosSistemas()
    {
        return $this->interrogatorioAparatosSistemas;
    }

    /**
     * @return ExploracionFisica
     */
    public function getExploracionFisica()
    {
        return $this->exploracionFisica;
    }

    /**
     * @return string
     */
    public function getNotaMedica()
    {
        return $this->notaMedica;
    }

    /**
     * @return ComportamientoFrankl
     */
    public function getComportamientoFrankl()
    {
        return $this->comportamientoFrankl;
    }

    /**
     * @return boolean
     */
    public function pagada()
    {
        return $this->pagada;
    }

    /**
     * @return string
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * @return float
     */
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * dar consulta de cortesia
     */
    public function cortesia()
    {
        $this->costo = 0;
    }

    /**
     * @return RecetaConsulta
     */
    public function getReceta()
    {
        return $this->receta;
    }

    /**
     * indica si tiene receta generada
     * @return bool
     */
    public function tieneReceta()
    {
        if (!is_null($this->receta)) {
            return true;
        }

        return false;
    }

    /**
     * @return Expediente
     */
    public function getExpediente()
    {
        return $this->expediente;
    }

    /**
     * @return ConsultaCosto
     */
    public function getConsultaCosto()
    {
        return $this->consultaCosto;
    }

    /**
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha->format('Y-m-d');
    }

    /**
     * @return Usuario
     */
    public function getMedico()
    {
        return $this->medico;
    }

    /**
     * @return HigieneDentalConsulta
     */
    public function getHigieneDentalConsulta()
    {
        return $this->higieneDentalConsulta;
    }

    /**
     * @return IndicacionConsulta
     */
    public function getIndicacionConsulta()
    {
        return $this->indicacionConsulta;
    }

    /**
     * agregar una receta
     * @param RecetaConsulta $receta
     */
    public function agregarReceta(RecetaConsulta $receta)
    {
        $this->receta = $receta;
    }

    /**
     * agrega una nueva higiene dental
     *
     * @param HigieneDentalConsulta $higieneDental
     */
    public function agregarHigieneDental(HigieneDentalConsulta $higieneDental)
    {
        $this->higieneDentalConsulta = $higieneDental;
    }

    /**
     * agregar nueva indicacion
     *
     * @param IndicacionConsulta $indicacion
     *
     * @return void
     */
    public function agregarIndicacionConsulta(IndicacionConsulta $indicacion)
    {
        $this->indicacionConsulta = $indicacion;
    }

    /**
     * generar la consulta para un expediente
     * @param Expediente $expediente
     */
    public function generadaPara(Expediente $expediente)
    {
        $this->expediente = $expediente;
    }

    /**
     * agregar un costo a la consulta
     * @param ConsultaCosto $consultaCosto
     * @throws CostoYaHaSidoAgregadoAConsultaException
     */
    public function agregarCosto(ConsultaCosto $consultaCosto)
    {
        if ($this->costos->count() > 0) {
            foreach ($this->costos as $costo) {
                if ($costo->getId() === $consultaCosto) {
                    throw new CostoYaHaSidoAgregadoAConsultaException('Este costo ya fue asignado a la consulta actual.');
                }
            }
        }

        $this->costos->add($consultaCosto);
    }

    /**
     * devuelve el costo real de la consulta
     * @return float
     */
    public function costoReal()
    {
        $costoReal = 0.0;
        foreach ($this->costos as $costo) {
            $costoReal += $costo->getCosto();
        }

        return $costoReal;
    }

    /**
     * obtener el desglose del costo
     * @return string
     */
    public function desgloseCosto()
    {
        $desglose = '';
        foreach ($this->costos as $costo) {
            $desglose .= $costo->getConcepto() . ':  ' . $costo->costo() . "\n\r";
        }

        if (strlen($this->otrosCostos) > 0) {
            $desglose .= $this->otrosCostos;
        }

        return nl2br($desglose);
    }

    /**
     * se agrega un comentario a la consulta
     * @param string $comentario
     */
    public function agregarComentario($comentario = '')
    {
        $comentarioAAgregar = '';

        if (strlen($comentario)) {
            $comentarioAAgregar .= $comentario . "\n\n";
        }

        $costo = $this->costoReal();
        if ($this->costo < $costo) {
            $comentarioAAgregar .= 'Se cobró menos del costo real, el cual es: $' . (string)number_format($costo, 2);
        }

        $this->comentario = $comentarioAAgregar;
    }

    /**
     * registrar el pago de la consulta mediante Cobro
     * 
     * @param Cobro $cobroConsulta
     * @throws Exception
     */
    public function registrarPago(Cobro $cobroConsulta)
    {
        try {
            if (is_null($this->cobrosConsulta)) {
                $this->cobrosConsulta = new ColeccionArray;
            }

            $cobroConsulta->registrarPago();
            $this->cobrosConsulta->add($cobroConsulta);
            
            if ($this->obtenerSaldo() === 0.0) {
                $this->pagada = true;
            }

        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * costo formateado
     * @return string
     */
    public function costoFormateado()
    {
        return '$' . number_format($this->costo, 2);
    }

    /**
     * costo formateado
     * @return string
     */
    public function costoRealFormateado()
    {
        return '$' . number_format($this->costoReal(), 2);
    }

    /**
     * @return IColeccion
     */
    public function getCobrosConsulta()
    {
        return $this->cobrosConsulta;
    }

    /**
     * @return IColeccion
     */
    public function getCostos()
    {
        return $this->costos;
    }

    /**
     * se agrega descripción de otros costos
     * @param string $otroCosto
     */
    public function agregarOtrosCostos($otroCosto)
    {
        $this->otrosCostos .= $otroCosto;
    }

    /**
     * @return string
     */
    public function getOtrosCostos()
    {
        return nl2br($this->otrosCostos);
    }

    /**
     * @return string
     */
    public function getARealizarEnProximaCita()
    {
        return $this->aRealizarEnProximaCita;
    }

    /**
     * calcula el saldo de la consulta
     * 
     * @return float
     */
    public function obtenerSaldo()
    {
        $saldo = $this->costo;

        foreach ($this->cobrosConsulta as $pago) {
            $saldo -= $pago->getAbono();
        }

        return $saldo;
    }

    /**
     * obtiene el abono mínimo a realizar
     * 
     * @return float
     */
    public function abonoMinimo()
    {
        if (!is_null($this->cobrosConsulta) && $this->cobrosConsulta->count() > 0) {
            return $this->obtenerSaldo();
        }

        return $this->costo;
    }

    /**
     * Revisa si tiene asignada una indicación de higiene dental
     *
     * @return bool
     */
    public function tieneHigieneDental()
    {
        return !is_null($this->higieneDentalConsulta);
    }

    /**
     * Revisa si tiene asignada una indicación
     *
     * @return bool
     */
    public function tieneIndicacion()
    {
        return !is_null($this->indicacionConsulta);
    }

    /**
     * Agrega la exploración por otorrino
     */
    public function addExploracionOtorrino(ExploracionOtorrino $exploracion)
    {
        $this->exploracionOtorrino = $exploracion;
    }

    public function agregarDuracion($duracion)
    {
        if (!\is_numeric($duracion)) {
            throw new Exception("La duración debe ser un dato numérico");
        }

        $this->duracionAproximada = $duracion;
    }

    public function getDuracionAproximada()
    {
        return $this->duracionAproximada;
    }
}
