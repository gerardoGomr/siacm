// validaciones a form otro tratamiento
// se simula el load
$('#fechaInicio, #fechaTermino').datepicker({
    format:    'yyyy-mm-dd',
    autoclose: true,
    language:  'es'
}).on('show', function() {
    // Obtener valores actuales z-index de cada elemento
    var zIndexModal = $('#dvOtroTratamiento').css('z-index'),
        zIndexFecha = $('.datepicker').css('z-index');

    // Re asignamos el valor z-index para mostrar sobre la ventana modal
    $('.datepicker').css('z-index',zIndexModal+1);
});

$('#formOtroTratamiento').validate();
agregaValidacionesElementos($('#formOtroTratamiento'));

// guardar otros tratamientos
$('#formOtroTratamiento').on('click', '#guardarFormOtros', function () {
    if ($('#formOtroTratamiento').valid()) {
        if (!$('#ortodoncia').attr('checked') && !$('#ortopedia').attr('checked')) {
            bootbox.alert('Seleccione al menos un tratamiento');
            return false;
        }

        $.ajax({
            url:        $('#formOtroTratamiento').attr('action'),
            type:       'POST',
            dataType:   'json',
            data:       $('#formOtroTratamiento').serialize(),
            beforeSend: function () {
                $('#modalLoading').modal('show');
            }

        }).done(function (respuesta) {
            $('#modalLoading').modal('hide');

            if (respuesta.estatus === 'fail') {
                bootbox.alert('Ocurrió un error al generar el tratamiento seleccionado. Intente de nuevo.');
            }

            if (respuesta.estatus === 'OK') {
                bootbox.alert('Tratamiento asignado/actualizado con éxito.', function () {
                    $('#dvOtroTratamiento').modal('hide');

                    var datos = {
                            medicoId:      $('#medicoId').val(),
                            expedienteId:  $('#resultadoPacientes').find('li.active').data('id')
                        };

                    mostrarExpediente(datos);
                });
            }

        }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
            $('#modalLoading').modal('hide');

            bootbox.alert('Ocurrió un error al generar el tratamiento seleccionado. Intente de nuevo.');
            console.log(textStatus + ': ' + errorThrown);
        });
    }

});

/**
 * funcion para mostrar el detall del expediente
 *
 * @param datos
 */
function mostrarExpediente(datos) {
    $.ajax({
        url:        '/pacientes/detalle',
        type:       'POST',
        dataType:   'json',
        data:       datos,
        beforeSend: function () {
            $('#modalLoading').modal('show');
        }

    }).done(function (respuesta) {
        $('#modalLoading').modal('hide');

        $('#dvDetalles').html(respuesta.html);

        // validación básica
        $('#formAnexo').validate();

        // validar formulario
        agregaValidacionesElementos($('#formAnexo'));

        // generar ajax form
        generarAjaxForm('formAnexo');

    }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
        $('#modalLoading').modal('hide');
        console.log(textStatus + ': ' + errorThrown);
        bootbox.alert('Ocurrió un error al mostrar los detalles del paciente.');
    });
}

/**
 * funcion para generar un formulario ajax
 * @param form
 */
function generarAjaxForm(form) {
    var opciones = {
        url:        $('#' + form).attr('action'),
        type:       'POST',
        dataType:   'json',
        beforeSend: function() {
            $('#modalLoading').modal('show');

            if (!$('#' + form).valid()) {
                $('#modalLoading').modal('hide');
                return false;
            }
        },
        success: function(respuesta) {
            $('#modalLoading').modal('hide');

            if(respuesta.estatus === 'fail') {
                var mensaje = respuesta.mensaje !== '' ? respuesta.mensaje : '';

                bootbox.alert('Ocurrió un error al agregar el anexo. Intente de nuevo. ' + mensaje);
                return false;
            }

            if (respuesta.estatus === 'OK') {
                bootbox.alert('Anexo agregado con éxito', function () {
                    var url   = $('#resultadoPacientes').data('url'),
                        datos = {
                            expedienteId: $('#' + form).find('input[name="expedienteId"]').val(),
                            medicoId:     $('#medicoId').val(),
                            _token:       $formPaciente.find('input[name="_token"]').val()
                        };

                    mostrarExpediente(url, datos);
                });
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            $('#modalLoading').modal('hide');
            console.log(textStatus + ': ' + errorThrown);
            bootbox.alert('Ocurrió un error al agregar el anexo. Intente de nuevo');
        }
    };

    $('#' + form).ajaxForm(opciones);
}