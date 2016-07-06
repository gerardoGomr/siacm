<!-- antecedentes heredofamiliares -->
<div class="tab-pane" id="antHeredofamiliares">
	<div class="row">
		<div class="col-md-12 col-lg-6">
			<div class="box-generic">
				<div class="row">
					<div class="col-xs-6">
						<p class="strong">Madre:</p>
						<p>
							@if($expediente->getPaciente()->getViveMadre() === 1)
								Viva
							@else
								Finada
							@endif
						</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">Si es finada, causa de muerte:</p>
						<p>{{ $expediente->getPaciente()->getCausaMuerteMadre() }}</p>
					</div>

					<div class="col-xs-12">
						<p class="strong">Enfermedades que padece o padeció:</p>
						<p>{{ $expediente->getPaciente()->getEnfermedadesMadre() }}</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">Padre:</p>
						<p>
							@if($expediente->getPaciente()->getVivePadre() === 1)
								Vivo
							@else
								Finado
							@endif
						</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">Si es finado, causa de muerte:</p>
						<p>{{ $expediente->getPaciente()->getCausaMuertePadre() }}</p>
					</div>

					<div class="col-xs-12">
						<p class="strong">Enfermedades que padece o padeció:</p>
						<p>{{ $expediente->getPaciente()->getEnfermedadesPadre() }}</p>
					</div>
				</div>
			</div>

			<div class="box-generic">
				<div class="row">
					<div class="col-xs-12">
						<p class="strong">Enfermedades abuelos paternos:</p>
						<p>{{ $expediente->getPaciente()->getEnfermedadesAbuelosPaternos() }}</p>
					</div>

					<div class="col-xs-12">
						<p class="strong">Enfermedades abuelos maternos:</p>
						<p>{{ $expediente->getPaciente()->getEnfermedadesAbuelosMaternos() }}</p>
					</div>
				</div>
			</div>

		</div>

		<div class="col-md-12 col-lg-6">
			<div class="box-generic">
				<div class="row">
					<div class="col-xs-6">
						<p class="strong">Número de hermanos:</p>
						<p>{{ $expediente->getPaciente()->getNumHermanos() }}</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">Vivos:</p>
						<p>{{ $expediente->getPaciente()->getNumHermanosVivos() }}</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">Finados:</p>
						<p>{{ $expediente->getPaciente()->getNumHermanosFinados() }}</p>
					</div>

					<div class="col-xs-12">
						<p class="strong">Nombres y Edades:</p>
						<p>{{ $expediente->getPaciente()->getNombreEdadesHermanos() }}</p>
					</div>

					<div class="col-xs-12">
						<p class="strong">Enfermedades que padecen o padecieron:</p>
						<p>{{ $expediente->getPaciente()->getEnfermedadesHermanos() }}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- fin -->