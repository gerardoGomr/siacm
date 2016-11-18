<div id="dvOtroTratamiento" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Capturar tratamiento</h4>
                <button class="close" aria-hidden="true" data-dismiss="modal" type="button">x</button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => url('pacientes/tratamiento/otros/agregar'), 'id' => 'formOtroTratamiento', 'class' => 'form-horizontal'])  !!}
                <div class="form-group">
                    <label class="control-label col-md-3">Tratamiento:</label>
                    <div class="col-md-9">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="ortodoncia" id="ortodoncia"> Ortodoncia
                            </label>
                        </div>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="ortopedia" id="ortopedia"> Ortopedia
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3">DX:</label>
                    <div class="col-md-9">
                        <input type="text" name="dx" id="dx" class="form-control required">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3">Costo:</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input type="text" name="costo" id="costo" class="form-control required numeros">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3">Duración aproximada:</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" name="duracion" id="duracion" class="form-control required numerosEnteros">
                            <span class="input-group-addon">Años</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3">Mensualidades:</label>
                    <div class="col-md-3">
                        <input type="text" name="mensualidades" id="mensualidades" class="form-control required numerosEnteros">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                        <input type="button" id="guardarFormOtros" class="btn btn-primary" value="Generar tratamiento">
                        <input type="hidden" name="expedienteId" value="{{ base64_encode($expediente->getId()) }}">
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>