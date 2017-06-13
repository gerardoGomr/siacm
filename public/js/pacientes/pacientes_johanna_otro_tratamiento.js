$(document).ready(function() {

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
            if (!$('#formOtroTratamiento').find('input[name="ortodoncia"]').is(':checked') && !$('#formOtroTratamiento').find('input[name="ortopedia"]').is(':checked')) {
                bootbox.alert('Por favor, seleccione al menos un tipo de tratamiento');
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

                        var totalResultados = $('#totalResultados').val(),
                            expedienteId    = null;

                        if (totalResultados === '1') {
                            expedienteId = $('#resultadoPacientes').find('li.paciente')
                                .first()
                                .data('id');
                        } else {
                            expedienteId = $('#resultadoPacientes').find('li.active').data('id');
                        }

                        var datos = {
                            medicoId:     $('#medicoId').val(),
                            expedienteId: expedienteId
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
});