@if(count($expedientes) > 0)
    <ul class="list-group list-group-1 borders-none margin-none">
        <?php
        $i = 0;
        ?>
        @foreach($expedientes as $expediente)
            <li class="list-group-item animated fadeInUp paciente" data-id="{{ base64_encode($expediente->getId()) }}">
                <div class="media innerAll">
                    <div class="media-body innerT half">
                        <h4 class="media-heading strong text-primary">{{ $expediente->getPaciente()->nombreCompleto() }}</h4>
                        <p>{{ $expediente->getPaciente()->edadCompleta() }}</p>
                        <ul class="list-unstyled margin-none">
                            <li><i class="fa fa-phone"></i> {{ $expediente->getPaciente()->getTelefono() }}</li>
                            <li><i class="fa fa-mobile fa-2x"></i> {{ $expediente->getPaciente()->getCelular() }}</li>
                            <li><i class="fa fa-envelope"></i> {{ $expediente->getPaciente()->getEmail() }}</li>
                        </ul>
                    </div>
                </div>
            </li>
            <?php
            $i++;
            ?>
        @endforeach
        <input type="hidden" id="totalResultados" value="{{ $i }}">
    </ul>
@else
	<h4>Sin resultados</h4>
@endif