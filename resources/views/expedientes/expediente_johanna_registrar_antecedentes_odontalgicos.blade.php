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
									{!! Form::radio('primeraVisita', 1, null, ['class' => 'required']) !!} Sí
								</label>
							</div>

							<div class="radio">
								<label>
									{!! Form::radio('primeraVisita', 2, null, ['class' => 'required']) !!} No
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtFechaUltimoExamen', 'Fecha de último examen bucal:', ['class' => 'control-label']) !!}
							{!! Form::text('txtFechaUltimoExamen', '', ['class' => 'form-control fecha']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtMotivoUltimoExamen', 'Motivo:', ['class' => 'control-label']) !!}
							{!! Form::text('txtMotivoUltimoExamen', '', ['class' => 'required form-control']) !!}
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
									{!! Form::radio('anestesico', 1, null, ['class' => 'required']) !!} Sí
								</label>
							</div>

							<div class="radio">
								<label>
									{!! Form::radio('anestesico', 2, null, ['class' => 'required']) !!} No
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('', '¿Tuvo mala reacción?:', ['class' => 'control-label']) !!}
							<div class="radio">
								<label>
									{!! Form::radio('malaReaccion', 1, null, ['class' => 'required']) !!} Sí
								</label>
							</div>

							<div class="radio">
								<label>
									{!! Form::radio('malaReaccion', 2, null, ['class' => 'required']) !!} No
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtQueReaccion', '¿Cuál?:', ['class' => 'control-label']) !!}
							{!! Form::text('txtQueReaccion', '', ['class' => 'form-control']) !!}
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12 col-lg-6">
			<div class="box-generic">
				<div class="form-group">
					{!! Form::label('txtTraumatismo', 'Traumatismo bucal:', ['class' => 'control-label']) !!}
					{!! Form::text('txtTraumatismo', '', ['class' => 'required form-control']) !!}
				</div>
			</div>
		</div>
	</div>
</div>
<!-- fin -->