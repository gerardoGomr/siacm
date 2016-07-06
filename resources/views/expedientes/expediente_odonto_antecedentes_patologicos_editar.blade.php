<!-- antecedentes personales patologicos -->
<div class="tab-pane" id="antPatologicos">
	<div class="row">
		<div class="col-md-12 col-lg-6">
			<div class="box-generic">
				<div class="row">

					{!! Form::label('padecimientos', '¿Su hijo(a) padece o ha padecido alguna de las siguientes enfermedades o malestares?:', ['class' => 'control-label']) !!}

					<?php
						$i = 1;
					?>
					<div class="col-xs-6">
						<div class="form-group">
							@foreach($listaPadecimientos as $padecimiento)
								<div class="checkbox">
									<label>
										@if($expediente->getPaciente()->buscarPadecimiento($padecimiento) === true)
											{!! Form::checkbox('padecimiento[]', $padecimiento->getId(), true, []) !!} {{ $padecimiento->getPadecimiento() }}
										@else
											{!! Form::checkbox('padecimiento[]', $padecimiento->getId(), null, []) !!} {{ $padecimiento->getPadecimiento() }}
										@endif
									</label>
								</div>
								<?php
									$i++;
								?>

								@if($i % 7 === 0)
									</div>
									</div>
									<div class="col-xs-6">
									<div class="form-group">
								@endif
							@endforeach
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
							<div class="checkbox">
								<label>
									@if($expediente->getPaciente()->getSeLeHacenMoretones() === 1)
										{!! Form::checkbox('moretones', null, true, []) !!}	Se le hacen moretones
									@else
										{!! Form::checkbox('moretones', null, null, []) !!}	Se le hacen moretones
									@endif
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									@if($expediente->getPaciente()->getHaRequeridoTransfusion() === 1)
										{!! Form::checkbox('transfusion', null, true, []) !!}	Ha requerido transfusión sanguínea
									@else
										{!! Form::checkbox('transfusion', null, null, []) !!}	Ha requerido transfusión sanguínea
									@endif
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									@if($expediente->getPaciente()->getHaTenidoFracturas() === 1)
										{!! Form::checkbox('fracturas', null, true, []) !!}	Ha tenido fracturas
									@else
										{!! Form::checkbox('fracturas', null, null, []) !!}	Ha tenido fracturas
									@endif
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtFractura', '¿En donde?:', ['class' => 'control-label']) !!}
							{!! Form::text('txtFractura', $expediente->getPaciente()->getEspecifiqueFracturas(), ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									@if($expediente->getPaciente()->getHaSidoIntervenido() === 1)
										{!! Form::checkbox('cirugia', null, true, []) !!}	Ha sido intervenido quirúrgicamente
									@else
										{!! Form::checkbox('cirugia', null, null, []) !!}	Ha sido intervenido quirúrgicamente
									@endif
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtCirugia', '¿En donde?:', ['class' => 'control-label']) !!}
							{!! Form::text('txtCirugia', $expediente->getPaciente()->getEspecifiqueIntervencion(), ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									@if($expediente->getPaciente()->getHaSidoHospitalizado() === 1)
										{!! Form::checkbox('hospitalizado', null, true, []) !!}	Ha sido hospitalizado
									@else
										{!! Form::checkbox('hospitalizado', null, null, []) !!}	Ha sido hospitalizado
									@endif
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtHospitalizado', '¿De qué?:', ['class' => 'control-label']) !!}
							{!! Form::text('txtHospitalizado', $expediente->getPaciente()->getEspecifiqueHospitalizacion(), ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									@if($expediente->getPaciente()->getExFumador() === 1)
										{!! Form::checkbox('exFumador', null, true, []) !!}	Ex-fumador
									@else
										{!! Form::checkbox('exFumador', null, null, []) !!}	Ex-fumador
									@endif
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									@if($expediente->getPaciente()->getExAlcoholico() === 1)
										{!! Form::checkbox('exAlcoholico', null, true, []) !!}	Ex-alcohólico
									@else
										{!! Form::checkbox('exAlcoholico', null, null, []) !!}	Ex-alcohólico
									@endif
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-12">
						<div class="form-group">
							<div class="checkbox">
								<label>
									@if($expediente->getPaciente()->getExAdicto() === 1)
										{!! Form::checkbox('exAdicto', null, true, []) !!}	Ex-adicto
									@else
										{!! Form::checkbox('exAdicto', null, null, []) !!}	Ex-adicto
									@endif
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									@if($expediente->getPaciente()->getEstaBajoTratamiento() === 1)
										{!! Form::checkbox('tratamiento', null, true, []) !!}	Está bajo tratamiento
									@else
										{!! Form::checkbox('tratamiento', null, null, []) !!}	Está bajo tratamiento
									@endif
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtTratamiento', 'Especifique:', ['class' => 'control-label']) !!}
							{!! Form::text('txtTratamiento', $expediente->getPaciente()->getEspecifiqueTratamiento(), ['class' => 'form-control']) !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- fin -->