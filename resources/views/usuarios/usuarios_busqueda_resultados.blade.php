@if(isset($usuarios) && !is_null($usuarios))
	@foreach($usuarios as $usuario)
		<li class="list-group-item animated fadeInUp">
			<div class="media innerAll">
				<div class="media-body innerT half">
					<p class="margin-none text-primary strong paciente">{{ $usuario->getNombreCompleto() }}</p>
					<input type="hidden" class="username" value="{{ base64_encode($usuario->getUsername()) }}">
					<ul class="list-unstyled margin-none">
						<li><i class="fa fa-user"></i> {{ $usuario->getUsername() }}</li>
					</ul>
				</div>
			</div>
		</li>
	@endforeach
@else
	<li class="strong innerAll list-group-item">
		<h4>Sin coincidencias</h4>
	</li>
@endif