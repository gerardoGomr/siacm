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
									{!! Form::radio('viveMadre', 1, null, ['class' => 'required viveMadre']) !!} Viva
								</label>
							</div>

							<div class="radio">
								<label>
									{!! Form::radio('viveMadre', 2, null, ['class' => 'required viveMadre']) !!} Finada
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtCausaMuerteMadre', 'Si es finada, causa de muerte:', ['class' => 'control-label']) !!}
							{!! Form::text('txtCausaMuerteMadre', '', ['class' => 'form-control', 'readonly' => 'readonly']) !!}
						</div>
					</div>

					<div class="col-xs-12">
						<div class="form-group">
							{!! Form::label('txtEnfermedadesMadre', 'Enfermedades que padece o padeció:', ['class' => 'control-label']) !!}
							{!! Form::text('txtEnfermedadesMadre', '', ['class' => 'required form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('vivePadre', 'Padre:', ['class' => 'control-label']) !!}
							<div class="radio">
								<label>
									{!! Form::radio('vivePadre', 1, null, ['class' => 'required vivePadre']) !!} Vivo
								</label>
							</div>

							<div class="radio">
								<label>
									{!! Form::radio('vivePadre', 2, null, ['class' => 'required vivePadre']) !!} Finado
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtCausaMuertePadre', 'Si es finado, causa de muerte:', ['class' => 'control-label']) !!}
							{!! Form::text('txtCausaMuertePadre', '', ['class' => 'form-control', 'readonly' => 'readonly']) !!}
						</div>
					</div>

					<div class="col-xs-12">
						<div class="form-group">
							{!! Form::label('txtEnfermedadesPadre', 'Enfermedades que padece o padeció:', ['class' => 'control-label']) !!}
							{!! Form::text('txtEnfermedadesPadre', '', ['class' => 'required form-control']) !!}
						</div>
					</div>
				</div>
			</div>

			<div class="box-generic">
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group">
							{!! Form::label('txtEnfermedadesAbuelosPaternos', 'Enfermedades abuelos paternos:', ['class' => 'control-label']) !!}
							{!! Form::textarea('txtEnfermedadesAbuelosPaternos', null, ['class' => 'required form-control', 'rows' => '6']) !!}
						</div>
					</div>

					<div class="col-xs-12">
						<div class="form-group">
							{!! Form::label('txtEnfermedadesAbuelosMaternos', 'Enfermedades abuelos maternos:', ['class' => 'control-label']) !!}
							{!! Form::textarea('txtEnfermedadesAbuelosMaternos', null, ['class' => 'required form-control', 'rows' => '6']) !!}
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
							{!! Form::text('txtNumHermanos', null, ['class' => 'required numerosEnteros form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtNumHermanosVivos', 'Vivos:', ['class' => 'control-label']) !!}
							{!! Form::text('txtNumHermanosVivos', null, ['class' => 'required numerosEnteros form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtNumHermanosFinados', 'Finados:', ['class' => 'control-label']) !!}
							{!! Form::text('txtNumHermanosFinados', null, ['class' => 'required numerosEnteros form-control', 'readonly' => 'readonly']) !!}
						</div>
					</div>

					<div class="col-xs-12">
						<div class="form-group">
							{!! Form::label('txtNombresEdades', 'Nombres y Edades:', ['class' => 'control-label']) !!}
							{!! Form::textarea('txtNombresEdades', null, ['class' => 'required form-control', 'rows' => '6']) !!}
						</div>
					</div>

					<div class="col-xs-12">
						<div class="form-group">
							{!! Form::label('txtEnfermedadesHermanos', 'Enfermedades que padecen o padecieron:', ['class' => 'control-label']) !!}
							{!! Form::textarea('txtEnfermedadesHermanos', null, ['class' => 'required form-control', 'rows' => '6']) !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- fin -->