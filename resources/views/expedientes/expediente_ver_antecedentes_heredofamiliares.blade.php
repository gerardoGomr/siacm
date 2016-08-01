<div class="tab-pane" id="antHeredofamiliares">
	<div class="box-generic">
		<div class="form-group">
			{!! Form::label('viveMadre', 'Vive madre:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-4">
				<p class="form-control-static">{{ $expediente->viveMadre() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('causaMuerteMadre', 'Si es finada, causa de muerte:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				<p class="form-control-static">{{ !$expediente->viveMadre() ? $expediente->getCausaMuerteMadre() : '-' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('enfermedadesMadre', 'Enfermedades que padece o padeció:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				<p class="form-control-static">{{ $expediente->getEnfermedadesMadre() }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('vivePadre', 'Vive padre:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-4">
				<p class="form-control-static">{{ $expediente->vivePadre() ? 'Sí' : 'No' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('causaMuertePadre', 'Si es finado, causa de muerte:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				<p class="form-control-static">{{ !$expediente->vivePadre() ? $expediente->getCausaMuertePadre() : '-' }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('enfermedadesPadre', 'Enfermedades que padece o padeció:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				<p class="form-control-static">{{ $expediente->getEnfermedadesPadre() }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('enfermedadesAbuelosPaternos', 'Enfermedades abuelos paternos:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				<p class="form-control-static">{{ $expediente->getEnfermedadesAbuelosPaternos() }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('enfermedadesAbuelosMaternos', 'Enfermedades abuelos maternos:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				<p class="form-control-static">{{ $expediente->getEnfermedadesAbuelosMaternos() }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('numHermanos', 'Número de hermanos:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-2">
				<p class="form-control-static">{{ $expediente->getNumHermanos() }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('numHermanosVivos', 'Vivos:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-2">
				<p class="form-control-static">{{ $expediente->getNumHermanosVivos() }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('numHermanosFinados', 'Finados:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-2">
				<p class="form-control-static">{{ $expediente->getNumHermanosFinados() }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('nombresEdades', 'Nombres y Edades:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				<p class="form-control-static">{{ $expediente->getNombresEdadesHermanos() }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('enfermedadesHermanos', 'Enfermedades que padecen o padecieron:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				<p class="form-control-static">{{ $expediente->getEnfermedadesHermanos() }}</p>
			</div>
		</div>
	</div>
</div>