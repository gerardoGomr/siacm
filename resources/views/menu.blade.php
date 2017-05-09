<?php
use Siacme\Dominio\Usuarios\Usuario;
?>
<div id="menu" class="hidden-print hidden-xs sidebar-blue sidebar-brand-primary">
	<div id="sidebar-fusion-wrapper">
		<div id="brandWrapper">
			<a href="{{ url('/') }}"><span class="text">SIAMED</span></a>
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
				</ul>
			</li>
			<li>
				<a href="{{ url('usuarios') }}" class="glyphicons user"><i></i> <span>Usuarios</span></a>
			</li>
		</ul>
	</div>
</div>