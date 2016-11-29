<div class="navbar hidden-print box main navbar-primary" role="navigation" style="background: url('{{ url('img/fondo.jpg') }}') repeat-x">
	<div class="user-action user-action-btn-navbar pull-left border-right">
		<button class="btn btn-sm btn-navbar btn-primary btn-stroke"><i class="fa fa-bars fa-2x"></i></button>
	</div>

  	<div class="col-md-3 padding-none visible-md visible-lg">
    	<div class="input-group innerLR">
      		<input type="text" class="form-control input-sm" placeholder="Search stories ...">
      		<span class="input-group-btn">
        		<button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
      		</span>
    	</div><!-- /input-group -->
  	</div>

	<div class="user-action pull-right menu-right-hidden-xs menu-left-hidden-xs">
		<div class="dropdown username hidden-xs pull-left">
			<a class="dropdown-toggle dropdown-hover" data-toggle="dropdown" href="#">
				<span class="media margin-none">
					<span class="pull-left"></span>
					<span class="media-body text-regular strong">
						<i class="fa fa-user"></i> {{ request()->session()->get('Usuario')->nombreCompleto() }} <span class="caret"></span>
					</span>
				</span>
			</a>
			<ul class="dropdown-menu pull-right">
				<li><a href="{{ url('perfil') }}"><i class="fa fa-gears"></i> MI CUENTA</a></li>
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