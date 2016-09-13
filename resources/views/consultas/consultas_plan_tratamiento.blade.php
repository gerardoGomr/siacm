<div id="planDeTratamiento" class="modal fade" aria-hidden="true">
    <div class="modal-dialog" style="width: 900px; height: 600px; overflow: auto">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Plan de tratamiento</h4>
                <button class="close" aria-hidden="true" data-dismiss="modal" type="button">X</button>
            </div>
            <div class="modal-body">
                <button type="button" id="btnAceptar" class="btn btn-success"><i class="fa fa-check"></i> Aceptar</button>
                <a href="" id="generarPlan" class="btn btn-success" disabled="disabled" target="_blank"><i class="fa fa-print"></i> Generar PDF</a>
                <div class="separator"></div>
                <div class="form-group">
                    <label class="control-label">Otros tratamientos:</label>
                    <div class="input-group">
                        <select name="otrosTratamientos" id="otrosTratamientos" class="form-control">
                            <option value="">Seleccione</option>
                            @foreach($otrosTratamientos as $otroTratamiento)
                                <option value="{{ $otroTratamiento->getId() }}">{{ $otroTratamiento->getTratamiento() }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-btn">
                            <a href="{{ url('consultas/plan/tratamientos/otros/agregar') }}" class="btn btn-primary btn-small" id="btnAgregarOtroTratamiento"><i class="fa fa-plus"></i> Agregar a plan</a>
                        </div>
                    </div>
                </div>
                <div class="innerAll" id="dvPlanTratamiento">

                </div>
                <input type="hidden" id="urlAgregarTratamientos" value="{{ url('consultas/plan/tratamientos/agregar') }}">
            </div>
        </div>
    </div>
</div>