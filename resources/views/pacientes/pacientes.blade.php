@extends('app')

@section('contenido')
	<div class="row row-app widget-employees">
		<div class="col-md-4 col-lg-3">
			<div class="col-separator col-unscrollable col-separator-first box">
				<div class="col-table">
					<h3 class="innerAll border-bottom margin-none">Búsqueda de pacientes</h3>
					<div class="innerAll bg-gray border-bottom margin-none">
						{!! Form::open(['url' => url('pacientes/buscar'), 'id' => 'formPaciente']) !!}
	                        <div class="form-group">
	                            <label for="paciente" class="control-label">Dato de paciente:</label>
	                            <input type="text" name="paciente" id="paciente" value="" placeholder="Escriba nombres o núm. de expediente" class="form-control">
	                            <input type="hidden" name="medicoId" id="medicoId" value="{{ base64_encode($medico->getId()) }}">
	                        </div>
						{!! Form::close() !!}
					</div>

					<div class="col-table-row">
						<div class="col-app col-unscrollable">
							<div class="col-app">
                                <div id="resultadoPacientes" data-url="{{ url('pacientes/detalle') }}">

                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-8 col-lg-9">
			<div class="col-separator col-unscrollable box">
				<div class="col-table">
					<h3 class="innerAll border-bottom margin-none">Detalles</h3>
					<div class="col-table-row">
						<div class="col-app col-unscrollable">
							<div class="col-app">
								<div id="dvDetalles">

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	@include('modal_loading')
	@include('pacientes.pacientes_johanna_otro_tratamiento')
    @include('pacientes.pacientes_otros_tratamientos_cobro')
    @include('pacientes.pacientes_anexos_editar')
    @include('pacientes.pacientes_rigoberto_plan_cirugia')
@stop

@section('js')
	<script src="{{ asset('js/pacientes/pacientes.js') }}"></script>
	<script src="{{ asset('js/pacientes/pacientes_johanna_otro_tratamiento.js') }}"></script>
	<script src="{{ asset('js/pacientes/pacientes_otros_tratamientos_cobro.js') }}"></script>
    <script src="{{ asset('js/pacientes/pacientes_rigoberto_plan_cirugia.js') }}"></script>
@stop