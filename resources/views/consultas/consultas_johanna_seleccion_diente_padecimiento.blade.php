<!-- crear la estructura html para la selección de un padecimiento del diente seleccionado -->
<div id="dvPadecimientosDentales" class="modal fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Padecimientos dentales</h4>
                <button class="close" aria-hidden="true" data-dismiss="modal" type="button">X</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <button type="button" data-url="{{ route('asignar-diente-padecimiento') }}" class="btn btn-success" id="btnGuardarPadecimientoDental">Asignar padecimientos al diente</button>
                    <input type="hidden" name="diente" id="diente" value="">
                </div>
                <div class="form-group">
                    <?php
                    $i = 1;
                    ?>
                    <div class="row">
                    <div class="col-md-6">
                    @foreach($dientePadecimientos as $dientePadecimiento)
                        @if($i === 22)
                            </div>
                            <div class="col-md-6">
                        @endif
                                
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="padecimiento" name="padecimiento[]" value="{{ $dientePadecimiento->getId() }}"> {{ $dientePadecimiento->getNombre() }}
                            </label>
                        </div>
                        <?php
                        $i++;
                        ?>
                    @endforeach
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>