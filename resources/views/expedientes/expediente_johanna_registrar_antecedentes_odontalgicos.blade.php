<div class="tab-pane" id="antOdontalgicos">
	<div class="box-generic">
		<div class="form-group">
			<div class="col-md-5 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('primeraVisita', null, null, ['checked', 'id' => 'primeraVisita']) !!} Primera visita al dentista
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('fechaUltimoExamen', 'Fecha de último examen bucal:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-3">
				{!! Form::text('fechaUltimoExamen', '', ['class' => 'form-control fecha', 'readonly']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('motivoUltimoExamen', 'Motivo:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('motivoUltimoExamen', '', ['class' => 'primeraVisita form-control', 'readonly']) !!}
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-5 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('anestesico', null, null, ['id' => 'anestesico']) !!} Le han colocado algún tipo de anestésico
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('', '¿Tuvo mala reacción?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-5">
				<div class="radio">
					<label>
						{!! Form::radio('malaReaccion', 1, null, ['disabled', 'class' => 'malaReaccion']) !!} Sí
					</label>
				</div>

				<div class="radio">
					<label>
						{!! Form::radio('malaReaccion', 2, null, ['disabled', 'class' => 'malaReaccion']) !!} No
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('queReaccion', '¿Cuál?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('queReaccion', '', ['class' => 'form-control', 'readonly']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('traumatismo', 'Traumatismo bucal:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('traumatismo', '', ['class' => 'required form-control']) !!}
			</div>
		</div>
	</div>
</div>