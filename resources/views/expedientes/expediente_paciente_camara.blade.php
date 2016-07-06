@extends('app_camara')

@section('titulo')
    <i class="fa fa-camera"></i> Captura de foto
@stop

@section('contenido')
    <div id="camara" style="width:300px; height:200px;"></div>
    <a href="javascript:;" class="btn btn-primary" id="capturar"><i class="fa fa-camera"></i> Capturar</a>
    <a href="javascript:;" class="btn btn-primary" id="cancelar" style="display: none;"><i class="fa fa-times"></i> Cancelar</a>
    <a href="javascript:;" class="btn btn-primary" id="guardar" style="display: none;"><i class="fa fa-save"></i> Guardar</a>
    <input type="hidden" id="urlCaptura" value="{{ url('expedientes/foto/camara/'.base64_encode($paciente->getId()).'/'.base64_encode($medico->getUsername())) }}">
    <input type="hidden" id="_token" value="{{ csrf_token() }}">
@stop

@section('js')
    <script type="text/javascript" src="{{ asset('public/js/webcam/webcam.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/expedientes/expediente_paciente_camara.js') }}"></script>
@stop