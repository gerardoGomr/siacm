<div class="navbar hidden-print box main navbar-primary" role="navigation" style="background: url('{{ url('img/fondo.jpg') }}') repeat-x">
	<div class="user-action user-action-btn-navbar pull-left border-right">
		<button class="btn btn-sm btn-navbar btn-primary btn-stroke"><i class="fa fa-bars fa-2x"></i></button>
	</div>
	<img src="/img/boka.png">
	<img src="/img/orl.png">
	<div class="user-action pull-right menu-right-hidden-xs menu-left-hidden-xs">
		<div class="dropdown username hidden-xs pull-left">
			<a class="dropdown-toggle dropdown-hover" data-toggle="dropdown" href="#">
				<span class="media margin-none">
					<span class="pull-left"></span>
					<span class="media-body text-regular strong">
						<i class="fa fa-user"></i> {{ session('Usuario')->nombreCompleto() }} <span class="caret"></span>
					</span>
				</span>
			</a>
			<ul class="dropdown-menu pull-right">
				<li><a href="{{ url('logout') }}"><i class="fa fa-sign-out"></i> CERRAR SESIÓN</a></li>
		    </ul>
		</div>

		<div class="dropdown dropdown-icons padding-none">
			<a class="btn btn-primary btn-circle dropdown-toggle dropdown-hover" data-toggle="dropdown"><i class="fa fa-info-circle"></i></a>
			<ul class="dropdown-menu">
				<li data-toggle="tooltip" data-title="Manual de usuario" data-placement="bottom" data-container="body" role="presentation">
					<a href=""><i class="fa fa-download"></i></a>
				</li>
			</ul>
		</div>
	</div>
	<div class="clearfix"></div>
</div>