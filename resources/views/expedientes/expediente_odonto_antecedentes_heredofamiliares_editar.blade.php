<!-- antecedentes heredofamiliares -->
<div class="tab-pane" id="antHeredofamiliares">
	<div class="row">
		<div class="col-md-12 col-lg-6">
			<div class="box-generic">
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('viveMadre', 'Madre:', ['class' => 'control-label']) !!}
							<div class="radio">
								<label>
									@if($expediente->getPaciente()->getViveMadre() === 1)
										{!! Form::radio('viveMadre', 1, true, ['class' => 'viveMadre']) !!} Viva
									@else
										{!! Form::radio('viveMadre', 1, null, ['class' => 'viveMadre']) !!} Viva
									@endif
								</label>
							</div>

							<div class="radio">
								<label>
									@if($expediente->getPaciente()->getViveMadre() === 0)
										{!! Form::radio('viveMadre', 2, true, ['class' => 'viveMadre']) !!} Finada
									@else
										{!! Form::radio('viveMadre', 2, null, ['class' => 'viveMadre']) !!} Finada
									@endif
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtCausaMuerteMadre', 'Si es finada, causa de muerte:', ['class' => 'control-label']) !!}
							{!! Form::text('txtCausaMuerteMadre', $expediente->getPaciente()->getCausaMuerteMadre(), ['class' => 'form-control', 'readonly' => 'readonly']) !!}
						</div>
					</div>

					<div class="col-xs-12">
						<div class="form-group">
							{!! Form::label('txtEnfermedadesMadre', 'Enfermedades que padece o padeció:', ['class' => 'control-label']) !!}
							{!! Form::text('txtEnfermedadesMadre', $expediente->getPaciente()->getEnfermedadesMadre(), ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('vivePadre', 'Padre:', ['class' => 'control-label']) !!}
							<div class="radio">
								<label>
									@if($expediente->getPaciente()->getVivePadre() === 1)
										{!! Form::radio('vivePadre', 1, true, ['class' => 'vivePadre']) !!} Vivo
									@else
										{!! Form::radio('vivePadre', 1, null, ['class' => 'vivePadre']) !!} Vivo
									@endif
								</label>
							</div>

							<div class="radio">
								<label>
									@if($expediente->getPaciente()->getVivePadre() === 0)
										{!! Form::radio('vivePadre', 2, true, ['class' => 'vivePadre']) !!} Finado
									@else
										{!! Form::radio('vivePadre', 2, null, ['class' => 'vivePadre']) !!} Finado
									@endif
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtCausaMuertePadre', 'Si es finado, causa de muerte:', ['class' => 'control-label']) !!}
							{!! Form::text('txtCausaMuertePadre', $expediente->getPaciente()->getCausaMuertePadre(), ['class' => 'form-control', 'readonly' => 'readonly']) !!}
						</div>
					</div>

					<div class="col-xs-12">
						<div class="form-group">
							{!! Form::label('txtEnfermedadesPadre', 'Enfermedades que padece o padeció:', ['class' => 'control-label']) !!}
							{!! Form::text('txtEnfermedadesPadre', $expediente->getPaciente()->getEnfermedadesPadre(), ['class' => 'form-control']) !!}
						</div>
					</div>
				</div>
			</div>

			<div class="box-generic">
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group">
							{!! Form::label('txtEnfermedadesAbuelosPaternos', 'Enfermedades abuelos paternos:', ['class' => 'control-label']) !!}
							{!! Form::textarea('txtEnfermedadesAbuelosPaternos', $expediente->getPaciente()->getEnfermedadesAbuelosPaternos(), ['class' => 'form-control', 'rows' => '6']) !!}
						</div>
					</div>

					<div class="col-xs-12">
						<div class="form-group">
							{!! Form::label('txtEnfermedadesAbuelosMaternos', 'Enfermedades abuelos maternos:', ['class' => 'control-label']) !!}
							{!! Form::textarea('txtEnfermedadesAbuelosMaternos', $expediente->getPaciente()->getEnfermedadesAbuelosMaternos(), ['class' => 'form-control', 'rows' => '6']) !!}
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
							{!! Form::label('txtNumHermanos', 'Número de hermanos:', ['class' => 'control-label']) !!}
							{!! Form::text('txtNumHermanos', $expediente->getPaciente()->getNumHermanos(), ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtNumHermanosVivos', 'Vivos:', ['class' => 'control-label']) !!}
							{!! Form::text('txtNumHermanosVivos', $expediente->getPaciente()->getNumHermanosVivos(), ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtNumHermanosFinados', 'Finados:', ['class' => 'control-label']) !!}
							{!! Form::text('txtNumHermanosFinados', $expediente->getPaciente()->getNumHermanosFinados(), ['class' => 'form-control', 'readonly' => 'readonly']) !!}
						</div>
					</div>

					<div class="col-xs-12">
						<div class="form-group">
							{!! Form::label('txtNombresEdades', 'Nombres y Edades:', ['class' => 'control-label']) !!}
							{!! Form::textarea('txtNombresEdades', $expediente->getPaciente()->getNombreEdadesHermanos(), ['class' => 'form-control', 'rows' => '6']) !!}
						</div>
					</div>

					<div class="col-xs-12">
						<div class="form-group">
							{!! Form::label('txtEnfermedadesHermanos', 'Enfermedades que padecen o padecieron:', ['class' => 'control-label']) !!}
							{!! Form::textarea('txtEnfermedadesHermanos', $expediente->getPaciente()->getEnfermedadesHermanos(), ['class' => 'form-control', 'rows' => '6']) !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- fin -->