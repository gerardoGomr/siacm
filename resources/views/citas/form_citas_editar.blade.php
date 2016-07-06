{!! Form::open([
	'url' => '/agenda/agregar',
	'id'  => 'formCita'
]) !!}
<div class="innerAll bg-white border-bottom">
	<div class="row">
		<div class="col-xs-6 col-md-4 col-lg-6">
			<div class="form-group">
				{!! Form::label('txtNombre', 'Nombre:', ['class' => 'control-label']) !!}
				{!! Form::text('txtNombre', $nombre, ['class' => 'form-control']) !!}
			</div>
		</div>

		<div class="col-xs-6 col-md-4 col-lg-6">
			<div class="form-group">
				{!! Form::label('txtPaterno', 'Paterno:', ['class' => 'control-label']) !!}
				{!! Form::text('txtPaterno', $paterno, ['class' => 'form-control']) !!}
			</div>
		</div>

		<div class="col-xs-6 col-md-4 col-lg-6">
			<div class="form-group">
				{!! Form::label('txtMaterno', 'Materno:', ['class' => 'control-label']) !!}
				{!! Form::text('txtMaterno', null, ['class' => 'form-control']) !!}
			</div>
		</div>

		<div class="col-xs-6 col-md-4 col-lg-6">
			<div class="form-group">
				{!! Form::label('txtTelefono', 'Teléfono:', ['class' => 'control-label']) !!}
				{!! Form::text('txtTelefono', null, ['class' => 'form-control', 'placeholder' => 'Sin espacios ni guiones']) !!}
			</div>
		</div>

		<div class="col-xs-6 col-md-4 col-lg-6">
			<div class="form-group">
				{!! Form::label('txtCelular', 'Celular:', ['class' => 'control-label']) !!}
				{!! Form::text('txtCelular', null, ['class' => 'form-control', 'placeholder' => 'Sin espacios ni guiones']) !!}
			</div>
		</div>

		<div class="col-xs-6 col-md-4 col-lg-6">
			<div class="form-group">
				{!! Form::label('txtEmail', 'E-mail:', ['class' => 'control-label']) !!}
				{!! Form::text('txtEmail', null, ['class' => 'form-control', 'placeholder' => 'ejemplo@ejemplo.com']) !!}
			</div>
		</div>
	</div>
</div>

<div class="innerAll bg-gray">
	<div class="form-group">
		{!! Form::button('Agendar >>', ['class' => 'btn btn-success', 'id' => 'btnAgendar']) !!}
		{!! Form::hidden('op', '1', ['id' => 'op']) !!}
	</div>
</div>
{!! Form::close() !!}