<!-- antecedentes personales patologicos -->
<div class="tab-pane" id="antPatologicos">
	<div class="row">
		<div class="col-md-12 col-lg-6">
			<div class="box-generic">
				<div class="row">
					<p class="strong">¿Su hijo(a) padece o ha padecido alguna de las siguientes enfermedades o malestares?:</p>
					<div class="col-xs-6">
						@if(!is_null($expediente->getPaciente()->getListaPadecimientos()))
							<ul>
								@foreach($expediente->getPaciente()->getListaPadecimientos() as $padecimiento)
									<li>{{ $padecimiento->getPadecimiento() }}</li>
								@endforeach
							</ul>
						@else
							<p>Sin padecimientos registrados</p>
						@endif
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12 col-lg-6">
			<div class="box-generic">
				<div class="row">
					<div class="col-xs-6">
						<p><span class="strong">Se le hacen moretones:</span> {{ $expediente->getPaciente()->getSeLeHacenMoretones() === 1 ? 'Sí' : 'No' }}</p>
						<p><span class="strong">Ha requerido transfusión sanguínea:</span> {{ $expediente->getPaciente()->getHaTenidoFracturas() === 1 ? 'Sí' : 'No' }}</p>
						<p><span class="strong">Ha tenido fracturas:</span>{{ $expediente->getPaciente()->getHaTenidoFracturas() === 1 ? 'Sí' : 'No' }}</p>
						<p>{{ $expediente->getPaciente()->getEspecifiqueFracturas() }}</p>

						<div class="separator"></div>

						<p><span class="strong">Ha sido intervenido quirúrgicamente:</span>{{ $expediente->getPaciente()->getHaSidoIntervenido() === 1 ? 'Sí' : 'No' }}</p>
						<p>{{ $expediente->getPaciente()->getEspecifiqueIntervencion() }}</p>

						<div class="separator"></div>

						<p><span class="strong">Ha sido hospitalizado:</span>{{ $expediente->getPaciente()->getHaSidoHospitalizado() === 1 ? 'Sí' : 'No' }}</p>
						<p>{{ $expediente->getPaciente()->getEspecifiqueHospitalizacion() }}</p>
					</div>

					<div class="col-xs-6">
						<p><span class="strong">Ex-fumador:</span>{{ $expediente->getPaciente()->getExFumador() === 1 ? 'Sí' : 'No' }}</p>
						<p><span class="strong">Ex-alcohólico:</span>{{ $expediente->getPaciente()->getExAlcoholico() === 1 ? 'Sí' : 'No' }}</p>
						<p><span class="strong">Ex-adicto:</span>{{ $expediente->getPaciente()->getExAdicto() === 1 ? 'Sí' : 'No' }}</p>
					</div>

					<div class="col-xs-6">
						<p><span class="strong">Está bajo tratamiento:</span>{{ $expediente->getPaciente()->getEstaBajoTratamiento() === 1 ? 'Sí' : 'No' }}</p>
						<p>{{ $expediente->getPaciente()->getEspecifiqueTratamiento() }}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- fin -->