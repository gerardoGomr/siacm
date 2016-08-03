<div class="tab-pane" id="antOdontalgicos">
	<div class="box-generic">
		<div class="form-group">
			<div class="col-md-5 col-md-offset-3">
				<div class="checkbox">
					<label>
						@if($expediente->getExpedienteEspecialidad()->primeraVisitaDentista())
							{!! Form::checkbox('primeraVisita', null, true, ['id' => 'primeraVisita']) !!} Primera visita al dentista
						@else
							{!! Form::checkbox('primeraVisita', null, null, ['id' => 'primeraVisita']) !!} Primera visita al dentista
						@endif
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('fechaUltimoExamen', 'Fecha de último examen bucal:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-3">
				@if($expediente->getExpedienteEspecialidad()->primeraVisitaDentista())
					{!! Form::text('fechaUltimoExamen', '', ['class' => 'form-control fecha', 'readonly']) !!}
				@else
					{!! Form::text('fechaUltimoExamen', $expediente->getExpedienteEspecialidad()->getFechaUltimoExamen(), ['class' => 'form-control fecha']) !!}
				@endif
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('motivoUltimoExamen', 'Motivo:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				@if($expediente->getExpedienteEspecialidad()->primeraVisitaDentista())
					{!! Form::text('motivoUltimoExamen', '', ['class' => 'primeraVisita form-control', 'readonly']) !!}
				@else
					{!! Form::text('motivoUltimoExamen', $expediente->getExpedienteEspecialidad()->getMotivoVisitaDentista(), ['class' => 'primeraVisita form-control']) !!}
				@endif
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-5 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('anestesico', null, $expediente->getExpedienteEspecialidad()->leHanColocadoAnestesico(), ['id' => 'anestesico']) !!} Le han colocado algún tipo de anestésico
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('', '¿Tuvo mala reacción?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-5">
				@if($expediente->getExpedienteEspecialidad()->leHanColocadoAnestesico())
					<div class="radio">
						<label>
							{!! Form::radio('malaReaccion', 1, $expediente->getExpedienteEspecialidad()->tuvoMalaReaccionAnestesico() ? true : false, ['class' => 'malaReaccion']) !!} Sí
						</label>
					</div>

					<div class="radio">
						<label>
							{!! Form::radio('malaReaccion', 2, !$expediente->getExpedienteEspecialidad()->tuvoMalaReaccionAnestesico() ? true : false, ['class' => 'malaReaccion']) !!} No
						</label>
					</div>
				@else
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
				@endif
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('queReaccion', '¿Cuál?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				@if($expediente->getExpedienteEspecialidad()->leHanColocadoAnestesico() && $expediente->getExpedienteEspecialidad()->tuvoMalaReaccionAnestesico())
					{!! Form::text('queReaccion', $expediente->getExpedienteEspecialidad()->getReaccionAnestesico(), ['class' => 'form-control']) !!}
				@else
					{!! Form::text('queReaccion', '', ['class' => 'form-control', 'readonly']) !!}
				@endif
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('traumatismo', 'Traumatismo bucal:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('traumatismo', $expediente->getExpedienteEspecialidad()->getTraumatismoBucal() ?? '', ['class' => 'required form-control']) !!}
			</div>
		</div>
	</div>
</div>