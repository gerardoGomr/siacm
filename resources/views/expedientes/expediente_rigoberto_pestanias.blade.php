<div class="widget-head col-md-3 col-lg-3">
	<ul>
		<li class="innerAll bg-primary active">
			<a href="#datosPersonales" data-toggle="tab"><i class="fa fa-user"></i> Datos personales</a>
		</li>
		<li class="innerAll">
			<a href="#antHeredofamiliares" data-toggle="tab"><i class="fa fa-users"></i> Ant. heredofamiliares</a>
		</li>
		<li class="innerAll">
			<a href="#antPatologicos" data-toggle="tab"><i class="fa fa-edit"></i> Ant. personales patológicos</a>
		</li>
		<li class="innerAll">
			<a href="#antNoPatologicos" data-toggle="tab"><i class="fa fa-edit"></i> Ant. personales no patológicos</a>
		</li>
        @if(isset($expediente) && $expediente->tieneConsultas())
            <!-- <li class="innerAll">
                <a href="#expedienteConsulta" data-toggle="tab"><i class="fa fa-folder-open"></i> Expediente</a>
            </li> -->
        @endif
	</ul>
</div>