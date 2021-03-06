<?php
use Siacme\Dominio\Usuarios\Usuario;
?>
<div id="menu" class="hidden-print hidden-xs sidebar-blue sidebar-brand-primary">
	<div id="sidebar-fusion-wrapper">
		<div id="brandWrapper">
			<a href="/"><span class="text">SIAMED</span></a>
		</div>
		<div id="logoWrapper">

		</div>

		<!-- SIDEBAR MENU -->
		<ul class="menu list-unstyled" id="navigation_current_page">
			<li class="hasSubmenu">
				<a href="#ulJohanna" data-toggle="collapse" class="glyphicons girl"><i></i><span>Dra. Johanna Vázquez</span></a>
				<ul class="collapse" id="ulJohanna">
					<li><a href="{{ url('citas/' . base64_encode(Usuario::JOHANNA)) }}" class="glyphicons calendar"><i></i><span> Citas</span></a></li>
					<li><a href="{{ url('consultas/' . base64_encode(Usuario::JOHANNA)) }}" class="glyphicons hospital"><i></i><span> Consultas</span></a></li>
					<li><a href="{{ url('consultas/pago/' . base64_encode(Usuario::JOHANNA)) }}" class="glyphicons usd"><i></i><span> Pago Consultas</span></a></li>
					<li><a href="{{ url('pacientes/' . base64_encode(Usuario::JOHANNA)) }}" class="glyphicons nameplate_alt"><i></i><span>Expedientes</span></a></li>
					<li class="menu hasSubmenu">
						<a href="#reportesJohanna" data-toggle="collapse" class="glyphicons file"><i></i> Reportes</a>
						<ul class="collapse menu" id="reportesJohanna">
							<li><a href="{{ url('reportes/cobro-consultas/' . base64_encode(Usuario::JOHANNA)) }}" class="glyphicons usd"><i></i> Cobro consultas</a></li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="hasSubmenu">
				<a href="#ulRigo" data-toggle="collapse" class="glyphicons boy"><i></i><span>Dr. Rigoberto García</span></a>
				<ul class="collapse" id="ulRigo">
					<li><a href="{{ url('citas/' . base64_encode(Usuario::RIGOBERTO)) }}" class="glyphicons calendar"><i></i><span> Citas</span></a></li>
					<li><a href="{{ url('consultas/' . base64_encode(Usuario::RIGOBERTO)) }}" class="glyphicons hospital"><i></i><span> Consultas</span></a></li>
					<li><a href="{{ url('consultas/pago/' . base64_encode(Usuario::RIGOBERTO)) }}" class="glyphicons usd"><i></i><span> Pago Consultas</span></a></li>
					<li><a href="{{ url('pacientes/' . base64_encode(Usuario::RIGOBERTO)) }}" class="glyphicons nameplate_alt"><i></i><span>Expedientes</span></a></li>
					<li class="menu hasSubmenu">
						<a href="#reportesRigo" data-toggle="collapse" class="glyphicons file"><i></i> Reportes</a>
						<ul class="collapse menu" id="reportesRigo">
							<li><a href="{{ url('reportes/cobro-consultas/' . base64_encode(Usuario::RIGOBERTO)) }}" class="glyphicons usd"><i></i> Cobro consultas</a></li>
						</ul>
					</li>
				</ul>
			</li>
			<li>
				<a href="{{ url('usuarios') }}" class="glyphicons user"><i></i> <span>Usuarios</span></a>
			</li>
		</ul>
	</div>
</div>