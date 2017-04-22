// validaciones a form otro tratamiento
// se simula el load
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
            type:       'post',
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
                });

                var url   = $('#resultadoPacientes').data('url'),
                    datos = {
                        medicoId:      $('#medicoId').val(),
                        expedienteId:  $('#resultadoPacientes').find('li.paciente').first().data('id'),
                        _token:        $('#formPaciente').find('input[name="_token"]').val()
                    };

                mostrarExpediente(url, datos);
            }

        }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
            $('#modalLoading').modal('hide');

            bootbox.alert('Ocurrió un error al generar el tratamiento seleccionado. Intente de nuevo.');
            console.log(textStatus + ': ' + errorThrown);
        });
    }

});