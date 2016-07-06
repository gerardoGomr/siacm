<!-- antecedentes higieneBucodental -->
<div class="tab-pane" id="higieneBucodental">
	<div class="row">
		<div class="col-md-12 col-lg-6">
			<div class="box-generic">
				<div class="row">
					<div class="col-xs-6">
						<p class="strong">Tipo de cepillo dental:</p>
						<p>
							@if($expediente->getPaciente()->getTipoCepilloAdulto() === 1)
								Adultos
							@else
								Niños
							@endif
						</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">Marca de pasta dental:</p>
						<p>{{ !is_null($expediente->getPaciente()->getMarcaPasta()) ? $expediente->getPaciente()->getMarcaPasta()->getMarcaPasta() : '--' }}</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">¿Cuántas veces cepilla los dientes del niño(a) al día?:</p>
						<p>{{ $expediente->getPaciente()->getVecesCepillaDiente() }}</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">¿A qué edad erupcionó el primer diente?:</p>
						<p>{{ $expediente->getPaciente()->getEdadErupcionoPrimerDiente() }}</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">¿Alguien le ayuda a cepillarse los dientes?:</p>
						<p>
							@if($expediente->getPaciente()->getAlguienAyudaACepillarse() === 1)
								Sí
							@else
								No
							@endif
						</p>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							<p class="strong">¿Cuántas veces come al día?:</p>
							<p>{{ $expediente->getPaciente()->getVecesComeDia() }}</p>
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
						<p class="strong">Hilo dental:</p>
						<p>
							@if($expediente->getPaciente()->getHiloDental() === 1)
								Sí
							@else
								No
							@endif
						</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">Enjuague bucal:</p>
						<p>
							@if($expediente->getPaciente()->getEnjuagueBucal() === 1)
								Sí
							@else
								No
							@endif
						</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">Limpiador lingual:</p>
						<p>
							@if($expediente->getPaciente()->getLimpiadorLingual() === 1)
								Sí
							@else
								No
							@endif
						</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">Tabletas reveladoras:</p>
						<p>
							@if($expediente->getPaciente()->getTabletasReveladoras() === 1)
								Sí
							@else
								No
							@endif
						</p>
					</div>

					<div class="col-xs-6">
						<p class="strong">Otro:</p>
						<p>
							@if($expediente->getPaciente()->getOtroAuxiliar() === 1)
								Sí
							@else
								No
							@endif
						</p>
					</div>

					<div class="col-xs-6">
						<p>{{ $expediente->getPaciente()->getEspecifiqueAuxiliar() }}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- fin -->