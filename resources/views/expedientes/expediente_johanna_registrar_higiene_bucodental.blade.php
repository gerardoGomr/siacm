<?php
	use Siacme\Dominio\Expedientes\MarcaPasta;
?>
<div class="tab-pane" id="higieneBucodental">
	<div class="box-generic">
		<div class="form-group">
			{!! Form::label('tipoCepillo', '*Tipo de cepillo dental:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-5">
				<div class="radio">
					<label>
						{!! Form::radio('tipoCepillo', 1, null, ['class' => '']) !!} Adultos
					</label>
				</div>
				<div class="radio">
					<label>
						{!! Form::radio('tipoCepillo', 2, null, ['class' => '']) !!} Niños
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('marcaPasta', 'Marca de pasta dental:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-4">
				<select name="marcaPasta" id="marcaPasta" class="form-control">
					<option value="">Seleccione</option>
					<option value="{{ MarcaPasta::INFANTIL }}">Infantil</option>
					<option value="{{ MarcaPasta::ADULTO }}">Adultos</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('vecesCepilla', '*¿Cuántas veces cepilla los dientes del niño(a) al día?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-3">
				<div class="input-group">
					{!! Form::text('vecesCepilla', '', ['class' => 'form-control']) !!}
					<span class="input-group-addon">Veces</span>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('edadErupcionaPrimerDiente', '*¿A qué edad erupcionó el primer diente?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-2">
				{!! Form::text('edadErupcionaPrimerDiente', '', ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-5 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('ayudaAlCepillarse', null, null, ['class' => '']) !!} Alguien ayuda a cepillarse
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('vecesCome', '*¿Cuántas veces come al día?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-3">
				<div class="input-group">
					{!! Form::text('vecesCome', '', ['class' => 'numerosEnteros form-control']) !!}
					<span class="input-group-addon">Veces</span>
				</div>
			</div>
		</div>
	</div>
	<div class="box-generic">
		<h4 class="heading">Auxiliares</h4>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('hiloDental', null, null, []) !!} Hilo dental
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('enjuagueBucal', null, null, []) !!} Enjuague bucal
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('limpiadorLingual', null, null, []) !!} Limpiador lingual
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('tabletasReveladoras', null, null, []) !!} Tabletas reveladoras
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('otroAuxiliar', null, null, ['id' => 'otroAuxiliar']) !!} Otro
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-8 col-md-offset-3">
				{!! Form::text('especifiqueAuxiliar', '', ['class' => 'form-control', 'placeholder' => 'Especifique', 'readonly', 'id' => 'especifiqueAuxiliar']) !!}
			</div>
		</div>
	</div>
</div>
