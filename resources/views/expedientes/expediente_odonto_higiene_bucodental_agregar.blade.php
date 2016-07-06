<!-- antecedentes higieneBucodental -->
<div class="tab-pane" id="higieneBucodental">
	<div class="row">
		<div class="col-md-12 col-lg-6">
			<div class="box-generic">
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('tipoCepillo', 'Tipo de cepillo dental:', ['class' => 'control-label']) !!}
							<div class="radio">
								<label>
									{!! Form::radio('tipoCepillo', 1, null, ['class' => 'required']) !!} Adultos
								</label>
							</div>

							<div class="radio">
								<label>
									{!! Form::radio('tipoCepillo', 2, null, ['class' => 'required']) !!} Niños
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('marcaPasta', 'Marca de pasta dental:', ['class' => 'control-label']) !!}
							<select name="marcaPasta" id="marcaPasta" class="required form-control">
								<option value="">Seleccione</option>
								@foreach ($listaMarcas as $marcaPasta)
									<option value="{{ $marcaPasta->getId() }}">{{ $marcaPasta->getMarcaPasta() }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtVecesCepilla', '¿Cuántas veces cepilla los dientes del niño(a) al día?:', ['class' => 'control-label']) !!}
							{!! Form::text('txtVecesCepilla', '', ['class' => 'required form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtEdadErupcionaPrimerDiente', '¿A qué edad erupcionó el primer diente?:', ['class' => 'control-label']) !!}
							{!! Form::text('txtEdadErupcionaPrimerDiente', '', ['class' => 'required form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('ayudaAlCepillarse', '¿Alguien le ayuda a cepillarse los dientes?:', ['class' => 'control-label']) !!}
							<div class="radio">
								<label>
									{!! Form::radio('ayudaAlCepillarse', 1, null, ['class' => 'required']) !!} Sí
								</label>
							</div>

							<div class="radio">
								<label>
									{!! Form::radio('ayudaAlCepillarse', 2, null, ['class' => 'required']) !!} No
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtVecesCome', '¿Cuántas veces come al día?:', ['class' => 'control-label']) !!}
							{!! Form::text('txtVecesCome', '', ['class' => 'required numerosEnteros form-control']) !!}
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12 col-lg-6">
			<div class="box-generic">
				<h4 class="heading">Auxiliares</h4>
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									{!! Form::checkbox('hiloDental', 1, null, []) !!} Hilo dental
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									{!! Form::checkbox('enjuagueBucal', 1, null, []) !!} Enjuague bucal
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									{!! Form::checkbox('limpiadorLingual', 1, null, []) !!} Limpiador lingual
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									{!! Form::checkbox('tabletasReveladoras', 1, null, []) !!} Tabletas reveladoras
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									{!! Form::checkbox('otroAuxiliar', 1, null, []) !!} Otro
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::text('txtEspecifiqueAuxiliar', '', ['class' => 'form-control', 'placeholder' => 'Especifique']) !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- fin -->