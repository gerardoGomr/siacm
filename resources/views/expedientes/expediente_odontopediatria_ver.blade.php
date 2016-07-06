@extends('app_no_sidebar')

@section('titulo')
	<i class="fa fa-plus"></i> Expediente
@stop

@section('contenido')
		<div class="wizard">
			<div class="widget widget-tabs widget-tabs-double widget-tabs-vertical row row-merge">
				@include('expedientes.expediente_odontopediatria_pestanias')

				<div class="widget-body col-md-9 col-lg-9">
					<div class="innerAll">
						<a href="javascript:;" id="firmar" class="btn btn-primary"><i class="fa fa-check"></i> Los datos del expediente están correctos</a>
						<a href="{{ url('expedientes/agregar/odont/'.base64_encode($expediente->getPaciente()->getId()).'/'.base64_encode($expediente->getMedico()->getUsername())) }}" class="btn btn-danger"><i class="fa fa-edit"></i> Editar expediente</a>

						{!! Form::hidden('idPaciente', base64_encode($paciente->getId()), ['id' => 'idPaciente']) !!}
						{!! Form::hidden('userMedico', base64_encode($medico->getUsername()), ['id' => 'userMedico']) !!}
						<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
						<input type="hidden" id="urlFirmar" value="{{ url('expedientes/firmar') }}">
						{{-- <input type="hidden" id="urlDetalles" value="{{ url('citas/detalle/'.base64_encode($cita->getId()).'/'.base64_encode($cita->getMedico()->getUsername())) }}"> --}}
					</div>
					<div class="tab-content">
						@include('expedientes.expediente_odonto_datos_personales_ver')
						@include('expedientes.expediente_odonto_antecedentes_heredofamiliares_ver')
						@include('expedientes.expediente_odonto_antecedentes_patologicos_ver')
						@include('expedientes.expediente_odonto_antecedentes_odontopatologicos_ver')
						@include('expedientes.expediente_odonto_trastornos_lenguaje_ver')
						@include('expedientes.expediente_odonto_antecedentes_odontalgicos_ver')
						@include('expedientes.expediente_odonto_higiene_bucodental_ver')
						@include('expedientes.expediente_odonto_habitos_orales_ver')
					</div>
				</div>
			</div>
		</div>
@stop

@section('js')
	<script type="text/javascript" src="{{ asset('public/js/expedientes/expediente_ver.js') }}"></script>
@stop