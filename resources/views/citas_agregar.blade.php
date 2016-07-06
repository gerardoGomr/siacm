@extends('app_no_sidebar')

@section('titulo')
	<i class="fa fa-plus"></i> Agendar nueva cita
@stop

@section('contenido')
	<div id="dvFormCitas">
		<div class="innerAll bg-gray border-bottom">
			<div class="row">
				<div class="col-xs-6 col-md-4 col-lg-6">
					<p><strong>Fecha:</strong> <span>{{ $fecha }}</span></p>
				</div>

				<div class="col-xs-6 col-md-4 col-lg-6">
					<p><strong>Hora:</strong> <span>{{ $hora }}</span></p>
				</div>
			</div>
		</div>

		<div class="innerAll bg-white border-bottom">
			<div class="row border-bottom">
				<div class="col-xs-6 col-md-6 col-lg-6">
					<div class="form-group">
						{!! Form::label('txtNombreBusqueda', 'Buscar pacientesss:', ['class' => 'control-label']) !!}
						<div class="input-group">
							{!! Form::text('txtNombreBusqueda', null, ['class' => 'form-control', 'placeholder' => 'Ingrese nombre y/o apellidos', 'id' => 'txtNombreBusqueda']) !!}

							{!! Form::hidden('urlBusqueda', url('citas/verifica'), ['id' => 'urlBusqueda']) !!}
							<span class="input-group-btn">
								{!! Form::button('<i class="fa fa-search"></i>', ['class' => 'btn btn-primary', 'id' => 'btnComprueba']) !!}
							</span>
						</div>
					</div>
				</div>
			</div>

			<div id="dvResultados" style="display: none;"></div>
			@if($modo === 'agregar')
				@include('form_citas_agregar')
			@endif

			@if($modo === 'editar')
				@include('form_citas_editar')
			@endif
		</div>
	</div>
@stop

@section('js')
	<script type="text/javascript" src="/assets/components/common/forms/validator/assets/lib/jquery-validation/dist/jquery.validate.js"></script>
	<script type="text/javascript" src="/assets/components/modules/admin/modals/assets/js/bootbox.min.js"></script>
	<script type="text/javascript" src="/js/forms.js"></script>
	<script type="text/javascript" src="/js/citas_agregar.js"></script>
@stop