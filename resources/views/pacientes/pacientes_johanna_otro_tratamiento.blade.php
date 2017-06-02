<div id="dvOtroTratamiento" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 800px;">
            <div class="modal-header">
                <h4 class="modal-title">Capturar tratamiento</h4>
                <button class="close" aria-hidden="true" data-dismiss="modal" type="button">x</button>
            </div>
            <div class="modal-body">
                <form action="" id="formOtroTratamiento" class="form-horizontal">
                    {{ csrf_field() }}
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
                        <label for="dx" class="control-label col-md-3">DX:</label>
                        <div class="col-md-9">
                            <textarea name="dx" id="dx" class="form-control required" rows="5"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="observaciones" class="control-label col-md-3">Observaciones:</label>
                        <div class="col-md-9">
                            <textarea name="observaciones" id="observaciones" class="form-control required" rows="5"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tx" class="control-label col-md-3">Descripción TX:</label>
                        <div class="col-md-9">
                            <textarea name="tx" id="tx" class="form-control required" rows="5"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="costo" class="control-label col-md-3">Costo:</label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="text" name="costo" id="costo" class="form-control required numeros">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="duracion" class="control-label col-md-3">Duración aproximada:</label>
                        <div class="col-md-3">
                            <input type="text" name="fechaInicio" id="fechaInicio" class="form-control required fecha" placeholder="Fecha Inicio" readonly>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="fechaTermino" id="fechaTermino" class="form-control required fecha" placeholder="Fecha Término" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="mensualidades" class="control-label col-md-3">Mensualidades:</label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="text" name="mensualidades" id="mensualidades" class="form-control required numerosEnteros">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <button type="button" id="guardarFormOtros" class="btn btn-primary"><i class="fa fa-save"></i> Generar tratamiento</button>
                            <input type="hidden" name="expedienteId" value="{{ base64_encode($expediente->getId()) }}">
                            <input type="hidden" name="otroTratamientoId" id="otroTratamientoId">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>