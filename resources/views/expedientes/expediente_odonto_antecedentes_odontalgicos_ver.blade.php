<!-- antecedentes heredofamiliares -->
<div class="tab-pane" id="antOdontalgicos">
	<div class="row">
		<div class="col-md-12 col-lg-6">
			<div class="box-generic">
				<div class="row">
					<div class="col-xs-6">
						<p class="strong">¿Es su primera visita al dentista?</p>
						<p>
							@if($expediente->getPaciente()->getPrimeraVisitaDentista() === 1)
								Sí
							@else
								No
							@endif
						</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">Fecha de último examen bucal:</p>
						<p>{{ $expediente->getPaciente()->getFechaUltimoExamenBucal() }}</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">Motivo:</p>
						<p>{{ $expediente->getPaciente()->getMotivoVisitaDentista() }}</p>
					</div>
				</div>
			</div>

			<div class="box-generic">
				<div class="row">
					<div class="col-xs-6">
						<p class="strong">¿Le han colocado algún tipo de anestésico?:</p>
						<p>
							@if($expediente->getPaciente()->getLeHanColocadoAnestesico() === 1)
								Sí
							@else
								No
							@endif
						</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">¿Tuvo mala reacción?:</p>
						<p>
							@if($expediente->getPaciente()->getTuvoMalaReaccionAnestesico() === 1)
								Sí
							@else
								No
							@endif
						</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">¿Cuál?:</p>
						<p>{{ $expediente->getPaciente()->getReaccionAnestesico() }}</p>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12 col-lg-6">
			<div class="box-generic">
				<p class="strong">Traumatismo bucal:</p>
				<p>{{ $expediente->getPaciente()->getTraumatismoBucal() }}</p>
			</div>
		</div>
	</div>
</div>
<!-- fin -->