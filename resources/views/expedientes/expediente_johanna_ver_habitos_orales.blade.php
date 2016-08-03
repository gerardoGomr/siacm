<div class="tab-pane" id="habitosOrales">
	<div class="box-generic">
		<div class="form-group">
			{!! Form::label('', 'Succión digital:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-5">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->succionDigital() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('', 'Succión lingual:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-5">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->succionLingual() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('', 'Biberón:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-5">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->biberon() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('', 'Bruxismo:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-5">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->bruxismo() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('', 'Succión labial:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-5">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->succionLabial() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('', 'Respiración bucal:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-5">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->respiracionBucal() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('', 'Onicofagia:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-5">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->onicofagia() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('', 'Chupón:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-5">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->chupon() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('', 'Otro hábito:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-5">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->otroHabito() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('', 'Descripción:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-5">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->getDescripcionHabito() ?? '-' }}</p>
			</div>
		</div>
	</div>
</div>