<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 app sidebar sidebar-fusion sidebar-kis footer-sticky navbar-sticky"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 app sidebar sidebar-fusion sidebar-kis footer-sticky navbar-sticky"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 app sidebar sidebar-fusion sidebar-kis footer-sticky navbar-sticky"> <![endif]-->
<!--[if gt IE 8]> <html class="ie app sidebar sidebar-fusion sidebar-kis footer-sticky navbar-sticky"> <![endif]-->
<!--[if !IE]><!-->
<html class="app sidebar sidebar-fusion sidebar-kis footer-sticky navbar-sticky">
<!-- <![endif]-->
	<head>
		<title>Sistema Integral para la Administración del Consultorio Médico</title>

		<!-- Meta -->
		<meta charset="utf-8" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0" />

		<link rel="stylesheet" href="{{ asset('public/css/base-styles.css') }}" />
		<link rel="stylesheet" href="{{ asset('public/css/app.css') }}" />
		@yield('css')

		<script>
			if (/*@cc_on!@*/false && document.documentMode === 10) {
				document.documentElement.className+=' ie ie10';
			}
		</script>

	</head>
	<body class="scripts-async menu-right-hidden">
		<!-- Main Container Fluid -->
		<div class="container-fluid menu-hidden">
			<!-- Main Sidebar Menu -->
			@include('menu')
			<!-- // Main Sidebar Menu END -->

			<!-- Content -->
			<div id="content">
				<!-- NAVBAR -->
				@include('navbar')
				<!-- NAVBAR END -->

				<div class="layout-app">
					<!-- row -->
					<div class="row row-app margin-none">
						<!-- col -->
						<div class="col-md-12">
							<!-- col-separator -->
							<div class="col-separator col-unscrollable col-separator-first bg-none box">
								<!-- col-table -->
								<div class="col-table">
									<!-- col-table-row -->
									<div class="col-table-row">
										<!-- col-app -->
										<div class="col-app col-unscrollable">
											<div class="col-app">
												<div class="box-generic">
													<h2 class="heading">@yield('titulo')</h2>
												</div>
												@yield('contenido')
											</div>
										</div>
										<!-- // END row -->
									</div>
									<!-- // END col-app -->
								</div>
								<!-- // END col-table-row -->
							</div>
							<!-- // END col-table -->
						</div>
						<!-- // END col-separator -->
					</div>
					<!-- // END col -->
				</div>
				<!-- // END row-app -->
			</div>
		</div>
		<!-- // Content END -->
		<div class="clearfix"></div>
		<!-- // Sidebar menu & content wrapper END -->

				<!-- Footer -->
		<div id="footer" class="hidden-print">
			<!--  Copyright Line -->
			<div class="copy">
				&copy; {{  date('Y') }} - Sistema Integral para la Administración del Consultorio Médico. v1.0
			</div>
			<!--  End Copyright Line -->
		</div>
		<!-- // Footer END -->
		<!-- Global -->
		<script data-id="App.Config">
			var basePath           = '',
				commonPath         = 'public/assets/',
				rootPath           = 'public/',
				DEV                = false,
				componentsPath     = 'public/assets/components/',
				layoutApp          = true,
				module             = 'admin';

			var primaryColor       = '#eb6a5a',
				dangerColor        = '#b55151',
				successColor       = '#609450',
				infoColor          = '#4a8bc2',
				warningColor       = '#ab7a4b',
				inverseColor       = '#45484d';

			var themerPrimaryColor = primaryColor;
		</script>
		<script src="{{ asset('public/js/base-scripts.js') }}"></script>
		@yield('js')

	</body>
</html>