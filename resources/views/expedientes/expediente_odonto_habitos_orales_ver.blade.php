<!-- antecedentes higieneBucodental -->
<div class="tab-pane" id="habitosOrales">
	<div class="box-generic">
		<div class="row">
			<div class="col-xs-4">
				<p class="strong">Succión digital (se chupa el dedo):</p>
				<p>
					@if($expediente->getPaciente()->getSuccionDigital() === 1)
						Sí
					@else
						No
					@endif
				</p>
			</div>

			<div class="col-xs-4">
				<p class="strong">Succión lingual (se chupa la lengua):</p>
				<p>
					@if($expediente->getPaciente()->getSuccionLingual() === 1)
						Sí
					@else
						No
					@endif
				</p>
			</div>

			<div class="col-xs-4">
				<p class="strong">Biberón:</p>
				<p>
					@if($expediente->getPaciente()->getBiberon() === 1)
						Sí
					@else
						No
					@endif
				</p>
			</div>

			<div class="col-xs-4">
				<p class="strong">Bruxismo (rechina los dientes):</p>
				<p>
					@if($expediente->getPaciente()->getBruxismo() === 1)
						Sí
					@else
						No
					@endif
				</p>
			</div>

			<div class="col-xs-4">
				<p class="strong">Succión labial (se chupa el labio):</p>
				<p>
					@if($expediente->getPaciente()->getSuccionLabial() === 1)
						Sí
					@else
						No
					@endif
				</p>
			</div>

			<div class="col-xs-4">
				<p class="strong">Respiración bucal:</p>
				<p>
					@if($expediente->getPaciente()->getRespiracionBucal() === 1)
						Sí
					@else
						No
					@endif
				</p>
			</div>

			<div class="col-xs-4">
				<p class="strong">Onicofagia:</p>
				<p>
					@if($expediente->getPaciente()->getOnicofagia() === 1)
						Sí
					@else
						No
					@endif
				</p>
			</div>

			<div class="col-xs-4">
				<p class="strong">Chupón:</p>
				<p>
					@if($expediente->getPaciente()->getChupon() === 1)
						Sí
					@else
						No
					@endif
				</p>
			</div>

			<div class="col-xs-4">
				<p class="strong">Otro hábito:</p>
				<p>
					@if($expediente->getPaciente()->getOtroHabito() === 1)
						Sí
					@else
						No
					@endif
				</p>
			</div>

			<div class="col-xs-4">
				<p>{{ $expediente->getPaciente()->getDescripcionHabito() }}</p>
			</div>
		</div>
	</div>
</div>
<!-- fin -->