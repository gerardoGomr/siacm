<div class="tab-pane active" id="datosPersonales">
	<div class="box-generic">
		<div class="form-group">
			{!! Form::label('nombre', '*Nombre:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-5">
				{!! Form::text('nombre', $paciente->getNombre(), ['class' => 'required form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('paterno', '*A. Paterno:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-5">
				{!! Form::text('paterno', $paciente->getPaterno(), ['class' => 'required form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('materno', 'A. Materno:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-5">
				{!! Form::text('materno', $paciente->getMaterno(), ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('fechaNacimiento', '*Fecha de nacimiento:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-2">
				{!! Form::text('fechaNacimiento', $paciente->getFechaNacimiento(), ['class' => 'required fecha form-control', 'readonly' => 'readonly']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('edad', '*Edad:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-2">
				<div class="input-group">
					{!! Form::text('edadAnios', $paciente->getEdadAnios() or '', ['id' => 'edadAnios', 'class' => 'required numeros form-control', 'placeholder' => 'Años']) !!}
					<span class="input-group-addon">Años</span>
				</div>
			</div>
			<div class="col-md-2">
				<div class="input-group">
					{!! Form::text('edadMeses', $paciente->getEdadMeses() or '', ['id' => 'edadMeses', 'class' => 'required numeros form-control', 'placeholder' => 'Meses']) !!}
					<span class="input-group-addon">Meses</span>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('lugarNacimiento', '*Lugar de nacimiento:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('lugarNacimiento', $paciente->getLugarNacimiento() or '', ['class' => 'required form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('direccion', '*Dirección:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('direccion', !is_null($paciente->getDomicilio()) ? $paciente->getDomicilio()->getDireccion() : '', ['class' => 'required form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('cp', '*C. P.:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-2">
				{!! Form::text('cp', !is_null($paciente->getDomicilio()) ? $paciente->getDomicilio()->getCp() : '', ['class' => 'required form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('municipio', '*Municipio:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('municipio', !is_null($paciente->getDomicilio()) ? $paciente->getDomicilio()->getMunicipio() : '', ['class' => 'required form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('telefono', 'Teléfono local:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-3">
				{!! Form::text('telefono', $paciente->getTelefono(), ['class' => 'numeros form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('celular', 'Celular:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-3">
				{!! Form::text('celular', $paciente->getCelular(), ['class' => 'numeros form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('email', 'E-mail:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-5">
				{!! Form::text('email', $paciente->getEmail(), ['class' => 'email form-control']) !!}
			</div>
		</div>
	</div>
	<div class="box-generic">
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('automedicado', null, null, ['class' => 'automedicado']) !!} Ha automedicado a su hijo(a)
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('conQueHaAutomedicado', '¿Con qué?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('conQueHaAutomedicado', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('alergico', null, null, ['class' => 'alergico']) !!} Es alérgico a algún medicamento
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('aCualEsAlergico', '¿A cuál?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('aCualEsAlergico', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('nombrePadre', '*Nombre del padre:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('nombrePadre', null, ['class' => 'required form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('ocupacionPadre', '*Ocupación:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('ocupacionPadre', null, ['class' => 'required form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('nombreMadre', '*Nombre de la madre:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('nombreMadre', null, ['class' => 'required form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('ocupacionMadre', '*Ocupación:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('ocupacionMadre', null, ['class' => 'required form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('pediatra', 'Nombre del pediatra:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('pediatra', null, ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('quienRecomienda', '¿Quién lo recomienda?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('quienRecomienda', null, ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('motivoConsulta', '*Motivo de consulta:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('motivoConsulta', null, ['class' => 'required form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('historiaEnfermedad', '*Historia de la enfermedad actual:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::textarea('historiaEnfermedad', null, ['class' => 'required form-control', 'rows' => '6']) !!}
			</div>
		</div>
	</div>
</div>