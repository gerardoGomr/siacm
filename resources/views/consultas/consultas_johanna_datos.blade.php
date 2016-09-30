<div class="tab-pane active" id="consulta">
	<div class="innerAll">
		<button type="button" id="btnGuardarConsulta" class="btn btn-primary btn-small"><i class="fa fa-save"></i> Guardar consulta</button>
		<a href="#dvRecetas" id="btnReceta" class="btn btn-danger btn-small" data-toggle="modal"><i class="fa fa-edit"></i> Generar receta</a>
		<a href="#dvInterconsulta" id="btnInterconsulta" class="btn btn-warning btn-small" data-toggle="modal"><i class="fa fa-user-md"></i> Enviar a interconsulta</a>
	</div>
	<div class="separator"></div>
	<div class="row">
		<div class="col-md-6 col-lg-6">
			<div class="innerAll">
				<div class="box-generic">
					<div class="form-group">
						<label class="control-label col-md-3" for="peso">Peso:</label>
						<div class="col-md-3">
							<div class="input-group">
								<input type="text" name="peso" id="peso" value="" placeholder="" class="required numerosFlotantes form-control">
								<span class="input-group-addon">Kg.</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3" for="talla">Talla:</label>
						<div class="col-md-3">
							<div class="input-group">
								<input type="text" name="talla" id="talla" value="" placeholder="" class="required numerosFlotantes form-control">
								<span class="input-group-addon">m.</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3" for="pulso">Pulso:</label>
						<div class="col-md-3">
							<input type="text" name="pulso" id="pulso" value="" placeholder="" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3" for="temperatura">Temperatura:</label>
						<div class="col-md-3">
							<div class="input-group">
								<input type="text" name="temperatura" id="temperatura" value="" placeholder="" class="required numerosFlotantes form-control">
								<span class="input-group-addon">°C</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3" for="tension">Tensión arterial:</label>
						<div class="col-md-4">
							<div class="input-group">
								<input type="text" name="tension" id="tension" value="" placeholder="" class="form-control">
								<span class="input-group-addon">mm/Hg</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3" for="padecimiento">Padecimiento actual:</label>
						<div class="col-md-8">
							<textarea name="padecimiento" id="padecimiento" class="required form-control" rows="8"></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3" for="interrogatorio">Interrogatorio por aparatos y sistemas:</label>
						<div class="col-md-8">
							<textarea name="interrogatorio" id="interrogatorio" class="required form-control" rows="8"></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6 col-lg-6">
			<div class="innerAll">
				<div class="box-generic">
					<div class="form-group">
						<label class="control-label col-md-3" for="nota">Nota médica:</label>
						<div class="col-md-8">
							<textarea name="nota" id="nota" class="required form-control" rows="8"></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3">Comportamiento Frankl</label>
						<div class="col-md-3">
							@foreach ($comportamientosFrankl as $comportamientoFrankl)
								<div class="radio">
									<label>
										<input type="radio" name="comportamientoFrankl" value="{{ $comportamientoFrankl->getId() }}" class="required"> {{ $comportamientoFrankl->getComportamientoFrankl() }}
									</label>
								</div>
							@endforeach
						</div>
					</div>

					<div class="form-group">
						<label for="consultaCosto" class="control-label col-md-3">Cuotas:</label>
						<div class="col-md-8">
						@foreach($consultaCostos as $consultaCosto)
							<?php
							$checked = '';
							$disabled = '';
							?>
							@if($expediente->getExpedienteEspecialidad()->primeraVez())
								@if($consultaCosto->asignadoAPrimeraVez())
									<?php $checked = 'checked' ?>
								@else
									<?php $disabled = 'disabled' ?>
								@endif
							@endif
							<div class="checkbox">
								<label>
									<input type="checkbox" name="consultaCosto[]" class="consultaCosto" data-id="{{ $consultaCosto->getId() }}" {!! $checked . ' ' . $disabled !!} data-value="{{ $consultaCosto->getCosto() }}"> {{  $consultaCosto->getConcepto() . ' - ' . $consultaCosto->costo() }}
								</label>
							</div>
						@endforeach
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3" for="costoAsignadoConsulta">Costo Total:</label>
						<div class="col-md-3">
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input type="text" name="costoAsignadoConsulta" id="costoAsignadoConsulta" placeholder="0.00" class="form-control required numerosFlotantes" value="0">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>