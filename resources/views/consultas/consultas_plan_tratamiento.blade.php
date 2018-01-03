<div id="planDeTratamiento" class="modal fade" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" style="width: 900px; height: 600px; overflow: auto">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Plan de tratamiento</h4>
            </div>
            <div class="modal-body">
                <button type="button" id="btnAceptar" class="btn btn-success"><i class="fa fa-check"></i> Aceptar</button>
                <a href="{{ url('consultas/plan/pdf/' . base64_encode($paciente->getId())) }}" id="generarPlan" class="btn btn-success" target="_blank"><i class="fa fa-print"></i> Generar PDF</a>
                <div class="separator"></div>
                <div class="form-group">
                    <label for="" class="control-label">Dirigido a:</label>
                    <input type="text" name="dirigidoA" id="dirigidoA" class="form-control required">
                </div>
                <div class="form-group">
                    <label for="otrosTratamientos" class="control-label">Otros tratamientos:</label>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="input-group">
                                <select name="otrosTratamientos" id="otrosTratamientos" class="form-control">
                                    <option value="">Seleccione</option>
                                    @foreach($otrosTratamientos as $otroTratamiento)
                                        <option value="{{ $otroTratamiento->getId() }}">{{ $otroTratamiento->getTratamiento() }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-btn">
                                    <button type="button" data-url="{{ url('consultas/plan/tratamientos/otros/agregar') }}" class="btn btn-primary btn-small" id="btnAgregarOtroTratamiento"><i class="fa fa-plus"></i> Agregar a plan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="innerAll" id="dvPlanTratamiento">

                </div>
                <input type="hidden" id="urlEliminarOtroTratamiento" value="{{ url('consultas/plan/tratamientos/otros/eliminar') }}">
                <input type="hidden" id="urlAgregarTratamiento" value="{{ url('consultas/plan/tratamientos/agregar') }}">
                <input type="hidden" id="urlEliminarTratamiento" value="{{ url('consultas/plan/tratamientos/eliminar') }}">
            </div>
        </div>
    </div>
</div>