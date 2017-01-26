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
						{!! Form::checkbox('moretones', null, null, []) !!}	Se le hacen moretones
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('transfusion', null, null, []) !!}	Ha requerido transfusión sanguínea
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('fracturas', null, null, []) !!}	Ha tenido fracturas
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('especifiqueFractura', '¿En donde?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('especifiqueFractura', null, ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('cirugias', null, null, []) !!}	Ha sido intervenido quirúrgicamente
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('especifiqueCirugia', '¿En donde?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('especifiqueCirugia', null, ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('hospitalizado', null, null, []) !!}	Ha sido hospitalizado
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('especifiqueHospitalizado', 'Motivo:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('especifiqueHospitalizado', null, ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('tratamiento', null, null, []) !!}	Está bajo tratamiento médico
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('especifiqueTratamiento', 'Especifique:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('especifiqueTratamiento', null, ['class' => 'form-control']) !!}
			</div>
		</div>
	</div>
</div>