<div class="tab-pane" id="antHeredofamiliares">
	<div class="box-generic">
		<div class="form-group">
			{!! Form::label('viveMadre', '*Madre:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-4">
				<div class="radio">
					<label>
						{!! Form::radio('viveMadre', 1, $expediente->viveMadre(), ['class' => 'required viveMadre']) !!} Viva
					</label>
				</div>

				<div class="radio">
					<label>
						{!! Form::radio('viveMadre', 2, !$expediente->viveMadre() ? true: false, ['class' => 'required viveMadre']) !!} Finada
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('causaMuerteMadre', 'Si es finada, causa de muerte:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				@if($expediente->viveMadre())
					{!! Form::text('causaMuerteMadre', '', ['class' => 'form-control', 'readonly' => 'readonly']) !!}
				@else
					{!! Form::text('causaMuerteMadre', $expediente->getCausaMuerteMadre(), ['class' => 'form-control']) !!}
				@endif
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('enfermedadesMadre', '*Enfermedades que padece o padeció:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('enfermedadesMadre', $expediente->getEnfermedadesMadre(), ['class' => 'required form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('vivePadre', '*Padre:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-4">
				<div class="radio">
					<label>
						{!! Form::radio('vivePadre', 1, $expediente->vivePadre(), ['class' => 'required vivePadre']) !!} Vivo
					</label>
				</div>

				<div class="radio">
					<label>
						{!! Form::radio('vivePadre', 2, !$expediente->vivePadre() ? true: false, ['class' => 'required vivePadre']) !!} Finado
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('causaMuertePadre', 'Si es finado, causa de muerte:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				@if($expediente->vivePadre())
					{!! Form::text('causaMuertePadre', '', ['class' => 'form-control', 'readonly' => 'readonly']) !!}
				@else
					{!! Form::text('causaMuertePadre', $expediente->getCausaMuertePadre(), ['class' => 'form-control']) !!}
				@endif
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('enfermedadesPadre', '*Enfermedades que padece o padeció:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('enfermedadesPadre', $expediente->getEnfermedadesPadre(), ['class' => 'required form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('enfermedadesAbuelosPaternos', '*Enfermedades abuelos paternos:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::textarea('enfermedadesAbuelosPaternos', $expediente->getEnfermedadesAbuelosPaternos(), ['class' => 'required form-control', 'rows' => '6']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('enfermedadesAbuelosMaternos', '*Enfermedades abuelos maternos:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::textarea('enfermedadesAbuelosMaternos', $expediente->getEnfermedadesAbuelosMaternos(), ['class' => 'required form-control', 'rows' => '6']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('numHermanos', '*Número de hermanos:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-2">
				{!! Form::text('numHermanos', $expediente->getNumHermanos(), ['class' => 'required numerosEnteros form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('numHermanosVivos', '*Vivos:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-2">
				{!! Form::text('numHermanosVivos', $expediente->getNumHermanosVivos(), ['class' => 'required numerosEnteros form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('numHermanosFinados', '*Finados:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-2">
				{!! Form::text('numHermanosFinados', $expediente->getNumHermanosFinados(), ['class' => 'required numerosEnteros form-control', 'readonly' => 'readonly']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('nombresEdades', '*Nombres y Edades:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::textarea('nombresEdades', $expediente->getNombresEdadesHermanos(), ['class' => 'required form-control', 'rows' => '6']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('enfermedadesHermanos', '*Enfermedades que padecen o padecieron:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::textarea('enfermedadesHermanos', $expediente->getEnfermedadesHermanos(), ['class' => 'required form-control', 'rows' => '6']) !!}
			</div>
		</div>
	</div>
</div>