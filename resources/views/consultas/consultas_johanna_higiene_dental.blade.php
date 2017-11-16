<!-- crear la estructura html para la selección de un médico para interconsultas -->
<div id="dvHigieneDental" class="modal fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Indicaciones dentales</h4>
                <button class="close" aria-hidden="true" data-dismiss="modal" type="button">X</button>
            </div>
            <div class="modal-body" style="max-height: 500px; overflow-y: scroll;">
                <div class="form-group">
                    <label for="indicacion" class="control-label">Nombre:</label>
                    <select name="indicacion" id="indicacion" class="form-control">
                        <option value="">Seleccione</option>
                        @foreach($higieneDentalIndicaciones as $higieneDental)
                            <option value="{{ $higieneDental->getId() }}">{{ $higieneDental->getNombre() }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="indicacionDental" class="control-label">Referencia:</label>
                    <textarea name="indicacionDental" id="indicacionDental" class="form-control" rows="15"></textarea>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-success" id="btnGuardarHigieneDental"><i class="fa fa-check"></i> Aceptar y asignar a consulta</button>
                    <a href="{{ url('consultas/higiene/' . base64_encode($expediente->getPaciente()->getId()) . '/' . base64_encode($medico->getId())) }}" class="btn btn-primary" id="generarHigieneDental" target="_blank" disabled="disabled"><i class="fa fa-print"></i> Generar en PDF</a>

                    @foreach($higieneDentalIndicaciones as $higieneDental)
                        <input type="hidden" name="higieneDental_{{ $higieneDental->getId() }}" value="{{ base64_encode(utf8_decode($higieneDental->getIndicaciones())) }}">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>