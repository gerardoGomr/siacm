$(document).ready(function() {
    var $fecha         = $('#fecha'),
        $formConsultas = $('#formConsultas');

    // buscar citas al seleccionar una fecha
    $fecha.datepicker({
        autoclose: true,
        language:  'es',
        format:    'yyyy-mm-dd'
    }).on('changeDate', function() {
        $.ajax({
            url:        '/reportes/cobro-consultas',
            type:       'POST',
            dataType:   'json',
            data:       $formConsultas.serialize(),
            beforeSend: function () {
                $('#modalLoading').modal('show');
            }

        }).done(function(respuesta) {
            $('#modalLoading').modal('hide');

            if (respuesta.estatus === 'fail') {
                bootbox.alert('Ocurrió un error al realizar la búsqueda. Intente de nuevo');
            }

            if (respuesta.estatus === 'success') {
                $('#dvDetalles').html(respuesta.view);
            }

        }).fail(function(jqXHR, textStatus, errorThrown) {
            $('#modalLoading').modal('hide');
            bootbox.alert('Ocurrió un error al realizar la búsqueda. Intente de nuevo');
        });
    });
});

