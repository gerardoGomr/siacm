<?php
use Siacme\Aplicacion\Fecha;
?>
<div class="tab-pane active" id="datosPersonales">
	<div class="row">
		<div class="col-md-6">
			<div class="box-generic">
				<div class="form-group">
					{!! Form::label('nombre', 'Nombre:', ['class' => 'control-label col-md-3']) !!}
					<div class="col-md-5">
						<p class="form-control-static">{{ $expediente->getPaciente()->getNombre() }}</p>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('paterno', 'A. Paterno:', ['class' => 'control-label col-md-3']) !!}
					<div class="col-md-5">
						<p class="form-control-static">{{ $expediente->getPaciente()->getPaterno() }}</p>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('materno', 'A. Materno:', ['class' => 'control-label col-md-3']) !!}
					<div class="col-md-5">
						<p class="form-control-static">{{ $expediente->getPaciente()->getMaterno() }}</p>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('fechaNacimiento', 'Fecha de nacimiento:', ['class' => 'control-label col-md-3']) !!}
					<div class="col-md-4">
						<p class="form-control-static">{{ Fecha::convertir($expediente->getPaciente()->getFechaNacimiento()) }}</p>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('edad', 'Edad:', ['class' => 'control-label col-md-3']) !!}
					<div class="col-md-3">
						<div class="input-group">
							<p class="form-control-static">{{ $expediente->getPaciente()->getEdadAnios() }} años {{ $expediente->getPaciente()->getEdadMeses() }} meses</p>
						</div>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('lugarNacimiento', 'Lugar de nacimiento:', ['class' => 'control-label col-md-3']) !!}
					<div class="col-md-8">
						<p class="form-control-static">{{ $expediente->getPaciente()->getLugarNacimiento() }}</p>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('direccion', 'Dirección:', ['class' => 'control-label col-md-3']) !!}
					<div class="col-md-8">
						<p class="form-control-static">{{ $expediente->getPaciente()->getDomicilio()->getDireccion() }}</p>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('cp', 'C. P.:', ['class' => 'control-label col-md-3']) !!}
					<div class="col-md-2">
						<p class="form-control-static">{{ $expediente->getPaciente()->getDomicilio()->getCp() }}</p>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('municipio', 'Municipio:', ['class' => 'control-label col-md-3']) !!}
					<div class="col-md-8">
						<p class="form-control-static">{{ $expediente->getPaciente()->getDomicilio()->getMunicipio() }}</p>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('telefono', 'Teléfono local:', ['class' => 'control-label col-md-3']) !!}
					<div class="col-md-3">
						<p class="form-control-static">{{ $expediente->getPaciente()->getTelefono() }}</p>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('celular', 'Celular:', ['class' => 'control-label col-md-3']) !!}
					<div class="col-md-3">
						<p class="form-control-static">{{ $expediente->getPaciente()->getCelular() }}</p>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('email', 'E-mail:', ['class' => 'control-label col-md-3']) !!}
					<div class="col-md-5">
						<p class="form-control-static">{{ $expediente->getPaciente()->getEmail() }}</p>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="box-generic">
				<div class="form-group">
					{!! Form::label('Se ha automedicado:', 'Se ha automedicado:', ['class' => 'control-label col-md-4']) !!}
					<div class="col-md-4">
						<p class="form-control-static">{{ $expediente->seHaAutomedicado() ? 'Sí' : 'No' }}</p>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('conQueHaAutomedicado', '¿Con qué?:', ['class' => 'control-label col-md-4']) !!}
					<div class="col-md-8">
						<p class="form-control-static">{{ $expediente->seHaAutomedicado() ? $expediente->getConQueSeHaAutomedicado() : '-' }}</p>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('Es alérgico:', 'Es alérgico:', ['class' => 'control-label col-md-4']) !!}
					<div class="col-md-4">
						<p class="form-control-static">{{ $expediente->esAlergico() ? 'Sí' : 'No' }}</p>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('aCualEsAlergico', '¿A cuál?:', ['class' => 'control-label col-md-4']) !!}
					<div class="col-md-7">
						<p class="form-control-static">{{ $expediente->esAlergico() ? $expediente->getAQueMedicamentoEsAlergico() : '-' }}</p>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('nombrePadre', 'Nombre del padre:', ['class' => 'control-label col-md-4']) !!}
					<div class="col-md-7">
						<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->getNombrePadre() }}</p>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('ocupacionPadre', 'Ocupación:', ['class' => 'control-label col-md-4']) !!}
					<div class="col-md-7">
						<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->getOcupacionPadre() }}</p>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('nombreMadre', 'Nombre de la madre:', ['class' => 'control-label col-md-4']) !!}
					<div class="col-md-7">
						<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->getNombreMadre() }}</p>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('ocupacionMadre', 'Ocupación:', ['class' => 'control-label col-md-4']) !!}
					<div class="col-md-7">
						<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->getOcupacionMadre() }}</p>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('pediatra', 'Nombre del pediatra:', ['class' => 'control-label col-md-4']) !!}
					<div class="col-md-7">
						<p class="form-control-static">{{ $expediente->getNombrePediatra() }}</p>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('quienRecomienda', '¿Quién lo recomienda?:', ['class' => 'control-label col-md-4']) !!}
					<div class="col-md-7">
						<p class="form-control-static">{{ $expediente->getNombreRecomienda() }}</p>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('motivoConsulta', 'Motivo de consulta:', ['class' => 'control-label col-md-4']) !!}
					<div class="col-md-7">
						<p class="form-control-static">{{ $expediente->getMotivoConsulta() }}</p>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('historiaEnfermedad', 'Historia de la enfermedad actual:', ['class' => 'control-label col-md-4']) !!}
					<div class="col-md-7">
						<p class="form-control-static">{{ $expediente->getHistoriaEnfermedad() }}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>