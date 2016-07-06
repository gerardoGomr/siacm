<!-- antecedentes heredofamiliares -->
<div class="tab-pane" id="antOdontopatologicos">
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="box-generic">
				<div class="row">
					<div class="col-xs-6">
						<p class="strong">¿Ha presentado dolor en la boca?</p>
						<p>
							@if($expediente->getPaciente()->getHaPresentadoDolorBoca() === 1)
								Sí
							@else
								No
							@endif
						</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">¿Ha notado sangrado en las encías?</p>
						<p>
							@if($expediente->getPaciente()->getHaNotadoSangradoEncias() === 1)
								Sí
							@else
								No
							@endif
						</p>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-6">
						<p class="strong">¿Presenta mal olor o mal sabor en la boca?</p>
						<p>
							@if($expediente->getPaciente()->getPresentaMalOlorBoca() === 1)
								Sí
							@else
								No
							@endif
						</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">¿Siente que algún diente está flojo?</p>
						<p>
							@if($expediente->getPaciente()->getSienteDienteFlojo() === 1)
								Sí
							@else
								No
							@endif
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- fin -->