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
						{!! Form::radio('tipoCepillo', 1, $expediente->getExpedienteEspecialidad()->getTipoCepillo() === 1 ? true : false, ['class' => 'required']) !!} Adultos
					</label>
				</div>
				<div class="radio">
					<label>
						{!! Form::radio('tipoCepillo', 2, $expediente->getExpedienteEspecialidad()->getTipoCepillo() === 2 ? true : false, ['class' => 'required']) !!} Niños
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('marcaPasta', 'Marca de pasta dental:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-4">
				<select name="marcaPasta" id="marcaPasta" class="required form-control">
					<option value="">Seleccione</option>
					<option value="{{ MarcaPasta::INFANTIL }}" {{ $expediente->getExpedienteEspecialidad()->getMarcaPasta() === MarcaPasta::INFANTIL ? 'selected="selected"' : '' }}>Infantil</option>
					<option value="{{ MarcaPasta::ADULTO }}" {{ $expediente->getExpedienteEspecialidad()->getMarcaPasta() === MarcaPasta::ADULTO ? 'selected="selected"' : '' }}>Adultos</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('vecesCepilla', '*¿Cuántas veces cepilla los dientes del niño(a) al día?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-3">
				<div class="input-group">
					{!! Form::text('vecesCepilla', $expediente->getExpedienteEspecialidad()->getVecesCepillaDiente(), ['class' => 'required form-control']) !!}
					<span class="input-group-addon">Veces</span>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('edadErupcionaPrimerDiente', '*¿A qué edad erupcionó el primer diente?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-2">
				{!! Form::text('edadErupcionaPrimerDiente', $expediente->getExpedienteEspecialidad()->getEdadErupcionoPrimerDiente(), ['class' => 'required form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-5 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('ayudaAlCepillarse', null, $expediente->getExpedienteEspecialidad()->alguienAyudaACepillarse(), ['class' => '']) !!} Alguien ayuda a cepillarse
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('vecesCome', '*¿Cuántas veces come al día?:', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-3">
				<div class="input-group">
					{!! Form::text('vecesCome', $expediente->getExpedienteEspecialidad()->getVecesComeDia(), ['class' => 'required numerosEnteros form-control']) !!}
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
						{!! Form::checkbox('hiloDental', null, $expediente->getExpedienteEspecialidad()->hiloDental(), []) !!} Hilo dental
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('enjuagueBucal', null, $expediente->getExpedienteEspecialidad()->enjuagueBucal(), []) !!} Enjuague bucal
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('limpiadorLingual', null, $expediente->getExpedienteEspecialidad()->limpiadorLingual(), []) !!} Limpiador lingual
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('tabletasReveladoras', null, $expediente->getExpedienteEspecialidad()->tabletasReveladoras(), []) !!} Tabletas reveladoras
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('otroAuxiliar', null, $expediente->getExpedienteEspecialidad()->otroAuxiliar(), ['id' => 'otroAuxiliar']) !!} Otro
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-8 col-md-offset-3">
				@if($expediente->getExpedienteEspecialidad()->otroAuxiliar())
					{!! Form::text('especifiqueAuxiliar', $expediente->getExpedienteEspecialidad()->getEspecifiqueAuxiliar(), ['class' => 'form-control', 'placeholder' => 'Especifique', 'id' => 'especifiqueAuxiliar']) !!}
				@else
					{!! Form::text('especifiqueAuxiliar', '', ['class' => 'form-control', 'placeholder' => 'Especifique', 'readonly', 'id' => 'especifiqueAuxiliar']) !!}
				@endif
			</div>
		</div>
	</div>
</div>