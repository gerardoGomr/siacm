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
									@php
									$checked = !is_null($expediente) && $expediente->tieneElPadecimiento($padecimiento) ? 'checked' : '';
									@endphp
									{!! Form::checkbox('padecimiento[]', $padecimiento->getId(), $checked, []) !!} {{ $padecimiento->getPadecimiento() }}
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
						{!! Form::checkbox('moretones', null, !is_null($expediente) ? $expediente->seLeHacenMoretones() : '', []) !!}	Se le hacen moretones
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('transfusion', null, !is_null($expediente) ? $expediente->haRequeridoTransfusion() : '', []) !!}	Ha requerido transfusión sanguínea
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('fracturas', null, !is_null($expediente) ? $expediente->haTenidoFracturas() : '', []) !!}	Ha tenido fracturas
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('especifiqueFractura', '¿En donde?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('especifiqueFractura', !is_null($expediente) && $expediente->haTenidoFracturas() ? $expediente->getEspecifiqueFracturas() : '', ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('cirugias', null, !is_null($expediente) ? $expediente->haSidoIntervenido() : '', []) !!}	Ha sido intervenido quirúrgicamente
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('especifiqueCirugia', '¿En donde?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('especifiqueCirugia', !is_null($expediente) && $expediente->haSidoIntervenido() ? $expediente->getEspecifiqueIntervencion() : '', ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('hospitalizado', null, !is_null($expediente) ? $expediente->haSidoHospitalizado() : '', []) !!}	Ha sido hospitalizado
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('especifiqueHospitalizado', 'Motivo:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('especifiqueHospitalizado', !is_null($expediente) && $expediente->haSidoHospitalizado() ? $expediente->getEspecifiqueHospitalizacion() : '', ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('tratamiento', null, !is_null($expediente) ? $expediente->estaBajoTratamiento() : '', []) !!}	Está bajo tratamiento médico
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('especifiqueTratamiento', 'Especifique:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('especifiqueTratamiento', !is_null($expediente) && $expediente->estaBajoTratamiento() ? $expediente->getEspecifiqueTratamiento() : '', ['class' => 'form-control']) !!}
			</div>
		</div>
	</div>
</div>
