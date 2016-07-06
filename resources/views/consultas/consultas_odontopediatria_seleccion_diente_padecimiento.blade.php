<!-- crear la estructura html para la selección de un padecimiento del diente seleccionado -->
<div id="dvPadecimientosDentales" class="modal fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Padecimientos dentales</h4>
                <button class="close" aria-hidden="true" data-dismiss="modal" type="button">X</button>
            </div>
            <div class="modal-body" style="max-height: 500px; overflow-y: scroll;">
                <div class="form-group">
                    <a href="{{ url('consultas/capturar/diente/padecimiento') }}" class="btn btn-success" id="btnGuardarPadecimientoDental"><i class="fa fa-check"></i> Aceptar</a>
                    <input type="hidden" name="diente" id="diente" value="">
                </div>
                <div class="form-group">
                    @foreach($listaPadecimientos as $dientePadecimiento)
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="padecimiento" name="padecimiento[]" value="{{ $dientePadecimiento->getId() }}"> {{ $dientePadecimiento->getNombre() }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>