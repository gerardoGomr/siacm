<div class="tab-pane" id="anexos">
	<div class="row">
		<div class="col-md-6">
            <div class="box-generic">
                @if($expediente->tieneAnexos())
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($expediente->anexos() as $anexo)
                                <tr>
                                    <td>{!! $anexo->nombreFormal() !!}</td>
                                    <td>
                                        <a href="{{ url('pacientes/anexos/ver/' . $expediente->getId() . '/' . $anexo->nombre()) }}" target="_blank" class="btn btn-default" data-toggle="tooltip" data-original-title="Ver anexo"><i class="fa fa-search"></i></a>
                                        <button type="button" class="eliminarAnexo btn btn-default" data-url="{{ url('pacientes/anexos/eliminar') }}" data-id="{{ base64_encode($anexo->nombre()) }}" data-toggle="tooltip" data-original-title="Eliminar anexo"><i class="fa fa-times"></i></button></td>
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
						<div class="col-md-9">
							<input type="text" name="nombreAnexo" id="nombreAnexo" class="form-control required">
						</div>
					</div>

					<div class="form-group">
						<label for="anexo" class="control-label col-md-3">Anexo:</label>
						<div class="col-md-9">
							<input type="file" name="anexo" id="anexo" class="form-control required pdf">
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-9 col-md-offset-3">
							<input type="submit" value="Agregar &raquo;" class="btn btn-primary">
							<input type="hidden" name="expedienteId" value="{{ base64_encode($expediente->getId()) }}">
							<input type="hidden" id="urlDespuesAgregar" value="{{ url('pacientes/detalle') }}">
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>