@if(count($consultas) > 0)
    <ul class="list-group list-group-1 borders-none margin-none">
        <?php
        $i = 0;
        ?>
        @foreach($consultas as $consulta)
            <li class="list-group-item animated fadeInUp consulta" data-id="{{ base64_encode($consulta->getId()) }}">
                <div class="media innerAll">
                    <div class="media-body innerT half">
                        <h4 class="media-heading strong text-primary">{{ $consulta->getExpediente()->getPaciente()->nombreCompleto() }}</h4>
                        <p>{{ $consulta->getExpediente()->getPaciente()->edadCompleta() }}</p>
                        <ul class="list-unstyled margin-none">
                            <li><i class="fa fa-calendar"> Fecha: </i> {{ \Siacme\Aplicacion\Fecha::convertir($consulta->getFecha()) }}</li>
                            <li><i class="fa fa-phone"></i> {{ $consulta->getExpediente()->getPaciente()->getTelefono() }}</li>
                            <li><i class="fa fa-mobile fa-2x"></i> {{ $consulta->getExpediente()->getPaciente()->getCelular() }}</li>
                            <li><i class="fa fa-envelope"></i> {{ $consulta->getExpediente()->getPaciente()->getEmail() }}</li>
                        </ul>
                    </div>
                </div>
                <input type="hidden" class="imagen" value="{{ $consulta->getExpediente()->tieneFoto() ? url('expedientes/foto/mostrar/' . base64_encode($consulta->getExpediente()->getFotografia()->getRuta())) . '?' . rand() : '' }}">
                <input type="hidden" class="nombreCompleto" value="{{ $consulta->getExpediente()->getPaciente()->nombreCompleto() }}">
                <input type="hidden" class="edad" value="{{ $consulta->getExpediente()->getPaciente()->edadCompleta() }}">
                <input type="hidden" class="fechaConsulta" value="{{ \Siacme\Aplicacion\Fecha::convertir($consulta->getFecha()) }}">
                <input type="hidden" class="costoConsulta" value="{{ $consulta->getCosto() }}">
            </li>
            <?php
            $i++;
            ?>
        @endforeach
        <input type="hidden" id="totalResultados" value="{{ $i }}">
    </ul>
@else
    <h4 class="innerAll">Sin resultados para el día {{ \Siacme\Aplicacion\Fecha::convertir($fecha->format('Y-m-d')) }}</h4>
@endif