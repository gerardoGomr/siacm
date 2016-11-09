<div id="dvCobroConsulta" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Capturar cobro de consulta</h4>
                <button class="close" aria-hidden="true" data-dismiss="modal" type="button">x</button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => url('pacientes/consulta/cobrar'), 'id' => 'formCobro', 'class' => 'form-horizontal'])  !!}
                <div class="form-group">
                    <label class="control-label col-md-3">Forma de pago:</label>
                    <div class="col-md-9">
                        <div class="radio">
                            <label>
                                <input type="radio" name="formaPago" class="formaPago required" value="1"> Efectivo
                            </label>
                        </div>

                        <div class="radio">
                            <label>
                                <input type="radio" name="formaPago" class="formaPago required" value="2"> Tarjeta de crédito / débito
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Total a pagar:</label>
                    <div class="col-sm-9">
                        <p class="form-control-static" id="totalPagarTexto"></p>
                        <input type="hidden" id="totalPagar">
                    </div>
                </div>

                <div id="efectivo" class="hide">
                    <div class="form-group">
                        <label for="pago" class="control-label col-md-3">Pago:</label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                <input type="text" name="pago" id="pago" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cambio" class="control-label col-md-3">Cambio:</label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                <input type="text" name="cambio" id="cambio" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                        <input type="button" id="cobrarConsulta" class="btn btn-primary" value="Guardar&raquo;">
                        <input type="hidden" name="expedienteId" id="expedienteId">
                        <input type="hidden" name="consultaId" id="consultaId">
                    </div>
                </div>
                {!! Form::close() !!}
                <div class="separator border-bottom"></div>
                <div id="desgloseCosto">

                </div>
            </div>
        </div>
    </div>
</div>