<div id="dvEditarAnexo" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 800px;">
            <div class="modal-header">
                <h4 class="modal-title">Editar Anexo</h4>
                <button class="close" aria-hidden="true" data-dismiss="modal" type="button">x</button>
            </div>
            <div class="modal-body">
                <form action="{{ url('pacientes/anexos/editar') }}" id="formEditarAnexo" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group">
						<label for="nombreAnexo" class="control-label col-md-3">Nombre:</label>
						<div class="col-md-8">
							<input type="text" name="nombreAnexo" class="form-control required">
						</div>
					</div>

                    <div class="form-group">
                        <label for="fechaDocumento" class="control-label col-md-3">Fecha Documento:</label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" name="fechaDocumento" class="form-control required" readonly>
                                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
						<label for="categoria" class="control-label col-md-3">Categoría:</label>
						<div class="col-md-5">
							<select name="categoria" class="form-control required">
                                <option value="">Seleccione</option>
                            </select>
						</div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <input type="button" id="modificarAnexo" class="btn btn-primary" value="Guardar">
                            <input type="hidden" name="anexoId" value="">
                            <input type="hidden" name="medicoId" >
                            <input type="hidden" name="expedienteId">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
