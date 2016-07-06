<!-- antecedentes heredofamiliares -->
<div class="tab-pane" id="antOdontopatologicos">
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="box-generic">
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									@if($expediente->getPaciente()->getHaPresentadoDolorBoca() === 1)
										{!! Form::checkbox('dolorBoca', 1, true, []) !!} ¿Ha presentado dolor en la boca?
									@else
										{!! Form::checkbox('dolorBoca', 1, null, []) !!} ¿Ha presentado dolor en la boca?
									@endif
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									@if($expediente->getPaciente()->getHaNotadoSangradoEncias() === 1)
										{!! Form::checkbox('sangradoEncias', 1, true, []) !!} ¿Ha notado sangrado en las encías?
									@else
										{!! Form::checkbox('sangradoEncias', 1, null, []) !!} ¿Ha notado sangrado en las encías?
									@endif
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									@if($expediente->getPaciente()->getPresentaMalOlorBoca() === 1)
										{!! Form::checkbox('malOlor', 1, true, []) !!} ¿Presenta mal olor o mal sabor en la boca?
									@else
										{!! Form::checkbox('malOlor', 1, null, []) !!} ¿Presenta mal olor o mal sabor en la boca?
									@endif
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									@if($expediente->getPaciente()->getSienteDienteFlojo() === 1)
										{!! Form::checkbox('dienteFlojo', 1, true, []) !!} ¿Siente que algún diente está flojo?
									@else
										{!! Form::checkbox('dienteFlojo', 1, null, []) !!} ¿Siente que algún diente está flojo?
									@endif
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- fin -->