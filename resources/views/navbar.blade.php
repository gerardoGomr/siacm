<div class="navbar hidden-print navbar-inverse box main" role="navigation">
	<div class="user-action user-action-btn-navbar pull-left border-right">
		<button class="btn btn-sm btn-navbar btn-primary btn-stroke"><i class="fa fa-bars fa-2x"></i></button>
	</div>

  	<div class="col-md-3 visible-md visible-lg padding-none">
    	<div class="input-group innerL">
      		<input type="text" class="form-control input-sm" placeholder="Búsqueda rápida" />
      		<span class="input-group-btn">
        		<button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
      		</span>
    	</div><!-- /input-group -->
  	</div>

	<div class="user-action pull-right menu-right-hidden-xs menu-left-hidden-xs">
		<div class="dropdown username hidden-xs pull-left">
			<a class="dropdown-toggle " data-toggle="dropdown" href="#">
				<span class="media margin-none">
					<span class="media-body strong" style="font-size: 12pt">
						<i class="fa fa-user"></i> {{  Request::session()->get('Usuario')->getNombreCompleto()  }} <span class="caret"></span>
					</span>
				</span>
			</a>
			<ul class="dropdown-menu pull-right">
				<li><a href="{{ url('logout') }}">Cerrar Sesión</a></li>
		    </ul>
		</div>
	</div>
	<div class="clearfix"></div>
</div>