<div class="tab-pane" id="antPatologicos">
	<div class="box-generic">
		<div class="form-group">
			{!! Form::label('padecimientos', '¿Su hijo(a) padece o ha padecido alguna de las siguientes enfermedades o malestares?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				<div class="row">
					<?php $i = 1; ?>
					<div class="col-xs-6">
						@foreach($padecimientos as $padecimiento)
							<div class="checkbox">
								<label>
									{!! Form::checkbox('padecimiento[]', $padecimiento->getId(), null, []) !!} {{ $padecimiento->getPadecimiento() }}
								</label>
							</div>
							<?php $i++; ?>

							@if($i % 7 === 0)
								</div>
								</div>
								<div class="col-xs-6">
								<div class="form-group">
							@endif
						@endforeach
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('moretones', null, $expediente->seLeHacenMoretones(), []) !!}	Se le hacen moretones
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('transfusion', null, $expediente->haRequeridoTransfusion(), []) !!}	Ha requerido transfusión sanguínea
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('fracturas', null, $expediente->haTenidoFracturas(), []) !!}	Ha tenido fracturas
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('especifiqueFractura', '¿En donde?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('especifiqueFractura', $expediente->haTenidoFracturas() ? $expediente->getEspecifiqueFracturas() : '', ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('cirugias', null, $expediente->haSidoIntervenido(), []) !!}	Ha sido intervenido quirúrgicamente
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('especifiqueCirugia', '¿En donde?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('especifiqueCirugia', $expediente->haSidoIntervenido() ? $expediente->getEspecifiqueIntervencion() : '', ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('hospitalizado', null, $expediente->haSidoHospitalizado(), []) !!}	Ha sido hospitalizado
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('especifiqueHospitalizado', '¿Por qué?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('especifiqueHospitalizado', $expediente->haSidoHospitalizado() ? $expediente->getEspecifiqueHospitalizacion() : '', ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('tratamiento', null, $expediente->estaBajoTratamiento(), []) !!}	Está bajo tratamiento médico
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('especifiqueTratamiento', 'Especifique:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('especifiqueTratamiento', $expediente->estaBajoTratamiento() ? $expediente->getEspecifiqueTratamiento() : '', ['class' => 'form-control']) !!}
			</div>
		</div>
	</div>
</div>