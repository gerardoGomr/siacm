<div class="tab-pane active" id="datosPersonales">
	<div class="box-generic">
		<div class="form-group">
			{!! Form::label('nombre', '*Nombre:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-5">
				{!! Form::text('nombre', !is_null($expediente) ? $expediente->getPaciente()->getNombre() : $paciente != null ? $paciente->getNombre(): '', ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('paterno', '*A. Paterno:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-5">
				{!! Form::text('paterno', !is_null($expediente) ? $expediente->getPaciente()->getPaterno() : $paciente != null ? $paciente->getPaterno(): '', ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('materno', 'A. Materno:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-5">
				{!! Form::text('materno', !is_null($expediente) ? $expediente->getPaciente()->getMaterno() : $paciente != null ? $paciente->getMaterno(): '', ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('fechaNacimiento', '*Fecha de nacimiento:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-2">
				{!! Form::text('fechaNacimiento', !is_null($expediente) ? $expediente->getPaciente()->getFechaNacimiento() : $paciente != null ? $paciente->getFechaNacimiento(): '', ['class' => 'fecha form-control', 'readonly' => 'readonly']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('edad', '*Edad:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-2">
				<div class="input-group">
					{!! Form::text('edadAnios', !is_null($expediente) ? $expediente->getPaciente()->getEdadAnios() : $paciente != null ? $paciente->getEdadAnios(): '', ['id' => 'edadAnios', 'class' => 'numeros form-control', 'placeholder' => 'Años']) !!}
					<span class="input-group-addon">Años</span>
				</div>
			</div>
			<div class="col-md-2">
				<div class="input-group">
					{!! Form::text('edadMeses', !is_null($expediente) ? $expediente->getPaciente()->getEdadMeses() : $paciente != null ? $paciente->getEdadMeses(): '', ['id' => 'edadMeses', 'class' => 'numeros form-control', 'placeholder' => 'Meses']) !!}
					<span class="input-group-addon">Meses</span>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('lugarNacimiento', '*Lugar de nacimiento:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('lugarNacimiento', !is_null($expediente) ? $expediente->getPaciente()->getLugarNacimiento() : $paciente != null ? $paciente->getLugarNacimiento(): '', ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('direccion', '*Dirección:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('direccion', !is_null($expediente) && !is_null($expediente->getPaciente()->getDomicilio()) ? $expediente->getPaciente()->getDomicilio()->getDireccion() : $paciente != null && !is_null($paciente->getDomicilio()) ? $paciente->getDomicilio()->getDireccion() : '', ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('cp', '*C. P.:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-2">
				{!! Form::text('cp', !is_null($expediente) && !is_null($expediente->getPaciente()->getDomicilio()) ? $expediente->getPaciente()->getDomicilio()->getCp() : $paciente != null && !is_null($paciente->getDomicilio()) ? $paciente->getDomicilio()->getCp() : '', ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('municipio', '*Municipio:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('municipio', !is_null($expediente) && !is_null($expediente->getPaciente()->getDomicilio()) ? $expediente->getPaciente()->getDomicilio()->getMunicipio() : $paciente != null && !is_null($paciente->getDomicilio()) ? $paciente->getDomicilio()->getMunicipio() : '', ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('telefono', 'Teléfono local:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-3">
				{!! Form::text('telefono', !is_null($expediente) ? $expediente->getPaciente()->getTelefono() : $paciente != null ? $paciente->getTelefono(): '', ['class' => 'numeros form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('celular', 'Celular:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-3">
				{!! Form::text('celular', !is_null($expediente) ? $expediente->getPaciente()->getCelular() : $paciente != null ? $paciente->getCelular(): '', ['class' => 'numeros form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('email', 'E-mail:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-5">
				{!! Form::text('email', !is_null($expediente) ? $expediente->getPaciente()->getEmail() : $paciente != null ? $paciente->getEmail(): '', ['class' => 'email form-control']) !!}
			</div>
		</div>
	</div>
	<div class="box-generic">
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('automedicado', null, !is_null($expediente) ? $expediente->seHaAutomedicado() : '', ['class' => 'automedicado']) !!} Ha automedicado a su hijo(a)
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('conQueHaAutomedicado', '¿Con qué?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				@if(!is_null($expediente) && $expediente->seHaAutomedicado())
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
						{!! Form::checkbox('alergico', null, !is_null($expediente) ? $expediente->esAlergico() : '', ['class' => 'alergico']) !!} Es alérgico a algún medicamento
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('aCualEsAlergico', '¿A cuál?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				@if(!is_null($expediente) && $expediente->esAlergico())
					{!! Form::text('aCualEsAlergico', $expediente->getAQueMedicamentoEsAlergico(), ['class' => 'form-control']) !!}
				@else
					{!! Form::text('aCualEsAlergico', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
				@endif
			</div>
		</div>
		@if ($medico->getId() === \Siacme\Dominio\Usuarios\Usuario::JOHANNA)
            <div class="form-group">
                {!! Form::label('nombrePadre', '*Nombre del padre:', ['class' => 'control-label col-md-3']) !!}
                <div class="col-md-8">
                    {!! Form::text('nombrePadre', !is_null($expedienteEspecialidad) ? $expedienteEspecialidad->getNombrePadre() : '', ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('ocupacionPadre', '*Ocupación:', ['class' => 'control-label col-md-3']) !!}
                <div class="col-md-8">
                    {!! Form::text('ocupacionPadre', !is_null($expedienteEspecialidad) ? $expedienteEspecialidad->getOcupacionPadre() : '', ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('nombreMadre', '*Nombre de la madre:', ['class' => 'control-label col-md-3']) !!}
                <div class="col-md-8">
                    {!! Form::text('nombreMadre', !is_null($expedienteEspecialidad) ? $expedienteEspecialidad->getNombreMadre() : '', ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('ocupacionMadre', '*Ocupación:', ['class' => 'control-label col-md-3']) !!}
                <div class="col-md-8">
                    {!! Form::text('ocupacionMadre', !is_null($expedienteEspecialidad) ? $expedienteEspecialidad->getOcupacionMadre() : '', ['class' => 'form-control']) !!}
                </div>
            </div>
        @endif
        @if ($medico->getId() === \Siacme\Dominio\Usuarios\Usuario::RIGOBERTO)
			<div class="form-group">
				{!! Form::label('representanteLegal', 'Representante Legal:', ['class' => 'control-label col-md-3']) !!}
				<div class="col-md-8">
					{!! Form::text('ocupacionMadre', !is_null($expedienteEspecialidad) ? $expedienteEspecialidad->getRepresentanteLegal() : '', ['class' => 'form-control']) !!}
				</div>
			</div>
		@endif
		<div class="form-group">
			{!! Form::label('pediatra', 'Nombre del pediatra:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('pediatra', !is_null($expediente) ? $expediente->getNombrePediatra() : '', ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('quienRecomienda', '¿Quién lo recomienda?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('quienRecomienda', !is_null($expediente) ? $expediente->getNombreRecomienda() : '', ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('motivoConsulta', '*Motivo de consulta:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('motivoConsulta', !is_null($expediente) ? $expediente->getMotivoConsulta() : '', ['class' => 'form-control']) !!}
			</div>
		</div>
	</div>
</div>
