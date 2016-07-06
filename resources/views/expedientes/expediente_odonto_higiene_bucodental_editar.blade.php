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
									@if($expediente->getPaciente()->getTipoCepilloAdulto() === 1)
										{!! Form::radio('tipoCepillo', 1, true, []) !!} Adultos
									@else
										{!! Form::radio('tipoCepillo', 1, null, []) !!} Adultos
									@endif
								</label>
							</div>

							<div class="radio">
								<label>
									@if($expediente->getPaciente()->getTipoCepilloAdulto() === 2)
										{!! Form::radio('tipoCepillo', 2, true, []) !!} Niños
									@else
										{!! Form::radio('tipoCepillo', 2, null, []) !!} Niños
									@endif
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('marcaPasta', 'Marca de pasta dental:', ['class' => 'control-label']) !!}
							<select name="marcaPasta" id="marcaPasta" class="form-control">
								<option value="">Seleccione</option>
								@foreach ($listaMarcas as $marcaPasta)
									<?php
									$selected = '';

									if($expediente->getPaciente()->compruebaMarcaPasta($marcaPasta) === true) {
										$selected = 'selected="selected"';
									}
									?>
									<option value="{{ $marcaPasta->getId() }}" {{ $selected }}>{{ $marcaPasta->getMarcaPasta() }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtVecesCepilla', '¿Cuántas veces cepilla los dientes del niño(a) al día?:', ['class' => 'control-label']) !!}
							{!! Form::text('txtVecesCepilla', $expediente->getPaciente()->getVecesCepillaDiente(), ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtEdadErupcionaPrimerDiente', '¿A qué edad erupcionó el primer diente?:', ['class' => 'control-label']) !!}
							{!! Form::text('txtEdadErupcionaPrimerDiente', $expediente->getPaciente()->getEdadErupcionoPrimerDiente(), ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('ayudaAlCepillarse', '¿Alguien le ayuda a cepillarse los dientes?:', ['class' => 'control-label']) !!}
							<div class="radio">
								<label>
									@if($expediente->getPaciente()->getAlguienAyudaACepillarse() === 1)
										{!! Form::radio('ayudaAlCepillarse', 1, true, []) !!} Sí
									@else
										{!! Form::radio('ayudaAlCepillarse', 1, null, []) !!} Sí
									@endif
								</label>
							</div>

							<div class="radio">
								<label>
									@if($expediente->getPaciente()->getAlguienAyudaACepillarse() === 0)
										{!! Form::radio('ayudaAlCepillarse', 2, true, []) !!} No
									@else
										{!! Form::radio('ayudaAlCepillarse', 2, null, []) !!} No
									@endif
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtVecesCome', '¿Cuántas veces come al día?:', ['class' => 'control-label']) !!}
							{!! Form::text('txtVecesCome', $expediente->getPaciente()->getVecesComeDia(), ['class' => 'form-control']) !!}
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
									@if($expediente->getPaciente()->getHiloDental() === 1)
										{!! Form::checkbox('hiloDental', 1, true, []) !!} Hilo dental
									@else
										{!! Form::checkbox('hiloDental', 1, null, []) !!} Hilo dental
									@endif
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									@if($expediente->getPaciente()->getEnjuagueBucal() === 1)
										{!! Form::checkbox('enjuagueBucal', 1, true, []) !!} Enjuague bucal
									@else
										{!! Form::checkbox('enjuagueBucal', 1, null, []) !!} Enjuague bucal
									@endif
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									@if($expediente->getPaciente()->getLimpiadorLingual() === 1)
										{!! Form::checkbox('limpiadorLingual', 1, true, []) !!} Limpiador lingual
									@else
										{!! Form::checkbox('limpiadorLingual', 1, null, []) !!} Limpiador lingual
									@endif
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									@if($expediente->getPaciente()->getTabletasReveladoras() === 1)
										{!! Form::checkbox('tabletasReveladoras', 1, true, []) !!} Tabletas reveladoras
									@else
										{!! Form::checkbox('tabletasReveladoras', 1, null, []) !!} Tabletas reveladoras
									@endif
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									@if($expediente->getPaciente()->getOtroAuxiliar() === 1)
										{!! Form::checkbox('otroAuxiliar', 1, true, []) !!} Otro
									@else
										{!! Form::checkbox('otroAuxiliar', 1, null, []) !!} Otro
									@endif
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::text('txtEspecifiqueAuxiliar', $expediente->getPaciente()->getEspecifiqueAuxiliar(), ['class' => 'form-control', 'placeholder' => 'Especifique']) !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- fin -->