<?php
$expedienteEspecialidad = $expediente->getExpedienteEspecialidad() != null ? $expediente->getExpedienteEspecialidad() : $expediente->getExpedienteRigoberto()
?>
<div class="tab-pane" id="antPatologicos">
	<div class="box-generic">
		<div class="form-group">
			{!! Form::label('', 'Padece:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				@if($expediente->tienePadecimientos())
					@foreach($expediente->getPadecimientos() as $padecimiento)
						<p class="form-control-static">{{ $padecimiento->getPadecimiento() }}</p>
					@endforeach
				@endif
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('', 'Se le hacen moretones:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-4">
				<p class="form-control-static">{{ $expediente->seLeHacenMoretones() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('', 'Ha requerido transfusión sanguínea:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-4">
				<p class="form-control-static">{{ $expediente->haRequeridoTransfusion() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('', 'Ha tenido fracturas:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-4">
				<p class="form-control-static">{{ $expediente->haTenidoFracturas() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('especifiqueFractura', '¿En donde?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				<p class="form-control-static">{{ $expediente->haTenidoFracturas() ? $expediente->getEspecifiqueFracturas() : '-' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('', 'Ha sido intervenido quirúrgicamente:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-4">
				<p class="form-control-static">{{ $expediente->haSidoIntervenido() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('especifiqueCirugia', '¿En donde?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				<p class="form-control-static">{{ $expediente->haSidoIntervenido() ? $expediente->getEspecifiqueIntervencion() : '-' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('', 'Ha sido hospitalizado:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-4">
				<p class="form-control-static">{{ $expediente->haSidoHospitalizado() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('especifiqueHospitalizado', 'Motivo:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				<p class="form-control-static">{{ $expediente->haSidoHospitalizado() ? $expediente->getEspecifiqueHospitalizacion() : '-' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('', 'Está bajo tratamiento médico:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-4">
				<p class="form-control-static">{{ $expediente->estaBajoTratamiento() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('especifiqueTratamiento', 'Especifique:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				<p class="form-control-static">{{ $expediente->estaBajoTratamiento() ? $expediente->getEspecifiqueTratamiento() : '-' }}</p>
			</div>
		</div>
		@if (!is_null($expediente->getExpedienteRigoberto()))
			<div class="form-group">
				{!! Form::label('', 'Ex - fumador:', ['class' => 'control-label col-md-3']) !!}
				<div class="col-md-4">
					<p class="form-control-static">{{ $expediente->exFumador() ? 'Sí' : 'No' }}</p>
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('', 'Ex - alcohólico:', ['class' => 'control-label col-md-3']) !!}
				<div class="col-md-4">
					<p class="form-control-static">{{ $expediente->exAlcoholico() ? 'Sí' : 'No' }}</p>
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('', 'Ex - adicto:', ['class' => 'control-label col-md-3']) !!}
				<div class="col-md-4">
					<p class="form-control-static">{{ $expediente->exAdicto() ? 'Sí' : 'No' }}</p>
				</div>
			</div>
		@endif
	</div>
</div>
