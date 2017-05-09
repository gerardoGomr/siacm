@extends('app')

@section('contenido')
    <div class="row row-app">
        <div class="col-md-12">
            <div class="col-separator col-unscrollable box col-separator-first">
                <div class="col-table">
                    <div class="col-table-row">
                        <div class="col-app col-unscrollable">
                            <div class="col-app">
                                <div class="jumbotron margin-none bg-white">
                                    <p>SISTEMA INTEGRAL DE ADMINISTRACIÓN MÉDICA.</p>

                                    <div id="grafica" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="{{ asset('js/principal.js') }}"></script>
@stop