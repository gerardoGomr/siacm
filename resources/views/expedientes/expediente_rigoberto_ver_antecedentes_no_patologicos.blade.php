<div class="tab-pane" id="antNoPatologicos">
	<div class="box-generic">
		<div class="form-group">
			{!! Form::label('perioricidadBanio', '¿Con qué perioricidad se baña?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				<p class="form-control-static">{{ $expediente->getExpedienteRigoberto()->getPerioricidadBanio() }} veces</p>
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('perioricidadAseoBucal', '¿Con qué perioricidad se asea la boca?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				<p class="form-control-static">{{ $expediente->getExpedienteRigoberto()->getPerioricidadHigieneBucal() }} veces</p>
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('perioricidadLavaManos', '¿Con qué perioricidad se lava las manos?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				<p class="form-control-static">{{ $expediente->getExpedienteRigoberto()->getPerioricidadLavaManos() }} veces</p>
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('frecuenciaCambiaRopa', '¿Con qué frecuencia se cambia la ropa interior?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				<p class="form-control-static">{{ $expediente->getExpedienteRigoberto()->getFrecuenciaCambioRopa() }} veces</p>
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('vecesComeDia', '¿Cuántas veces come al día?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				<p class="form-control-static">{{ $expediente->getExpedienteRigoberto()->getVecesComeDia() }} veces</p>
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('tiempoEntreComidas', '¿Cuántas horas transcurren entre comida y comida?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				<p class="form-control-static">{{ $expediente->getExpedienteRigoberto()->getTiempoEntreComidas() }} horas</p>
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('', '¿Tiene algún régimen alimenticio?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-4">
				<p class="form-control-static">{{ $expediente->getExpedienteRigoberto()->getRegimenAlimenticio() ? 'Sí' : 'No' }}</p>
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('especifiqueRegimen', '¿Cuál?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				<p class="form-control-static">{{ $expediente->getExpedienteRigoberto()->getDescripcionRegimen() }}</p>
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('horasDuerme', '¿Cuántas horas duerme al día?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				<p class="form-control-static">{{ $expediente->getExpedienteRigoberto()->getHorasDuerme() }} horas</p>
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('frecuenciaEjercicio', '¿Con qué frecuencia hace ejercicio?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				<p class="form-control-static">{{ $expediente->getExpedienteRigoberto()->getFrecuenciaEjercicio() }}</p>
			</div>
		</div>
	</div>
</div>