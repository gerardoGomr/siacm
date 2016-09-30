<!-- crear la estructura html para la selección de un médico para interconsultas -->
<div id="dvInterconsulta" class="modal fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Envío a interconsulta</h4>
                <button class="close" aria-hidden="true" data-dismiss="modal" type="button">X</button>
            </div>
            <div class="modal-body" style="max-height: 500px; overflow-y: scroll;">
                <div class="form-group">
                    <label for="medico" class="control-label">Médico:</label>
                    <select name="medico" id="medico" class="form-control">
                        <option value="">Seleccione</option>
                        @foreach($medicosReferencia as $medicoReferencia)
                            <option value="{{ $medicoReferencia->getId() }}">{{ $medicoReferencia->nombreCompleto() }} - {{ $medicoReferencia->getEspecialidad()->getEspecialidad() }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="referencia" class="control-label">Referencia:</label>
                    <textarea name="referencia" id="referencia" class="form-control" rows="15"></textarea>
                </div>
                <div class="form-group">
                    <a href="{{ url('consultas/interconsulta/agregar') }}" class="btn btn-success" id="btnGuardarInterconsulta"><i class="fa fa-check"></i> Aceptar y asignar a consulta</a>
                    <a href="{{ url('consultas/interconsulta/' . base64_encode($expediente->getPaciente()->getId()) . '/' . base64_encode($medico->getId())) }}" class="btn btn-primary" id="generarInterconsulta" target="_blank" disabled="disabled"><i class="fa fa-print"></i> Generar en PDF</a>
                </div>
            </div>
        </div>
    </div>
</div>