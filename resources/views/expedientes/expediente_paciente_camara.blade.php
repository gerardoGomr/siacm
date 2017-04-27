@extends('app_camara')

@section('titulo')
    <i class="fa fa-camera"></i> Captura de foto
@stop

@section('contenido')
    <div id="camara" style="width:300px; height:200px;"></div>
    <button type="button" class="btn btn-primary" id="capturar"><i class="fa fa-camera"></i> Capturar</button>
    <button type="button" class="btn btn-primary" id="cancelar" style="display: none;"><i class="fa fa-times"></i> Cancelar</button>
    <button type="button" class="btn btn-primary" id="guardar" style="display: none;"><i class="fa fa-save"></i> Guardar</button>
    <input type="hidden" id="urlCaptura" value="{{ url('expedientes/foto/camara/'.base64_encode($paciente->getId()).'/'.base64_encode($medico->getUsername())) }}">
    <input type="hidden" id="_token" value="{{ csrf_token() }}">
@stop

@section('js')
    <script src="{{ asset('js/webcam/webcam.js') }}"></script>
    <script src="{{ asset('js/expedientes/expediente_paciente_camara.js') }}"></script>
@stop
