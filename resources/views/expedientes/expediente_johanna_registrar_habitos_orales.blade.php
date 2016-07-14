<!-- antecedentes higieneBucodental -->
<div class="tab-pane" id="habitosOrales">
	<div class="box-generic">
		<div class="row">
			<div class="col-xs-4">
				<div class="form-group">
					<div class="checkbox">
						<label>
							{!! Form::checkbox('succionDigital', 1, null, []) !!} Succión digital (se chupa el dedo)
						</label>
					</div>
				</div>
			</div>

			<div class="col-xs-4">
				<div class="form-group">
					<div class="checkbox">
						<label>
							{!! Form::checkbox('succionLingual', 1, null, []) !!} Succión lingual (se chupa la lengua)
						</label>
					</div>
				</div>
			</div>

			<div class="col-xs-4">
				<div class="form-group">
					<div class="checkbox">
						<label>
							{!! Form::checkbox('biberon', 1, null, []) !!} Biberón
						</label>
					</div>
				</div>
			</div>

			<div class="col-xs-4">
				<div class="form-group">
					<div class="checkbox">
						<label>
							{!! Form::checkbox('bruxismo', 1, null, []) !!} Bruxismo (rechina los dientes)
						</label>
					</div>
				</div>
			</div>

			<div class="col-xs-4">
				<div class="form-group">
					<div class="checkbox">
						<label>
							{!! Form::checkbox('succionLabial', 1, null, []) !!} Succión labial (se chupa el labio)
						</label>
					</div>
				</div>
			</div>

			<div class="col-xs-4">
				<div class="form-group">
					<div class="checkbox">
						<label>
							{!! Form::checkbox('respiracionBucal', 1, null, []) !!} Respiración Bucal
						</label>
					</div>
				</div>
			</div>

			<div class="col-xs-4">
				<div class="form-group">
					<div class="checkbox">
						<label>
							{!! Form::checkbox('onicofagia', 1, null, []) !!} Onicofagia
						</label>
					</div>
				</div>
			</div>

			<div class="col-xs-4">
				<div class="form-group">
					<div class="checkbox">
						<label>
							{!! Form::checkbox('chupon', 1, null, []) !!} Chupón
						</label>
					</div>
				</div>
			</div>

			<div class="col-xs-4">
				<div class="form-group">
					<div class="checkbox">
						<label>
							{!! Form::checkbox('otroHabito', 1, null, []) !!} Otro hábito
						</label>
					</div>
				</div>
			</div>

			<div class="col-xs-4">
				<div class="form-group">
					<div class="checkbox">
						<label>
							{!! Form::text('txtEspecifiqueHabito', '', ['class' => 'form-control', 'placeholder' => 'Especifique hábito']) !!}
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- fin -->