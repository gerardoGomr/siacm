@extends('app')

@section('contenido')
    <div class="row row-app">
        <div class="col-md-4 col-lg-3">
            <div class="col-separator col-unscrollable col-separator-first box">
                <h3 class="innerAll border-bottom margin-none">Búsqueda de pacientes</h3>
                <div class="innerAll bg-gray border-bottom margin-none">
                    {!! Form::open(['url' => url('consultas/buscar/no-pagadas'), 'id' => 'formConsultas']) !!}
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="fecha" id="fecha" value="{{ (new \DateTime())->format('Y-m-d') }}" placeholder="Elija la fecha de la cita" class="form-control" readonly>
                            <span class="input-group-addon"><i class="fa fa-th"></i></span>
                        </div>
                        <input type="hidden" name="medicoId" value="{{ base64_encode($medico->getId()) }}">
                    </div>
                    {!! Form::close() !!}
                </div>

                <div class="col-table">
                    <div class="col-table-row">
                        <div class="col-app col-unscrollable">
                            <div class="col-app">
                                <div id="resultadoConsultas" data-url="{{ url('pacientes/detalle') }}">
                                    @include('consultas.consultas_pagos_lista')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-lg-9">
            <div class="col-separator col-unscrollable">
                <div class="col-table">
                    <h3 class="innerAll border-bottom margin-none">Detalles de consulta</h3>
                    <div class="col-table-row">
                        <div class="col-app col-unscrollable">
                            <div class="col-app">
                                <div class="innerAll hide" id="cobros">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-3">
                                            <div id="imagen" class="hide">
                                                <img src="" id="fotoCapturada" class="pull-left"  width="">
                                            </div>
                                            <div class="media-body innerAll half">
                                                <h4 class="media-heading" id="nombreCompleto"></h4>
                                                <p id="anios"></p>
                                                <p id="fechaConsulta"></p>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-9">
                                            <form action="/pacientes/consultas/cobrar" id="formCobro" class="form-horizontal">
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Forma de pago:</label>
                                                    <div class="col-md-9">
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="formaPago" class="formaPago required" value="1"> Efectivo
                                                            </label>
                                                        </div>

                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="formaPago" class="formaPago required" value="2"> Tarjeta de crédito / débito
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Total a pagar:</label>
                                                    <div class="col-sm-9">
                                                        <p class="form-control-static" id="totalPagarTexto"></p>
                                                        <input type="hidden" id="totalPagar">
                                                    </div>
                                                </div>

                                                <div id="efectivo" class="hide">
                                                    <div class="form-group">
                                                        <label for="pago" class="control-label col-md-3">Pago:</label>
                                                        <div class="col-md-3">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                                                <input type="text" name="pago" id="pago" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="cambio" class="control-label col-md-3">Cambio:</label>
                                                        <div class="col-md-3">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                                                <input type="text" name="cambio" id="cambio" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-9 col-md-offset-3">
                                                        <input type="button" id="cobrarConsulta" class="btn btn-primary" value="Guardar&raquo;">
                                                        <input type="hidden" name="consultaId" id="consultaId">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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
    <script src="{{ asset('js/consultas/consultas_pagos.js') }}"></script>
@stop