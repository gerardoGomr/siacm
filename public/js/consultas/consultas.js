$(function() {
    var urlConsultas   = $('#urlConsultas').val();

    // datepicker
    $('#txtFecha').datepicker({
        autoclose: true,
        language:  'es',
        format:    'dd/mm/yyyy'
    });

    // buscar citas por la fecha
    $('#btnBuscar').on('click', function(event) {
        if($('#txtFecha').val() === '') {
            bootbox.alert('Ingrese una fecha');
            return false;
        }

        // busqueda ajax - modo cargar
        ajax($('#formCitas').attr('action'), 'post', 'html', $('#formCitas').serialize(), 'cargar', 'citasLoading', 'listaCitas');
    });

    // click en lista y cargar contenido derecho
    $('#listaCitas').on('click', 'a.paciente', function() {
        var datos = {
            idCita:  $(this).siblings('input[name="idCita"]').val(),
            _token:  $('#formCitas').find('input[name="_token"]').val()
        };

        ajax($('#urlClickCitas').val(), 'post', 'html', datos, 'cargar', 'detalleLoading', 'dvDetalles');
    });
});

