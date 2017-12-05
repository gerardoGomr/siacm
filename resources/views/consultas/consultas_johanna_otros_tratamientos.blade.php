<div class="tab-pane" id="otrosTratamientosOdont">
    <?php $otroTratamiento = $expediente->getExpedienteEspecialidad()->obtenerOtroTratamientoActivo() ?>
    @if(!is_null($otroTratamiento))
        <div class="row">
            <div class="col-md-4">
                <dl class="dl-horizontal">
                    <dt>Tratamiento:</dt>
                    <dd>{{ $otroTratamiento->descripcionTratamientos() }}</dd>

                    <dt>DX:</dt>
                    <dd>{{ $otroTratamiento->getDX() }}</dd>

                    <dt>Duración:</dt>
                    <dd>{{ $otroTratamiento->getDuracion() }} años</dd>

                    <dt>Atendido:</dt>
                    <dd><span class="label {{ $otroTratamiento->atendido() ? 'label-success' : 'label-danger' }}">{{ $otroTratamiento->atendido() ? 'Atendido' : 'Activo' }}</span></dd>
                </dl>
            </div>

            <div class="col-md-6">
                @if(!$otroTratamiento->atendido())
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="otroTratamientoOdontologiaAtendido"> Marcar el tratamiento como atendido
                            </label>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @else
        <h3>No tiene otros tratamientos activos.</h3>
    @endif
</div>