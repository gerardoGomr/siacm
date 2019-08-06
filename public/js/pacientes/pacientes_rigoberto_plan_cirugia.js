$(document).ready(function() {
    // plan de cirugía
    $('#dvDetalles').on('click', '#generarCotizacionCirugia', function () {
        var formId       = $('#dvDetalles').find('form').attr('id'),
            expedienteId = $('#' + formId).find('input[name="expedienteId"]').val(),
            medicoId     = $('#' + formId).find('input[name="medicoId"]').val()

        $('#cirugiaId').val($('#cirugiaId option:first').val())
        $('#honorarios').val('')
        $('#equipoAdicional').val('')
        $('#hospitalSugerido').val('')
        $('#diasHospitalizacion').val('')
        $('#montoHospitalizacion').val('')
        $('#formPlanCirugia').find('input[name="expedienteId"]').val(expedienteId)
        $('#formPlanCirugia').find('input[name="medicoId"]').val(medicoId)
        $('#planCirugiaId').val('')
        
        $('#dvPlanCirugia').modal('show')
    })

    // save plan cirugía
    $('#guardarFormPlanCirugia').on('click', function() {
        if (!$('#formPlanCirugia').valid()) return;

        $.ajax({
            url:      $('#formPlanCirugia').attr('action'),
            type:     'post',
            dataType: 'json',
            data:     $('#formPlanCirugia').serialize(),
            beforeSend: function () {
                $('#modalLoading').modal('show')
            }

        }).done(function (respuesta) {
            $('#modalLoading').modal('hide')

            if (respuesta.status === 'fail') {
                var mensajeError = respuesta.mensaje !== '' ? respuesta.mensaje : ''
                bootbox.alert('Ocurrió un error al guardar el plan de cirugía. Intente de nuevo.' + mensajeError)
            }

            if (respuesta.status === 'success') {
                bootbox.alert('Plan Guardado', function () {

                    var formId       = $('#dvDetalles').find('form').attr('id'),
                        expedienteId = $('#' + formId).find('input[name="expedienteId"]').val(),
                        medicoId     = $('#' + formId).find('input[name="medicoId"]').val()
                        datos        = {
                            expedienteId: expedienteId,
                            medicoId:     medicoId,
                            _token:       $('#formPaciente').find('input[name="_token"]').val()
                        }

                    mostrarExpediente(datos)

                    $('#dvPlanCirugia').modal('hide')
                })
            }

        }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
            $('#modalLoading').modal('hide')
            console.log(textStatus + ': ' + errorThrown)
            bootbox.alert('Ocurrió un error al guardar el plan de cirugía. Intente de nuevo')
        })        
    })

    // editar plan de cirugía
    $('#dvDetalles').on('click', 'button.editarPlanCirugia', function() {

        let $parent = $(this).parent('div')
            data    = {
                expedienteId: $parent.siblings('input.expedienteId').val(),
                planCirugiaId: $parent.siblings('input.planCirugiaId').val(),
                cirugiaId: $parent.siblings('input.cirugiaId').val(),
                honorarios: $parent.siblings('input.honorarios').val(),
                equipoAdicional: $parent.siblings('input.equipoAdicional').val(),
                hospitalSugerido: $parent.siblings('input.hospitalSugerido').val(),
                diasHospitalizacion: $parent.siblings('input.diasHospitalizacion').val(),
                montoHospitalizacion: $parent.siblings('input.montoHospitalizacion').val()
            }

        $('#cirugiaId option[value=' + data.cirugiaId + ']').attr('selected', true)
        $('#honorarios').val(data.honorarios)
        $('#equipoAdicional').val(data.equipoAdicional)
        $('#hospitalSugerido').val(data.hospitalSugerido)
        $('#diasHospitalizacion').val(data.diasHospitalizacion)
        $('#montoHospitalizacion').val(data.montoHospitalizacion)
        $('#formPlanCirugia').find('input[name="expedienteId"]').val(data.expedienteId)
        $('#planCirugiaId').val(data.planCirugiaId)

        $('#dvPlanCirugia').modal('show')
    })
})
