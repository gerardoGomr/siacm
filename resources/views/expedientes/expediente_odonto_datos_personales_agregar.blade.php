<!-- datos personales -->
<div class="tab-pane active" id="datosPersonales">
	<div class="row">
		<div class="col-md-12 col-lg-6">
			<div class="box-generic">
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtNombre', 'Nombre:', ['class' => 'control-label']) !!}
							{!! Form::text('txtNombre', $paciente->getNombre(), ['class' => 'required form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtPaterno', 'A. Paterno:', ['class' => 'control-label']) !!}
							{!! Form::text('txtPaterno', $paciente->getPaterno(), ['class' => 'required form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtMaterno', 'A. Materno:', ['class' => 'control-label']) !!}
							{!! Form::text('txtMaterno', $paciente->getMaterno(), ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtFechaNac', 'Fecha de nacimiento:', ['class' => 'control-label', 'maxlength' => '10']) !!}
							{!! Form::text('txtFechaNac', null, ['class' => 'required fecha form-control', 'readonly' => 'readonly']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtEdad', 'Edad:', ['class' => 'control-label']) !!}
							{!! Form::text('txtEdad', null, ['class' => 'required numeros form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtLugarNac', 'Lugar de nacimiento:', ['class' => 'control-label']) !!}
							{!! Form::text('txtLugarNac', null, ['class' => 'required form-control']) !!}
						</div>
					</div>
				</div>
			</div>

			<div class="box-generic">
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtDireccion', 'Dirección:', ['class' => 'control-label']) !!}
							{!! Form::text('txtDireccion', null, ['class' => 'required form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtCP', 'C. P.:', ['class' => 'control-label']) !!}
							{!! Form::text('txtCP', null, ['class' => 'required form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtMunicipio', 'Municipio:', ['class' => 'control-label']) !!}
							{!! Form::text('txtMunicipio', null, ['class' => 'required form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtTelefono', 'Teléfono local:', ['class' => 'control-label']) !!}
							{!! Form::text('txtTelefono', $paciente->getTelefono(), ['class' => 'numeros form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtCelular', 'Celular:', ['class' => 'control-label']) !!}
							{!! Form::text('txtCelular', $paciente->getCelular(), ['class' => 'numeros form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtEmail', 'E-mail:', ['class' => 'control-label']) !!}
							{!! Form::text('txtEmail', $paciente->getEmail(), ['class' => 'email form-control']) !!}
						</div>
					</div>
				</div>
			</div>

			<div class="box-generic">
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('automedicado', '¿Ha automedicado a su hijo?:', ['class' => 'control-label']) !!}
							<div class="radio">
								<label>
									{!! Form::radio('automedicado', 1, null, ['class' => 'required automedicado']) !!} Sí
								</label>
							</div>

							<div class="radio">
								<label>
									{!! Form::radio('automedicado', 2, null, ['class' => 'required automedicado']) !!} No
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtConQueHaAutomedicado', '¿Con qué?:', ['class' => 'control-label']) !!}
							{!! Form::text('txtConQueHaAutomedicado', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('alergico', '¿Es alérgico a algún medicamento?:', ['class' => 'control-label']) !!}
							<div class="radio">
								<label>
									{!! Form::radio('alergico', 1, null, ['class' => 'required alergico']) !!} Sí
								</label>
							</div>

							<div class="radio">
								<label>
									{!! Form::radio('alergico', 2, null, ['class' => 'required alergico']) !!} No
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtACualEsAlergico', '¿Cuál?:', ['class' => 'control-label']) !!}
							{!! Form::text('txtACualEsAlergico', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12 col-lg-6">
			<div class="box-generic">
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtNombrePadre', 'Nombre del padre:', ['class' => 'control-label']) !!}
							{!! Form::text('txtNombrePadre', null, ['class' => 'required form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtOcupacionPadre', 'Ocupación:', ['class' => 'control-label']) !!}
							{!! Form::text('txtOcupacionPadre', null, ['class' => 'required form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtNombreMadre', 'Nombre de la madre:', ['class' => 'control-label']) !!}
							{!! Form::text('txtNombreMadre', null, ['class' => 'required form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtOcupacionMadre', 'Ocupación:', ['class' => 'control-label']) !!}
							{!! Form::text('txtOcupacionMadre', null, ['class' => 'required form-control']) !!}
						</div>
					</div>
				</div>
			</div>

			<div class="box-generic">
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtPediatra', 'Nombre del pediatra:', ['class' => 'control-label']) !!}
							{!! Form::text('txtPediatra', null, ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtRecomienda', '¿Quién lo recomienda?:', ['class' => 'control-label']) !!}
							{!! Form::text('txtRecomienda', null, ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-12">
						<div class="form-group">
							{!! Form::label('txtMotivoConsulta', 'Motivo de consulta:', ['class' => 'control-label']) !!}
							{!! Form::text('txtMotivoConsulta', null, ['class' => 'required form-control']) !!}
						</div>
					</div>

					<div class="col-xs-12">
						<div class="form-group">
							{!! Form::label('txtHistoriaEnfermedad', 'Historia de la enfermedad actual:', ['class' => 'control-label']) !!}
							{!! Form::textarea('txtHistoriaEnfermedad', null, ['class' => 'required form-control', 'rows' => '6']) !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- fin -->