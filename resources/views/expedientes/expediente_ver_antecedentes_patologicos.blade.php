<div class="tab-pane" id="antPatologicos">
	<div class="box-generic">
		<div class="form-group">
			{!! Form::label('', 'Padece:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">

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
			{!! Form::label('especifiqueHospitalizado', '¿Por qué?:', ['class' => 'control-label col-md-3']) !!}
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
	</div>
</div>