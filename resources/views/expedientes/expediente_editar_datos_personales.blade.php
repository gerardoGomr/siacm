<div class="tab-pane active" id="datosPersonales">
	<div class="box-generic">
		<div class="form-group">
			{!! Form::label('nombre', '*Nombre:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-5">
				{!! Form::text('nombre', $expediente->getPaciente()->getNombre(), ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('paterno', '*A. Paterno:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-5">
				{!! Form::text('paterno', $expediente->getPaciente()->getPaterno(), ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('materno', 'A. Materno:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-5">
				{!! Form::text('materno', $expediente->getPaciente()->getMaterno(), ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('fechaNacimiento', '*Fecha de nacimiento:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-2">
				{!! Form::text('fechaNacimiento', $expediente->getPaciente()->getFechaNacimiento(), ['class' => 'fecha form-control', 'readonly' => 'readonly']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('edad', '*Edad:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-2">
				<div class="input-group">
					{!! Form::text('edadAnios', $expediente->getPaciente()->getEdadAnios(), ['id' => 'edadAnios', 'class' => 'numeros form-control', 'placeholder' => 'Años']) !!}
					<span class="input-group-addon">Años</span>
				</div>
			</div>
			<div class="col-md-2">
				<div class="input-group">
					{!! Form::text('edadMeses', $expediente->getPaciente()->getEdadMeses(), ['id' => 'edadMeses', 'class' => 'numeros form-control', 'placeholder' => 'Meses']) !!}
					<span class="input-group-addon">Meses</span>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('lugarNacimiento', '*Lugar de nacimiento:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('lugarNacimiento', $expediente->getPaciente()->getLugarNacimiento(), ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('direccion', '*Dirección:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('direccion', !is_null($expediente->getPaciente()->getDomicilio()) ? $expediente->getPaciente()->getDomicilio()->getDireccion() : '', ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('cp', '*C. P.:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-2">
				{!! Form::text('cp', !is_null($expediente->getPaciente()->getDomicilio()) ? $expediente->getPaciente()->getDomicilio()->getCp() : '', ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('municipio', '*Municipio:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('municipio', !is_null($expediente->getPaciente()->getDomicilio()) ? $expediente->getPaciente()->getDomicilio()->getMunicipio() : '', ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('telefono', 'Teléfono local:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-3">
				{!! Form::text('telefono', $expediente->getPaciente()->getTelefono(), ['class' => 'numeros form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('celular', 'Celular:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-3">
				{!! Form::text('celular', $expediente->getPaciente()->getCelular(), ['class' => 'numeros form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('email', 'E-mail:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-5">
				{!! Form::text('email', $expediente->getPaciente()->getEmail(), ['class' => 'email form-control']) !!}
			</div>
		</div>
	</div>
	<div class="box-generic">
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('automedicado', null, $expediente->seHaAutomedicado(), ['class' => 'automedicado']) !!} Ha automedicado a su hijo(a)
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('conQueHaAutomedicado', '¿Con qué?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				@if($expediente->seHaAutomedicado())
					{!! Form::text('conQueHaAutomedicado', $expediente->getConQueSeHaAutomedicado(), ['class' => 'form-control']) !!}
				@else
					{!! Form::text('conQueHaAutomedicado', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
				@endif
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('alergico', null, $expediente->esAlergico(), ['class' => 'alergico']) !!} Es alérgico a algún medicamento
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('aCualEsAlergico', '¿A cuál?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				@if($expediente->esAlergico())
					{!! Form::text('aCualEsAlergico', $expediente->getAQueMedicamentoEsAlergico(), ['class' => 'form-control']) !!}
				@else
					{!! Form::text('aCualEsAlergico', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
				@endif
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('nombrePadre', '*Nombre del padre:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('nombrePadre', $expediente->getExpedienteEspecialidad()->getNombrePadre(), ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('ocupacionPadre', '*Ocupación:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('ocupacionPadre', $expediente->getExpedienteEspecialidad()->getOcupacionPadre(), ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('nombreMadre', '*Nombre de la madre:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('nombreMadre', $expediente->getExpedienteEspecialidad()->getNombreMadre(), ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('ocupacionMadre', '*Ocupación:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('ocupacionMadre', $expediente->getExpedienteEspecialidad()->getOcupacionMadre(), ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('pediatra', 'Nombre del pediatra:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('pediatra', $expediente->getNombrePediatra(), ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('quienRecomienda', '¿Quién lo recomienda?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('quienRecomienda', $expediente->getNombreRecomienda(), ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('motivoConsulta', '*Motivo de consulta:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('motivoConsulta', $expediente->getMotivoConsulta(), ['class' => 'form-control']) !!}
			</div>
		</div>
	</div>
</div>
