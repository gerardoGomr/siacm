<!-- antecedentes personales patologicos -->
<div class="tab-pane" id="antPatologicos">
	<div class="row">
		<div class="col-md-12 col-lg-6">
			<div class="box-generic">
				<div class="row">

					{!! Form::label('padecimientos', '¿Su hijo(a) padece o ha padecido alguna de las siguientes enfermedades o malestares?:', ['class' => 'control-label']) !!}

					<?php $i = 1; ?>
					<div class="col-xs-6">
						<div class="form-group">
							@foreach($listaPadecimientos as $padecimiento)
								<div class="checkbox">
									<label>
										{!! Form::checkbox('padecimiento[]', $padecimiento->getId(), null, []) !!} {{ $padecimiento->getPadecimiento() }}
									</label>
								</div>
								<?php $i++; ?>

								@if($i % 7 === 0)
									</div>
									</div>
									<div class="col-xs-6">
									<div class="form-group">
								@endif
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12 col-lg-6">
			<div class="box-generic">
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									{!! Form::checkbox('moretones', null, null, []) !!}	Se le hacen moretones
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									{!! Form::checkbox('transfusion', null, null, []) !!}	Ha requerido transfusión sanguínea
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									{!! Form::checkbox('fracturas', null, null, []) !!}	Ha tenido fracturas
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtFractura', '¿En donde?:', ['class' => 'control-label']) !!}
							{!! Form::text('txtFractura', null, ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									{!! Form::checkbox('cirugia', null, null, []) !!}	Ha sido intervenido quirúrgicamente
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtCirugia', '¿En donde?:', ['class' => 'control-label']) !!}
							{!! Form::text('txtCirugia', null, ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									{!! Form::checkbox('hospitalizado', null, null, []) !!}	Ha sido hospitalizado
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtHospitalizado', '¿De qué?:', ['class' => 'control-label']) !!}
							{!! Form::text('txtHospitalizado', null, ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									{!! Form::checkbox('exFumador', null, null, []) !!}	Ex-fumador
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									{!! Form::checkbox('exAlcoholico', null, null, []) !!}	Ex-alcohólico
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-12">
						<div class="form-group">
							<div class="checkbox">
								<label>
									{!! Form::checkbox('exAdicto', null, null, []) !!}	Ex-adicto
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									{!! Form::checkbox('tratamiento', null, null, []) !!}	Está bajo tratamiento
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label('txtTratamiento', 'Especifique:', ['class' => 'control-label']) !!}
							{!! Form::text('txtTratamiento', null, ['class' => 'form-control']) !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- fin -->