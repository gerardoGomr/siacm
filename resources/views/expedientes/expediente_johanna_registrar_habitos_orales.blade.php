<div class="tab-pane" id="habitosOrales">
	<div class="box-generic">
		<div class="form-group">
			<div class="col-md-5 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('succionDigital', null, null, []) !!} Succión digital (se chupa el dedo)
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-5 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('succionLingual', null, null, []) !!} Succión lingual (se chupa la lengua)
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-5 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('biberon', null, null, []) !!} Biberón
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-5 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('bruxismo', null, null, []) !!} Bruxismo (rechina los dientes)
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-5 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('succionLabial', null, null, []) !!} Succión labial (se chupa el labio)
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-5 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('respiracionBucal', null, null, []) !!} Respiración Bucal
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-5 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('onicofagia', null, null, []) !!} Onicofagia
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-5 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('chupon', null, null, []) !!} Chupón
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-5 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('otroHabito', null, null, ['id' => 'otroHabito']) !!} Otro hábito
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-5 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::text('especifiqueHabito', '', ['class' => 'form-control', 'placeholder' => 'Especifique hábito', 'readonly', 'id' => 'especifiqueHabito']) !!}
					</label>
				</div>
			</div>
		</div>
	</div>
</div>