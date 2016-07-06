<!-- antecedentes heredofamiliares -->
<div class="tab-pane" id="antOdontalgicos">
	<div class="row">
		<div class="col-md-12 col-lg-6">
			<div class="box-generic">
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('', '¿Es su primera visita al dentista?:', ['class' => 'control-label']) !!}
							<div class="radio">
								<label>
									@if($expediente->getPaciente()->getPrimeraVisitaDentista() === 1)
										{!! Form::radio('primeraVisita', 1, true, []) !!} Sí
									@else
										{!! Form::radio('primeraVisita', 1, null, []) !!} Sí
									@endif
								</label>
							</div>

							<div class="radio">
								<label>
									@if($expediente->getPaciente()->getPrimeraVisitaDentista() === 0)
										{!! Form::radio('primeraVisita', 2, true, []) !!} No
									@else
										{!! Form::radio('primeraVisita', 2, null, []) !!} No
									@endif
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtFechaUltimoExamen', 'Fecha de último examen bucal:', ['class' => 'control-label']) !!}
							{!! Form::text('txtFechaUltimoExamen', $expediente->getPaciente()->getFechaUltimoExamenBucal(), ['class' => 'form-control fecha']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtMotivoUltimoExamen', 'Motivo:', ['class' => 'control-label']) !!}
							{!! Form::text('txtMotivoUltimoExamen', $expediente->getPaciente()->getMotivoVisitaDentista(), ['class' => 'form-control']) !!}
						</div>
					</div>
				</div>
			</div>

			<div class="box-generic">
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('', '¿Le han colocado algún tipo de anestésico?:', ['class' => 'control-label']) !!}
							<div class="radio">
								<label>
									@if($expediente->getPaciente()->getLeHanColocadoAnestesico() === 1)
										{!! Form::radio('anestesico', 1, true, []) !!} Sí
									@else
										{!! Form::radio('anestesico', 1, null, []) !!} Sí
									@endif
								</label>
							</div>

							<div class="radio">
								<label>
									@if($expediente->getPaciente()->getLeHanColocadoAnestesico() === 0)
										{!! Form::radio('anestesico', 2, true, []) !!} No
									@else
										{!! Form::radio('anestesico', 2, null, []) !!} No
									@endif
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('', '¿Tuvo mala reacción?:', ['class' => 'control-label']) !!}
							<div class="radio">
								<label>
									@if($expediente->getPaciente()->getTuvoMalaReaccionAnestesico() === 1)
										{!! Form::radio('malaReaccion', 1, true, []) !!} Sí
									@else
										{!! Form::radio('malaReaccion', 1, null, []) !!} Sí
									@endif
								</label>
							</div>

							<div class="radio">
								<label>
									@if($expediente->getPaciente()->getTuvoMalaReaccionAnestesico() === 1)
										{!! Form::radio('malaReaccion', 2, true, []) !!} No
									@else
										{!! Form::radio('malaReaccion', 2, null, []) !!} No
									@endif
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtQueReaccion', '¿Cuál?:', ['class' => 'control-label']) !!}
							{!! Form::text('txtQueReaccion', $expediente->getPaciente()->getReaccionAnestesico(), ['class' => 'form-control']) !!}
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12 col-lg-6">
			<div class="box-generic">
				<div class="form-group">
					{!! Form::label('txtTraumatismo', 'Traumatismo bucal:', ['class' => 'control-label']) !!}
					{!! Form::text('txtTraumatismo', $expediente->getPaciente()->getTraumatismoBucal(), ['class' => 'form-control']) !!}
				</div>
			</div>
		</div>
	</div>
</div>
<!-- fin -->