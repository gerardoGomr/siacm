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
                    <label class="control-label">Médico:</label>
                    <select name="medico" id="medico" class="form-control">
                        <option value="">Seleccione</option>
                        @foreach($listaMedicos as $medicoReferencia)
                            <option value="{{ $medicoReferencia->getId() }}">{{ $medicoReferencia->getNombreCompleto() }} - {{ $medicoReferencia->getEspecialidad()->getEspecialidad() }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Referencia:</label>
                    <textarea name="txtReferencia" id="txtReferencia" class="form-control" rows="15"></textarea>
                </div>
                <div class="form-group">
                    <a href="{{ url('consultas/capturar/interconsulta') }}" class="btn btn-success" id="btnGuardarInterconsulta"><i class="fa fa-check"></i> Aceptar</a>
                    <a href="{{ url('consultas/interconsulta/' . base64_encode($expediente->getMedico()->getUsername()) . '/' . base64_encode($expediente->getPaciente()->getId())) }}" class="btn btn-primary" id="generarInterconsulta" target="_blank" disabled="disabled"><i class="fa fa-print"></i> Generar</a>
                </div>
            </div>
        </div>
    </div>
</div>