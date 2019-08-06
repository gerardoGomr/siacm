<div id="dvPlanCirugia" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 800px;">
            <div class="modal-header">
                <h4 class="modal-title">Cotización Plan Cirugía</h4>
                <button class="close" aria-hidden="true" data-dismiss="modal" type="button">x</button>
            </div>
            <div class="modal-body">
                <form action="{{ url('pacientes/cirugias/agregar') }}" id="formPlanCirugia" class="form-horizontal required">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="dx" class="control-label col-md-3">Cirugía planeada:</label>
                        <div class="col-md-6">
                            <select name="cirugiaId" id="cirugiaId" class="form-control">
                                <option value="">Seleccione</option>
                                @foreach($cirugias as $cirugia)
                                    <option value="{{ $cirugia->id }}">{{ $cirugia->Nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="honorarios" class="control-label col-md-3">Honorarios médicos:</label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="number" name="honorarios" id="honorarios" class="form-control required">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="equipoAdicional" class="control-label col-md-3">Equipo adicional:</label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="number" name="equipoAdicional" id="equipoAdicional" class="form-control required">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="hospitalSugerido" class="control-label col-md-3">Hospital sugerido:</label>
                        <div class="col-md-9">
                            <input type="text" name="hospitalSugerido" id="hospitalSugerido" class="form-control required" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="diasHospitalizacion" class="control-label col-md-3">Días de hospitalización:</label>
                        <div class="col-md-3">
                            <input type="number" name="diasHospitalizacion" id="diasHospitalizacion" class="form-control required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="montoHospitalizacion" class="control-label col-md-3">Monto Hospitalización:</label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="number" name="montoHospitalizacion" id="montoHospitalizacion" class="form-control required">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <button type="button" id="guardarFormPlanCirugia" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                            <input type="hidden" name="expedienteId" value="">
                            <input type="hidden" name="medicoId" value="">
                            <input type="hidden" name="planCirugiaId" id="planCirugiaId">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>