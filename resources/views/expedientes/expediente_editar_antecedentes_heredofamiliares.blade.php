<div class="tab-pane" id="antHeredofamiliares">
	<div class="box-generic">
		<div class="form-group">
			{!! Form::label('viveMadre', '*Madre:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-4">
				<div class="radio">
					<label>
						{!! Form::radio('viveMadre', 1, !is_null($expediente) ? $expediente->viveMadre() : '', ['class' => 'viveMadre']) !!} Viva
					</label>
				</div>

				<div class="radio">
					<label>
						{!! Form::radio('viveMadre', 2, !is_null($expediente) && !$expediente->viveMadre() ? true: false, ['class' => 'viveMadre']) !!} Finada
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('causaMuerteMadre', 'Si es finada, causa de muerte:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				@if(!is_null($expediente) && $expediente->viveMadre())
					{!! Form::text('causaMuerteMadre', '', ['class' => 'form-control', 'readonly' => 'readonly']) !!}
				@else
					{!! Form::text('causaMuerteMadre', !is_null($expediente) ? $expediente->getCausaMuerteMadre() : '', ['class' => 'form-control']) !!}
				@endif
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('enfermedadesMadre', '*Enfermedades que padece o padeció:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('enfermedadesMadre', !is_null($expediente) ? $expediente->getEnfermedadesMadre() : '', ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('vivePadre', '*Padre:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-4">
				<div class="radio">
					<label>
						{!! Form::radio('vivePadre', 1, !is_null($expediente) ? $expediente->vivePadre() : '', ['class' => 'vivePadre']) !!} Vivo
					</label>
				</div>

				<div class="radio">
					<label>
						{!! Form::radio('vivePadre', 2, !is_null($expediente) && !$expediente->vivePadre() ? true: false, ['class' => 'vivePadre']) !!} Finado
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('causaMuertePadre', 'Si es finado, causa de muerte:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				@if(!is_null($expediente) && $expediente->vivePadre())
					{!! Form::text('causaMuertePadre', '', ['class' => 'form-control', 'readonly' => 'readonly']) !!}
				@else
					{!! Form::text('causaMuertePadre', !is_null($expediente) ? $expediente->getCausaMuertePadre() : '', ['class' => 'form-control']) !!}
				@endif
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('enfermedadesPadre', '*Enfermedades que padece o padeció:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('enfermedadesPadre', !is_null($expediente) ? $expediente->getEnfermedadesPadre() : '', ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('enfermedadesAbuelosPaternos', '*Enfermedades abuelos paternos:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::textarea('enfermedadesAbuelosPaternos', !is_null($expediente) ? $expediente->getEnfermedadesAbuelosPaternos() : '', ['class' => 'form-control', 'rows' => '6']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('enfermedadesAbuelosMaternos', '*Enfermedades abuelos maternos:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::textarea('enfermedadesAbuelosMaternos', !is_null($expediente) ? $expediente->getEnfermedadesAbuelosMaternos() : '', ['class' => 'form-control', 'rows' => '6']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('numHermanos', '*Número de hermanos:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-2">
				{!! Form::text('numHermanos', !is_null($expediente) ? $expediente->getNumHermanos() : '', ['class' => 'numerosEnteros form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('numHermanosVivos', '*Vivos:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-2">
				{!! Form::text('numHermanosVivos', !is_null($expediente) ? $expediente->getNumHermanosVivos() : '', ['class' => 'numerosEnteros form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('numHermanosFinados', '*Finados:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-2">
				{!! Form::text('numHermanosFinados', !is_null($expediente) ? $expediente->getNumHermanosFinados() : '', ['class' => 'numerosEnteros form-control', 'readonly' => 'readonly']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('nombresEdades', '*Nombres y Edades:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::textarea('nombresEdades', !is_null($expediente) ? $expediente->getNombresEdadesHermanos() : '', ['class' => 'form-control', 'rows' => '6']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('enfermedadesHermanos', '*Enfermedades que padecen o padecieron:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::textarea('enfermedadesHermanos', !is_null($expediente) ? $expediente->getEnfermedadesHermanos() : '', ['class' => 'form-control', 'rows' => '6']) !!}
			</div>
		</div>
	</div>
</div>
