<div class="tab-pane" id="habitosOrales">
	<div class="box-generic">
		<div class="form-group">
			<div class="col-md-5 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('succionDigital', null, $expediente->getExpedienteEspecialidad()->succionDigital(), []) !!} Succión digital (se chupa el dedo)
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-5 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('succionLingual', null, $expediente->getExpedienteEspecialidad()->succionLingual(), []) !!} Succión lingual (se chupa la lengua)
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-5 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('biberon', null, $expediente->getExpedienteEspecialidad()->biberon(), []) !!} Biberón
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-5 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('bruxismo', null, $expediente->getExpedienteEspecialidad()->bruxismo(), []) !!} Bruxismo (rechina los dientes)
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-5 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('succionLabial', null, $expediente->getExpedienteEspecialidad()->succionLabial(), []) !!} Succión labial (se chupa el labio)
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-5 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('respiracionBucal', null, $expediente->getExpedienteEspecialidad()->respiracionBucal(), []) !!} Respiración Bucal
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-5 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('onicofagia', null, $expediente->getExpedienteEspecialidad()->onicofagia(), []) !!} Onicofagia
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-5 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('chupon', null, $expediente->getExpedienteEspecialidad()->chupon(), []) !!} Chupón
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-5 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('otroHabito', null, $expediente->getExpedienteEspecialidad()->otroHabito(), ['id' => 'otroHabito']) !!} Otro hábito
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-5 col-md-offset-3">
				<div class="checkbox">
					<label>
						@if($expediente->getExpedienteEspecialidad()->otroHabito())
							{!! Form::text('especifiqueHabito', $expediente->getExpedienteEspecialidad()->getDescripcionHabito(), ['class' => 'form-control', 'placeholder' => 'Especifique hábito', 'id' => 'especifiqueHabito']) !!}
						@else
							{!! Form::text('especifiqueHabito', '', ['class' => 'form-control', 'placeholder' => 'Especifique hábito', 'readonly', 'id' => 'especifiqueHabito']) !!}
						@endif
					</label>
				</div>
			</div>
		</div>
	</div>
</div>