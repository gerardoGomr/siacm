@extends('app')

@section('contenido')
    <div class="row row-app">
        <div class="col-md-12">
            <div class="col-separator col-unscrollable box col-separator-first">
                <div class="col-table">
                    <h3 class="innerAll border-bottom margin-none">Cobros de consulta</h3>
                    <div class="col-table-row">
                        <div class="col-app col-unscrollable">
                            <div class="col-app">
                                <div class="innerAll">
                                    <form id="formConsultas">
                                        <div class="form-group col-lg-3 col-xs-12 col-sm-6">
                                            <label class="control-label">Día de consulta:</label>
                                            <div class="input-group">
                                                <input type="text" name="fecha" id="fecha" class="form-control" placeholder="Elija el día de consulta" autofocus readonly>
                                                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                            </div>
                                            <input type="hidden" name="medicoId" value="{{ base64_encode($medico->getId()) }}">
                                        </div>
                                    </form>
                                </div>
                                <div class="separator"></div>
                                <div class="innerAll">
                                    <div id="dvDetalles"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@include('modal_loading')

@section('js')
    <script src="{{ asset('js/reportes/cobro_consultas.js') }}"></script>
@stop