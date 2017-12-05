<!-- crear la estructura html para la selección de un médico para interconsultas -->
<div id="dvIndicacion" class="modal fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Indicaciones dentales</h4>
                <button class="close" aria-hidden="true" data-dismiss="modal" type="button">X</button>
            </div>
            <div class="modal-body" style="max-height: 500px; overflow-y: scroll;">
                <div class="form-group">
                    <label for="indicacion" class="control-label">Nombre:</label>
                    <select name="indicacionId" id="indicacionId" class="form-control">
                        <option value="">Seleccione</option>
                        @foreach($indicaciones as $indicacion)
                            <option value="{{ $indicacion->getId() }}">{{ $indicacion->getNombre() }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="indicacionCuerpo" class="control-label">Indicacion:</label>
                    <textarea name="indicacionCuerpo" id="indicacionCuerpo" class="form-control" rows="15"></textarea>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-success" id="btnGuardarIndicacion"><i class="fa fa-check"></i> Aceptar y asignar a consulta</button>
                    <a href="{{ url('consultas/indicacion/' . base64_encode($expediente->getPaciente()->getId()) . '/' . base64_encode($medico->getId())) }}" class="btn btn-primary" id="generarIndicacion" target="_blank" disabled="disabled"><i class="fa fa-print"></i> Generar en PDF</a>

                    @foreach($indicaciones as $indicacion)
                        <input type="hidden" name="indicacion_{{ $indicacion->getId() }}" value="{{ base64_encode(utf8_decode($indicacion->getCuerpo())) }}">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>