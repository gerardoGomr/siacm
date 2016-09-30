$(document).ready(function() {
    var urlConsultas = $('#urlConsultas').val(),
        $formCitas   = $('#formCitas');

    // buscar citas al seleccionar una fecha
    $('#fecha').datepicker({
        autoclose: true,
        language:  'es',
        format:    'yyyy-mm-dd'
    }).on('changeDate', function() {
        $.ajax({
            url:        $formCitas.attr('action'),
            type:       'post',
            dataType:   'json',
            data:       $formCitas.serialize(),
            beforeSend: function () {
                $('#modalLoading').modal('show');
            }

        }).done(function(respuesta) {
            $('#modalLoading').modal('hide');

            if (respuesta.estatus === 'fail') {
                bootbox.alert('Ocurrió un error al realizar la búsqueda de citas. Intente de nuevo');
            }

            if (respuesta.estatus === 'OK') {
                $('#resultadoCitas').html(respuesta.html);

                setTimeout(function() {
                    var totalResultados = $('#totalResultados').val();
                    if (totalResultados === '1') {
                        var url   = $('#resultadoCitas').data('url'),
                            datos = {
                                citaId:  $('#resultadoCitas').find('li.paciente').first().data('id'),
                                _token:  $('#formCitas').find('input[name="_token"]').val()
                            };

                        mostrarCitas(url, datos);
                    }
                }, 500);
            }

        }).fail(function(jqXHR, textStatus, errorThrown) {
            $('#modalLoading').modal('hide');
            console.log(textStatus + ': ' + errorThrown);
            bootbox.alert('Ocurrió un error al realizar la búsqueda de citas. Intente de nuevo');
        })
    });

    // click en lista y cargar contenido derecho
    $('#resultadoCitas').on('click', 'li.paciente', function() {
        $(this).addClass('active');
        $(this).siblings('li.active').removeClass('active');

        var url   = $('#resultadoCitas').data('url'),
            datos = {
                citaId:  $(this).data('id'),
                _token:  $('#formCitas').find('input[name="_token"]').val()
            };

        mostrarCitas(url, datos);
    });

    function mostrarCitas(url, datos) {
        $.ajax({
            url:        url,
            type:       'post',
            dataType:   'json',
            data:       datos,
            beforeSend: function() {
                $('#modalLoading').modal('show');
            }

        }).done(function(respuesta) {
            $('#modalLoading').modal('hide');

            if (respuesta.estatus === 'fail') {
                bootbox.alert('Ocurrió un error al revisar el detalle de la cita. Intente de nuevo');
            }

            if (respuesta.estatus === 'OK') {
                $('#dvDetalles').html(respuesta.html);
            }

        }).fail(function(jqXHR, textStatus, errorThrown) {
            $('#modalLoading').modal('hide');
            bootbox.alert('Ocurrió un error al revisar el detalle de la cita. Intente de nuevo');
            console.log(textStatus + ': ' + errorThrown);
        });
    }
});

