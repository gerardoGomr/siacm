@extends('app_no_sidebar')

@section('titulo')
    <i class="fa fa-search"></i> Plan de Tratamiento
@stop

@section('contenido')
    <div class="row">
        <div class="col-md-3 col-sm-12">
            <div class="innerAll">
                <div class="form-group">
                    <label class="control-label">Otros tratamientos:</label>
                    <select name="otrosTratamientos" id="otrosTratamientos" class="form-control">
                        <option value="">Seleccione</option>
                        @foreach($listaOtrosTratamientos as $otroTratamiento)
                            <option value="{{ $otroTratamiento->getId() }}">{{ $otroTratamiento->getTratamiento() }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <a href="{{ url('consultas/plan/tratamientos/otros/agregar') }}" class="btn btn-primary btn-small" id="btnAgregarOtroTratamiento"><i class="fa fa-plus"></i> Agregar a plan</a>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-12 border-left">
            <div class="innerAll">
                <a href="javascript:;" id="btnAceptar" class="btn btn-success"><i class="fa fa-check"></i> Aceptar</a>

                <a href="{{ url("consultas/plan/$userMed/$idPaciente") }}" id="generarPlan" class="btn btn-success" disabled="disabled" target="_blank"><i class="fa fa-print"></i> Generar PDF</a>
            </div>
            <div class="separator"></div>
            <div class="innerAll" id="dvPlanTratamiento">
                {!! $dibujadorPlan->dibujar() !!}
            </div>
        </div>
    </div>

    <input type="hidden" id="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="urlAgregarTratamientos" value="{{ url('consultas/plan/tratamientos/agregar') }}">
@stop

@section('js')
    <script src="{{ asset('public/js/consultas/consultas_plan_tratamiento.js') }}"></script>
@stop