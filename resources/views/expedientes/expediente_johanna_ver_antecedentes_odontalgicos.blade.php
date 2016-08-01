<?php
use Siacme\Aplicacion\Fecha;
?>
<div class="tab-pane" id="antOdontalgicos">
	<div class="box-generic">
		<div class="form-group">
			{!! Form::label('', 'Primera visita al dentista:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-4">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->primeraVisitaDentista() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('fechaUltimoExamen', 'Fecha de último examen bucal:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-3">
				<p class="form-control-static">{{ !$expediente->getExpedienteEspecialidad()->primeraVisitaDentista() ? Fecha::convertir($expediente->getExpedienteEspecialidad()->getFechaUltimoExamenBucal()) : '-' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('motivoUltimoExamen', 'Motivo:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				<p class="form-control-static">{{ !$expediente->getExpedienteEspecialidad()->primeraVisitaDentista() ? $expediente->getExpedienteEspecialidad()->getMotivoVisitaDentista() : '-' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('', 'Le han colocado anestésico:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-4">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->leHanColocadoAnestesico() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('', 'Tuvo mala reacción:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-4">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->leHanColocadoAnestesico() && $expediente->getExpedienteEspecialidad()->tuvoMalaReaccionAnestesico() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('queReaccion', '¿Cuál?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->leHanColocadoAnestesico() && $expediente->getExpedienteEspecialidad()->tuvoMalaReaccionAnestesico() ? $expediente->getExpedienteEspecialidad()->getReaccionAnestesico() : '-' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('traumatismo', 'Traumatismo bucal:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->getTraumatismoBucal() ?? '-' }}</p>
			</div>
		</div>
	</div>
</div>