$(document).ready(function() {
    var urlConsultas   = $('#urlConsultas').val(),
        $formConsultas = $('#formConsultas'),
        $formCobro     = $('#formCobro'),
        costoConsulta  = 0;

    init();
    $formCobro.validate();
    agregaValidacionesElementos($formCobro);

    // buscar citas al seleccionar una fecha
    $('#fecha').datepicker({
        autoclose: true,
        language:  'es',
        format:    'yyyy-mm-dd'
    }).on('changeDate', function() {
        buscarConsultas();
    });

    // click en lista y cargar contenido derecho
    $('#resultadoConsultas').on('click', 'li.consulta', function() {
        $(this).addClass('active');
        $(this).siblings('li.active').removeClass('active');

        var datos = {
            consultaId:     $(this).data('id'),
            imagen:         $(this).children('input.imagen').val(),
            nombreCompleto: $(this).children('input.nombreCompleto').val(),
            edad:           $(this).children('input.edad').val(),
            fechaConsulta:  $(this).children('input.fechaConsulta').val(),
            costoConsulta:  $(this).children('input.costoConsulta').val(),
        };

        costoConsulta = datos.costoConsulta;
        rellenarFormCobro(datos);
    });

    function buscarConsultas () {
        $.ajax({
            url:        $formConsultas.attr('action'),
            type:       'POST',
            dataType:   'json',
            data:       $formConsultas.serialize(),
            beforeSend: function () {
                $('#modalLoading').modal('show');
            }

        }).done(function(respuesta) {
            $('#modalLoading').modal('hide');

            if (respuesta.estatus === 'fail') {
                bootbox.alert('Ocurrió un error al realizar la búsqueda de consultas. Intente de nuevo');
            }

            if (respuesta.estatus === 'OK') {
                $('#resultadoConsultas').html(respuesta.html);

                setTimeout(function() {
                    var totalResultados = $('#totalResultados').val();
                    if (totalResultados === '1') {
                        var $consulta = $('#resultadoConsultas').find('li.consulta').first(),
                            datos     = {
                                consultaId:     $consulta.data('id'),
                                imagen:         $consulta.children('input.imagen').val(),
                                nombreCompleto: $consulta.children('input.nombreCompleto').val(),
                                edad:           $consulta.children('input.edad').val(),
                                fechaConsulta:  $consulta.children('input.fechaConsulta').val(),
                                costoConsulta:  $consulta.children('input.costoConsulta').val(),
                            };

                        costoConsulta = datos.costoConsulta;
                        rellenarFormCobro(datos);
                    }
                }, 500);
            }

        }).fail(function(jqXHR, textStatus, errorThrown) {
            $('#modalLoading').modal('hide');
            console.log(textStatus + ': ' + errorThrown);
            bootbox.alert('Ocurrió un error al realizar la búsqueda de consultas. Intente de nuevo');
        });
    }

    // rellenar el form con los datos
    function rellenarFormCobro (datos) {
        if (datos.imagen !== '') {
            $('#imagen').removeClass('hide');
            $('#fotoCapturada').attr('src', datos.imagen);
        }

        $('#nombreCompleto').text(datos.nombreCompleto);
        $('#anios').text(datos.edad);

        $('#totalPagarTexto').text('$' + datos.costoConsulta);
        $('#totalPagar').text(datos.costoConsulta);
        $('#consultaId').val(datos.consultaId);
        $('#cobros').removeClass('hide');
    }

    // forma pago de consulta
    $formCobro.on('click', 'input.formaPago', function(event) {
        if ($(this).val() === '1') {
            // efectivo
            $('#efectivo').removeClass('hide');
            $('#pago').rules('add', {
                required: true,
                number: true,
                min: costoConsulta,
                messages: {
                    required: 'Ingrese el monto del pago',
                    number: 'Ingrese un número válido',
                    min: 'El monto mínimo es ' + costoConsulta
                }
            });

            $('#cambio').rules('add', {
                required: true
            });
        }

        if ($(this).val() === '2') {
            // tarjeta de crédito
            $('#efectivo').addClass('hide');

            $('#pago').rules('remove');
            $('#cambio').rules('remove');
        }

    });

    // ingresar pago y calcular el cambio
    $('#pago').on('keyup', function (event) {
        var cambio = Number($(this).val()) - costoConsulta;

        $('#cambio').val(cambio);
    });

    // cobrar consulta
    $('#cobrarConsulta').on('click', function (event) {
        if ($('#formCobro').valid()) {
            // guardar mediante ajax
            $.ajax({
                url:        $formCobro.attr('action'),
                type:       'POST',
                dataType:   'json',
                data:       $formCobro.serialize(),
                beforeSend: function () {
                    $('#modalLoading').modal('show');
                }

            }).done(function (respuesta) {
                $('#modalLoading').modal('hide');

                if (respuesta.estatus === 'fail') {
                    var mensajeError = respuesta.mensaje !== '' ? respuesta.mensaje : '';
                    bootbox.alert('Ocurrió un error al cobrar la consulta. Intente de nuevo.' + mensajeError);
                }

                if (respuesta.estatus === 'OK') {
                    bootbox.alert('Consulta cobrada con éxito. Imprima el recibo de pago.', function () {
                        // abrir recibo de pago
                        window.open('/pacientes/consulta/recibo/' + $('#consultaId').val());

                        $('#cobros').addClass('hide');

                        // rebuscar consultas
                        buscarConsultas();
                    });
                }

            }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
                $('#modalLoading').modal('hide');
                console.log(textStatus + ': ' + errorThrown);
                bootbox.alert('Ocurrió un error al cobrar la consulta. Intente de nuevo');
            });
        }
    });
});