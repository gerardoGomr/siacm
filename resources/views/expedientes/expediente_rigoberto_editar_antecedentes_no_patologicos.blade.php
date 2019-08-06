<div class="tab-pane" id="antNoPatologicos">
	<div class="box-generic">
		<div class="form-group">
			{!! Form::label('perioricidadBanio', '¿Con qué perioricidad se baña?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-3 col-xs-12">
				{!! Form::number('perioricidadBanio', $expediente->getExpedienteRigoberto()->getPerioricidadBanio(), ['class' => 'form-control']) !!} veces al día
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('perioricidadAseoBucal', '¿Con qué perioricidad se asea la boca?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-3 col-xs-12">
				{!! Form::number('perioricidadAseoBucal', $expediente->getExpedienteRigoberto()->getPerioricidadHigieneBucal(), ['class' => 'form-control']) !!} veces al día
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('perioricidadLavaManos', '¿Con qué perioricidad se lava las manos?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-3 col-xs-12">
				{!! Form::number('perioricidadLavaManos', $expediente->getExpedienteRigoberto()->getPerioricidadLavaManos(), ['class' => 'form-control']) !!} veces al día
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('frecuenciaCambiaRopa', '¿Con qué frecuencia se cambia la ropa interior?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-3 col-xs-12">
				{!! Form::number('frecuenciaCambiaRopa', $expediente->getExpedienteRigoberto()->getFrecuenciaCambioRopa(), ['class' => 'form-control']) !!} veces al día
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('vecesComeDia', '¿Cuántas veces come al día?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-3 col-xs-12">
				{!! Form::number('vecesComeDia', $expediente->getExpedienteRigoberto()->getVecesComeDia(), ['class' => 'form-control']) !!} veces al día
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('tiempoEntreComidas', '¿Cuántas horas transcurren entre comida y comida?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-3 col-xs-12">
				{!! Form::number('tiempoEntreComidas', $expediente->getExpedienteRigoberto()->getTiempoEntreComidas(), ['class' => 'form-control']) !!} veces al día
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('regimenAlimenticio', null, $expediente->getExpedienteRigoberto()->getRegimenAlimenticio(), []) !!} Lleva régimen alimenticio
					</label>
				</div>
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('especifiqueRegimen', '¿Cuál?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-3 col-xs-12">
				{!! Form::text('especifiqueRegimen', $expediente->getExpedienteRigoberto()->getDescripcionRegimen(), ['class' => 'form-control', 'readonly' => 'readonly']) !!}
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('horasDuerme', '¿Cuántas horas duerme al día?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-3 col-xs-12">
				{!! Form::number('horasDuerme', $expediente->getExpedienteRigoberto()->getHorasDuerme(), ['class' => 'form-control']) !!} horas
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('frecuenciaEjercicio', '¿Con qué frecuencia hace ejercicio?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-3 col-xs-12">
				{!! Form::text('frecuenciaEjercicio', $expediente->getExpedienteRigoberto()->getFrecuenciaEjercicio(), ['class' => 'form-control']) !!}
			</div>
		</div>
	</div>
</div>