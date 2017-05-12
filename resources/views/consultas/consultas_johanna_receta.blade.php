<!-- crear la estructura html para la selección de una receta de Johanna -->
<div id="dvRecetas" class="modal fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Receta médica</h4>
                <button class="close" aria-hidden="true" data-dismiss="modal" type="button">X</button>
            </div>
            <div class="modal-body" style="max-height: 500px; overflow-y: scroll;">
                <div class="form-group">
                    <label for="receta" class="control-label">Nombre:</label>
                    <select name="receta" id="receta" class="form-control">
                        <option value="">Seleccione</option>
                        @foreach($recetas as $receta)
                            <option value="{{ $receta->getId() }}">{{ $receta->getNombre() }}</option>
                        @endforeach
                    </select>
                </div>
                @if($expediente->esAlergico())
                    <div class="form-group">
                        <p class="form-control-static text-danger">Es alérgico a {{ $expediente->getAQueMedicamentoEsAlergico() }}</p>
                    </div>
                @endif
                <div class="form-group">
                    <label for="cuerpoReceta" class="control-label">Descripción:</label>
                    <textarea name="cuerpoReceta" id="cuerpoReceta" class="form-control" rows="15"></textarea>
                </div>
                <div class="form-group">
                    <a href="{{ url('consultas/receta/agregar') }}" class="btn btn-success" id="btnGuardarReceta"><i class="fa fa-check"></i> Anexar receta a consulta</a>
                    <a href="{{ url('consultas/receta/' . base64_encode($expediente->getPaciente()->getId()) . '/' . base64_encode($medico->getId())) }}" class="btn btn-primary" id="generarReceta" target="_blank" disabled="disabled"><i class="fa fa-print"></i> Generar en PDF</a>
                    <input type="hidden" name="diente" id="diente" value="">

                    @foreach($recetas as $receta)
                        <input type="hidden" name="receta{{ $receta->getId() }}" value="{{ base64_encode(utf8_decode($receta->getReceta())) }}">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>