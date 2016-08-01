<div class="tab-pane" id="antOdontopatologicos">
	<div class="box-generic">
		<div class="form-group">
			{!! Form::label('', 'Ha presentado dolor de boca:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-4">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->haPresentadoDolorBoca() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('', 'Ha notado sangrado en las encías:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-4">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->haNotadoSangradoEncias() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('', 'Presenta mal olor o mal sabor en la boca:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-4">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->presentaMalOlorBoca() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('', 'Siente que algún diente está flojo:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-4">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->sienteDienteFlojo() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
	</div>
</div>