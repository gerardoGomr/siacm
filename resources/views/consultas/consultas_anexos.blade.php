<div class="tab-pane" id="anexos">
        <div class="box-generic">
            @if($expediente->tieneAnexos())
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expediente->anexos() as $anexo)
                            <tr>
                                <td>{!! $anexo->nombreFormal() !!}</td>
                                <td>
                                    <a href="{{ url('pacientes/anexos/ver/' . $expediente->getId() . '/' . $anexo->nombre()) }}" target="_blank" class="btn btn-primary" data-toggle="tooltip" data-original-title="Ver anexo"><i class="fa fa-search"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="strong">No tiene anexos</p>
            @endif
        </div>
    </div>
</div>
