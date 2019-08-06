<div class="tab-pane" id="anexos">
	<div class="row">
		<div class="col-md-6">
            <div class="box-generic">
                @if($expediente->tieneAnexos())
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha</th>
                                <th>Categoría</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($anexos as $anexo)
                                <tr>
                                    <td>{{ $anexo->Nombre }}</td>
                                    <td>{{ $anexo->FechaDocumento }}</td>
                                    <td>{{ $anexo->categoria->Nombre }}</td>
                                    <td>
                                        <a href="{{ url('pacientes/anexos/ver/' . $expediente->getId() . '/' . $medico->getId() . '/' . str_replace(' ', '_', $anexo->Nombre)) }}" target="_blank" class="btn btn-default" data-toggle="tooltip" data-original-title="Ver anexo"><i class="fa fa-search"></i></a>
                                        <button type="button" class="editarAnexo btn btn-default" data-nombre="{{ $anexo->Nombre }}" data-fecha="{{ $anexo->FechaDocumento }}" data-categoria="{{ $anexo->CategoriaId }}" data-id="{{ $anexo->id }}" data-toggle="tooltip" data-original-title="Modificar anexo"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="eliminarAnexo btn btn-default" data-url="{{ url('pacientes/anexos/eliminar') }}" data-id="{{ base64_encode(str_replace(' ', '_', $anexo->Nombre)) }}" data-toggle="tooltip" data-original-title="Eliminar anexo"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="strong">No tiene anexos</p>
                @endif
            </div>
		</div>

		<div class="col-md-6">
			<div class="box-generic">
				{!! Form::open(['url' => url('pacientes/anexos/agregar'), 'id' => 'formAnexo', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal']) !!}
					<div class="form-group">
						<label for="nombreAnexo" class="control-label col-md-3">Nombre:</label>
						<div class="col-md-8">
							<input type="text" name="nombreAnexo" id="nombreAnexo" class="form-control required">
						</div>
					</div>

                    <div class="form-group">
                        <label for="fechaDocumento" class="control-label col-md-3">Fecha Documento:</label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" name="fechaDocumento" id="fechaDocumento" class="form-control required" readonly>
                                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
						<label for="categoria" class="control-label col-md-3">Categoría:</label>
						<div class="col-md-5">
							<select name="categoria" class="form-control required">
                                <option value="">Seleccione</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->Nombre }}</option>
                                @endforeach
                            </select>
						</div>
					</div>

					<div class="form-group">
						<label for="anexo" class="control-label col-md-3">Anexo:</label>
						<div class="col-md-8">
							<input type="file" name="anexo" id="anexo" class="form-control required pdf">
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-9 col-md-offset-3">
							<input type="submit" value="Agregar &raquo;" class="btn btn-primary">
                            <input type="hidden" name="expedienteId" value="{{ base64_encode($expediente->getId()) }}">
                            <input type="hidden" name="medicoId" value="{{ base64_encode($medico->getId()) }}">
							<input type="hidden" id="urlDespuesAgregar" value="{{ url('pacientes/detalle') }}">
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>