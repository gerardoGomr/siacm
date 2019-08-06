<?php
namespace Siacme\Aplicacion\Servicios\Expedientes;

use Siacme\Dominio\Expedientes\Anexo;
use Siacme\Exceptions\GuardarArchivoEnDirectorioException;

/**
 * Class AnexosUploader
 * @package Siacme\Servicios\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version  1.0
 */
class AnexosUploader
{
    /**
     * @var string
     */
    private $rutaBase;

    /**
     * @var string
     */
    private $rutaAnterior;

    /**
     * @var int
     */
    private $expedienteId;
    
    /**
     * @var int
     */
    private $medicoId;

    /**
     * AnexosUploader constructor.
     * @param string $expedienteId
     * @param string $medicoId
     */
    public function __construct($expedienteId, $medicoId)
    {
        $this->rutaBase     = storage_path() . '/app/public/pacientes/' . $expedienteId . '_' . $medicoId . '/';
        $this->rutaAnterior = storage_path() . '/app/public/pacientes/' . $expedienteId . '/';
        $this->expedienteId = (int)$expedienteId;
        $this->medicoId     = (int)$medicoId;
    }

    /**
     * guardar el anexo en el directorio especificado
     * @param string $ubicacionTemporal
     * @param Anexo $anexo
     * @throws GuardarArchivoEnDirectorioException
     */
    public function guardar($ubicacionTemporal, Anexo $anexo)
    {
        $nombre = $anexo->preparar();
        if (!file_exists($this->rutaBase)) {
            mkdir($this->rutaBase, 0777, true);
        }

        if (!move_uploaded_file($ubicacionTemporal, $this->rutaBase . $nombre . '.pdf')) {
            throw new GuardarArchivoEnDirectorioException('Imposible guardar el anexo en el directorio \"' . $this->rutaBase . '\"');
        }
    }

    /**
     * obtener los anexos guardados en el directorio estipulado
     * @return array
     */
    public function asignar()
    {
        $this->verificarRutaAnterior();

        if (!file_exists($this->rutaBase)) {
            return null;
        }

        $archivos = scandir($this->rutaBase);

        if ($archivos === false) {
            return null;
        }

        $archivosReales = [];

        foreach ($archivos as $indice => $valor) {
            if ($valor !== '.' && $valor !== '..') {
                $archivosReales[] = $valor;
            }
        }

        return $archivosReales;
    }

    /**
     * eliminar un anexo de directorio
     * @param Anexo $anexo
     * @return bool
     */
    public function eliminar(Anexo $anexo)
    {
        return unlink($this->rutaBase . $anexo->nombre());
    }

    /**
     * @return string
     */
    public function rutaBase()
    {
        return $this->rutaBase;
    }

    /**
     * Actualiza el nombre de un archivo en su ruta base
     */
    public function actualizar($old, $new)
    {
        rename($this->rutaBase . str_replace(' ', '_', $old), $this->rutaBase . str_replace(' ', '_', $new));
    }

    /**
     * verifica que la ruta anterior exista y tenga archivos
     */
    private function verificarRutaAnterior()
    {
        if (\Siacme\Dominio\Usuarios\Usuario::JOHANNA !== $this->medicoId)
            return null;

        if (!file_exists($this->rutaAnterior)) {
            return null;
        }

        $archivos = scandir($this->rutaAnterior);
        
        rename(substr($this->rutaAnterior, 0, -1), substr($this->rutaBase, 0, -1));

        if ($archivos !== false) {
            $this->saveAnexos($archivos);
        }
    }

    /**
     * Guarda los anexos de la ruta anterior al nuevo destino
     */
    private function saveAnexos($archivos)
    {
        foreach ($archivos as $indice => $valor) {
            if ($valor !== '.' && $valor !== '..') {
                \Siacme\Anexo::create([
                    'Nombre'         => str_replace('_', ' ', substr($valor, 0, -4)),
                    'FechaDocumento' => (new \DateTime())->format('Y-m-d'),
                    'CategoriaId'    => 4,
                    'UsuarioId'      => $this->medicoId,
                    'ExpedienteId'   => $this->expedienteId
                ]);
            }
        }
    }
}
