<div class="tab-pane" id="antHeredofamiliares">
	<div class="box-generic">
		<div class="form-group">
			{!! Form::label('viveMadre', '*Madre:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-4">
				<div class="radio">
					<label>
						{!! Form::radio('viveMadre', 1, null, ['class' => 'viveMadre']) !!} Viva
					</label>
				</div>

				<div class="radio">
					<label>
						{!! Form::radio('viveMadre', 2, null, ['class' => 'viveMadre']) !!} Finada
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('causaMuerteMadre', 'Si es finada, causa de muerte:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('causaMuerteMadre', '', ['class' => 'form-control', 'readonly' => 'readonly']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('enfermedadesMadre', '*Enfermedades que padece o padeció:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('enfermedadesMadre', '', ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('vivePadre', '*Padre:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-4">
				<div class="radio">
					<label>
						{!! Form::radio('vivePadre', 1, null, ['class' => 'vivePadre']) !!} Vivo
					</label>
				</div>

				<div class="radio">
					<label>
						{!! Form::radio('vivePadre', 2, null, ['class' => 'vivePadre']) !!} Finado
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('causaMuertePadre', 'Si es finado, causa de muerte:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('causaMuertePadre', '', ['class' => 'form-control', 'readonly' => 'readonly']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('enfermedadesPadre', '*Enfermedades que padece o padeció:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('enfermedadesPadre', '', ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('enfermedadesAbuelosPaternos', '*Enfermedades abuelos paternos:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::textarea('enfermedadesAbuelosPaternos', null, ['class' => 'form-control', 'rows' => '6']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('enfermedadesAbuelosMaternos', '*Enfermedades abuelos maternos:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::textarea('enfermedadesAbuelosMaternos', null, ['class' => 'form-control', 'rows' => '6']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('numHermanos', '*Número de hermanos:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-2">
				{!! Form::text('numHermanos', null, ['class' => 'numerosEnteros form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('numHermanosVivos', '*Vivos:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-2">
				{!! Form::text('numHermanosVivos', null, ['class' => 'numerosEnteros form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('numHermanosFinados', '*Finados:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-2">
				{!! Form::text('numHermanosFinados', null, ['class' => 'numerosEnteros form-control', 'readonly' => 'readonly']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('nombresEdades', '*Nombres y Edades:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::textarea('nombresEdades', null, ['class' => 'form-control', 'rows' => '6']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('enfermedadesHermanos', '*Enfermedades que padecen o padecieron:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::textarea('enfermedadesHermanos', null, ['class' => 'form-control', 'rows' => '6']) !!}
			</div>
		</div>
	</div>
</div>
