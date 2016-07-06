<!-- antecedentes higieneBucodental -->
<div class="tab-pane" id="habitosOrales">
	<div class="box-generic">
		<div class="row">
			<div class="col-xs-4">
				<div class="form-group">
					<div class="checkbox">
						<label>
							@if($expediente->getPaciente()->getSuccionDigital() === 1)
								{!! Form::checkbox('succionDigital', 1, true, []) !!} Succión digital (se chupa el dedo)
							@else
								{!! Form::checkbox('succionDigital', 1, null, []) !!} Succión digital (se chupa el dedo)
							@endif
						</label>
					</div>
				</div>
			</div>

			<div class="col-xs-4">
				<div class="form-group">
					<div class="checkbox">
						<label>
							@if($expediente->getPaciente()->getSuccionLingual() === 1)
								{!! Form::checkbox('succionLingual', 1, true, []) !!} Succión lingual (se chupa la lengua)
							@else
								{!! Form::checkbox('succionLingual', 1, null, []) !!} Succión lingual (se chupa la lengua)
							@endif
						</label>
					</div>
				</div>
			</div>

			<div class="col-xs-4">
				<div class="form-group">
					<div class="checkbox">
						<label>
							@if($expediente->getPaciente()->getBiberon() === 1)
								{!! Form::checkbox('biberon', 1, true, []) !!} Biberón
							@else
								{!! Form::checkbox('biberon', 1, null, []) !!} Biberón
							@endif
						</label>
					</div>
				</div>
			</div>

			<div class="col-xs-4">
				<div class="form-group">
					<div class="checkbox">
						<label>
							@if($expediente->getPaciente()->getBruxismo() === 1)
								{!! Form::checkbox('bruxismo', 1, true, []) !!} Bruxismo (rechina los dientes)
							@else
								{!! Form::checkbox('bruxismo', 1, null, []) !!} Bruxismo (rechina los dientes)
							@endif
						</label>
					</div>
				</div>
			</div>

			<div class="col-xs-4">
				<div class="form-group">
					<div class="checkbox">
						<label>
							@if($expediente->getPaciente()->getSuccionLabial() === 1)
								{!! Form::checkbox('succionLabial', 1, true, []) !!} Succión labial (se chupa el labio)
							@else
								{!! Form::checkbox('succionLabial', 1, null, []) !!} Succión labial (se chupa el labio)
							@endif
						</label>
					</div>
				</div>
			</div>

			<div class="col-xs-4">
				<div class="form-group">
					<div class="checkbox">
						<label>
							@if($expediente->getPaciente()->getRespiracionBucal() === 1)
								{!! Form::checkbox('respiracionBucal', 1, true, []) !!} Respiración Bucal
							@else
								{!! Form::checkbox('respiracionBucal', 1, null, []) !!} Respiración Bucal
							@endif
						</label>
					</div>
				</div>
			</div>

			<div class="col-xs-4">
				<div class="form-group">
					<div class="checkbox">
						<label>
							@if($expediente->getPaciente()->getOnicofagia() === 1)
								{!! Form::checkbox('onicofagia', 1, true, []) !!} Onicofagia
							@else
								{!! Form::checkbox('onicofagia', 1, null, []) !!} Onicofagia
							@endif
						</label>
					</div>
				</div>
			</div>

			<div class="col-xs-4">
				<div class="form-group">
					<div class="checkbox">
						<label>
							@if($expediente->getPaciente()->getChupon() === 1)
								{!! Form::checkbox('chupon', 1, true, []) !!} Chupón
							@else
								{!! Form::checkbox('chupon', 1, null, []) !!} Chupón
							@endif
						</label>
					</div>
				</div>
			</div>

			<div class="col-xs-4">
				<div class="form-group">
					<div class="checkbox">
						<label>
							@if($expediente->getPaciente()->getOtroHabito() === 1)
								{!! Form::checkbox('otroHabito', 1, true, []) !!} Otro hábito
							@else
								{!! Form::checkbox('otroHabito', 1, null, []) !!} Otro hábito
							@endif
						</label>
					</div>
				</div>
			</div>

			<div class="col-xs-4">
				<div class="form-group">
					<div class="checkbox">
						<label>
							{!! Form::text('txtEspecifiqueHabito', $expediente->getPaciente()->getDescripcionHabito(), ['class' => 'form-control', 'placeholder' => 'Especifique hábito']) !!}
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- fin -->