<!-- datos personales -->
<div class="tab-pane active" id="datosPersonales">
	<div class="row">
		<div class="col-md-12 col-lg-6">
			<div class="box-generic">
				<div class="row">
					<div class="col-xs-6">
						<p class="strong">Nombre:</p>
						<p>{{ $expediente->getPaciente()->getNombre() }}</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">A. Paterno:</p>
						<p>{{ $expediente->getPaciente()->getPaterno() }}</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">A. Materno:</p>
						<p>{{ $expediente->getPaciente()->getMaterno() }}
					</div>

					<div class="col-xs-6">
						<p class="strong">Fecha de nacimiento:</p>
						<p>{{ $expediente->getPaciente()->getFechaNacimiento() }}</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">Edad:</p>
						<p>{{ $expediente->getPaciente()->getEdadAnios() }} </p>
					</div>

					<div class="col-xs-6">
						<p class="strong">Lugar de nacimiento:</p>
						<p>{{ $expediente->getPaciente()->getLugarNacimiento() }}</p>
					</div>
				</div>
			</div>

			<div class="box-generic">
				<div class="row">
					<div class="col-xs-6">
						<p class="strong">Dirección:</p>
						<p>{{ $expediente->getPaciente()->getDireccion() }}</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">C. P.:</p>
						<p>{{ $expediente->getPaciente()->getCP() }}</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">Municipio:</p>
						<p>{{ $expediente->getPaciente()->getMunicipio() }}</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">Teléfono local:</p>
						<p>{{ $expediente->getPaciente()->getTelefono() }}</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">Celular:</p>
						<p>{{ $expediente->getPaciente()->getCelular() }}</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">E-mail:</p>
						<p>{{ $expediente->getPaciente()->getEmail() }}</p>
					</div>
				</div>
			</div>

			<div class="box-generic">
				<div class="row">
					<div class="col-xs-6">
						<p class="strong">¿Ha automedicado a su hijo?:</p>
						<p>
							@if($expediente->getPaciente()->getSeHaAutomedicado())
								Sí
							@else
			 					No
			 				@endif
						</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">¿Con qué?:</p>
						<p>{{ $expediente->getPaciente()->getConQueSeHaAutomedicado() }}</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">¿Es alérgico a algún medicamento?:</p>
						<p>
							@if($expediente->getPaciente()->getEsAlergico())
								Sí
							@else
								No
							@endif
						</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">¿Cuál?:</p>
						<p>{{ $expediente->getPaciente()->getAQueMedicamentoEsAlergico() }}</p>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12 col-lg-6">
			<div class="box-generic">
				<div class="row">
					<div class="col-xs-6">
						<p class="strong">Nombre del padre:</p>
						<p>{{ $expediente->getPaciente()->getNombrePadre() }}</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">Ocupación:</p>
						<p>{{ $expediente->getPaciente()->getOcupacionPadre() }}</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">Nombre de la madre:</p>
						<p>{{ $expediente->getPaciente()->getNombreMadre() }}</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">Ocupación:</p>
						<p>{{ $expediente->getPaciente()->getOcupacionMadre() }}</p>
					</div>
				</div>
			</div>

			<div class="box-generic">
				<div class="row">
					<div class="col-xs-6">
						<p class="strong">Nombre del pediatra:</p>
						<p>{{ $expediente->getPaciente()->getNombrePediatra() }}</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">¿Quién lo recomienda?:</p>
						<p>{{ $expediente->getPaciente()->getNombreRecomienda() }}</p>
					</div>

					<div class="col-xs-12">
						<p class="strong">Motivo de consulta:</p>
						<p>{{ $expediente->getPaciente()->getMotivoConsulta() }}</p>
					</div>

					<div class="col-xs-12">
						<p class="strong">Historia de la enfermedad actual:</p>
						<p>{{ $expediente->getPaciente()->getHistoriaEnfermedad() }}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- fin -->