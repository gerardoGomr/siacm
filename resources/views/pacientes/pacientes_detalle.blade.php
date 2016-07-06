<div class="innerAll">
	<div class="widget widget-tabs">
		<div class="widget-head">
			<ul>
				<li class="active"><a href="#expediente" data-toggle="tab"><i class="fa fa-folder-open"></i> Expediente</a></li>
				<li class=""><a href="#consultas" data-toggle="tab"><i class="fa fa-user-md"></i> Consultas</a></li>
				<li class=""><a href="#interconsultas" data-toggle="tab"><i class="fa fa-search"></i> Interconsultas</a></li>
				<li class=""><a href="#plan" data-toggle="tab"><i class="fa fa-list"></i> Plan de tratamiento</a></li>
				<li class=""><a href="#anexos" data-toggle="tab"><i class="fa fa-edit"></i> Anexos</a></li>
			</ul>
		</div>
		<div class="widget-body">
			<div class="tab-content">
				@include('pacientes.pacientes_expediente')
				@include('pacientes.pacientes_consultas')
				@include('pacientes.pacientes_interconsultas')
				@include('pacientes.pacientes_plan')
				@include('pacientes.pacientes_anexos')
			</div>
		</div>
	</div>
</div>