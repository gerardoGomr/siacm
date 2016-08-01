<?php
	use Siacme\Dominio\Expedientes\MarcaPasta;
?>
<div class="tab-pane" id="higieneBucodental">
	<div class="box-generic">
		<div class="form-group">
			{!! Form::label('tipoCepillo', 'Tipo de cepillo dental:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-5">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->getTipoCepillo() === 1 ? 'Adulto' : 'Infantil' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('marcaPasta', 'Marca de pasta dental:', ['class' => 'control-label col-md-3']) !!}
			<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->getTipoCepillo() === MarcaPasta::INFANTIL ? 'Infantil' : 'Adulto' }}</p>
		</div>
		<div class="form-group">
			{!! Form::label('vecesCepilla', '¿Cuántas veces cepilla los dientes del niño(a) al día?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-3">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->getVecesCepillaDiente() }} veces</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('edadErupcionaPrimerDiente', '¿A qué edad erupcionó el primer diente?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-2">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->getEdadErupcionoPrimerDiente() ?? '-' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('', 'Alguien ayuda al cepillarse:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-5">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->alguienAyudaACepillarse() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('vecesCome', '¿Cuántas veces come al día?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-3">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->getVecesComeDia() }} veces</p>
			</div>
		</div>
	</div>
	<div class="box-generic">
		<h4 class="heading">Auxiliares</h4>
		<div class="form-group">
			{!! Form::label('', 'Hilo dental:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-4">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->hiloDental() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('', 'Enjuague bucal:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-4">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->enjuagueBucal() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('', 'Limpiador lingual:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-4">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->limpiadorLingual() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('', 'Tabletas reveladoras:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-4">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->tabletasReveladoras() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('', 'Otro:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-4">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->otroAuxiliar() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('', 'Especifique qué auxiliar:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				<p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->getEspecifiqueAuxiliar() ?? '-' }}</p>
			</div>
		</div>
	</div>
</div>