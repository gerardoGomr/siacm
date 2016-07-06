<div class="tab-pane" id="anexos">
	<div class="row">
		<div class="col-md-6">
			@if($expediente->tieneAnexos())
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>&nbsp;</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						@foreach($expediente->anexos() as $anexo)
							<tr>
								<td>{{ $anexo->nombreFormal() }}</td>
								<td><a href="{{ url($anexoUploader->rutaBase() . $anexo->nombre()) }}" target="_blank"><i class="fa fa-search"></i></a></td>
								<td><a class="eliminarAnexo" href="{{ url('pacientes/anexo/eliminar') }}" data-id="{{ base64_encode($anexo->nombre()) }}" target="_blank"><i class="fa fa-times"></i></a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@else
				<p class="strong">No tiene anexos</p>
			@endif
		</div>

		<div class="col-md-6">
			<div class="box-generic">
				{!! Form::open(['url' => url('pacientes/anexo/agregar'), 'id' => 'formAnexo', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal']) !!}
					<div class="form-group">
						<label class="control-label col-md-3">Nombre:</label>
						<div class="col-md-9">
							<input type="text" name="nombreAnexo" id="nombreAnexo" class="form-control required">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">Anexo:</label>
						<div class="col-md-9">
							<input type="file" name="anexo" id="anexo" class="form-control required pdf">
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-9 col-md-offset-3">
							<input type="submit" value="Agregar" class="btn btn-primary">
							<input type="hidden" name="userMedico" value="{{ base64_encode($expediente->getMedico()->getUsername()) }}">
							<input type="hidden" name="idPaciente" value="{{ base64_encode($expediente->getPaciente()->getId()) }}">
							<input type="hidden" id="urlDespuesAgregar" value="{{ url('pacientes/detalle') }}">
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>