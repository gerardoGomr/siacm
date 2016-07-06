$(function() {
	var $calendario = $('#calendario'),
        date        = new Date(),
        d           = date.getDate(),
        m           = date.getMonth() + 1,
        y           = date.getFullYear(),
        med         = $('#medico').val(),
        fecha       = y + '-' + m + '-' + d,
        rutaCitas   = $('#rutaCitas').val() + '/citas/' + btoa(med) + '/' + btoa(fecha);

    // configuración del calendario
	$calendario.fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		buttonText: {
            prev: "<span class='fa fa-caret-left'></span>",
            next: "<span class='fa fa-caret-right'></span>",
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
            day: 'Día'
        },
        monthNames:      ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
        monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
        dayNames:        [ 'Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort:   ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
        defaultView:     'agendaDay',
        defaultDate:     d,
        minTime:         9,
        maxTime:         21,
        slotMinutes:     15,
        selectable:      true,
        allDaySlot:      false,
        editable:        true,
        events:          rutaCitas,
		dayClick: function(date, allDay, jsEvent, view) {
			//verificarEventos();
            //prevenir la seleccion en el horario de comida
            if(date.getHours() >= "14:0" && date.getHours() < "17:0") {
				bootbox.alert("No se puede agendar una cita en este horario.");
                return false;
            }

			var check = $.fullCalendar.formatDate(date,'yyyy-MM-dd');
			var today = $.fullCalendar.formatDate(new Date(),'yyyy-MM-dd');

			if(check < today) {
				// Previous Day. show message if you want otherwise do nothing.
				// So it will be unselectable
				bootbox.alert('No se pueden seleccionar días anteriores al día actual');
				return false;
			}

            if($('#reprogramar').val() === '1') {
				// reprogramar
				bootbox.confirm('¿Desea reprogramar la cita a esta fecha?', function(resp) {
					if(resp === true) {
						//reprogramar
						$.ajax({
							url:        $('#rutaCitas').val() + '/reprogramar',
							type:       'post',
							data:		{date: date.getFullYear()+"-"+(date.getMonth() + 1)+"-"+date.getDate(), time: date.getHours()+":"+date.getMinutes(), _token: $('#_token').val()}
						})
						.done(function(resultado) {
							console.log(resultado);

							if(resultado !== '1') {
								bootbox.alert('Ocurrió un error al reprogramar la cita. Intente de nuevo');
								return false;
							}

							// resetear variable reprogramar y recargar eventos
							$('#reprogramar').val('0');
							recargarCitas();

							bootbox.alert('Cita reprogramada con éxito.');
						})
						.fail(function(XMLHttpRequest, textStatus, errorThrown) {
							console.log(errorThrown);
							$('#reprogramar').val('0');
							bootbox.alert('Error al realizar la operación solicitada');
						});
					}
				});
          	} else {
          		// curso normal
          		window.open($('#rutaCitas').val() + '/agregar/' + btoa(date.getFullYear()+"-"+(date.getMonth() + 1)+"-"+date.getDate()) + '/' + btoa(date.getHours()+":"+date.getMinutes()) + '/' + btoa(med), '_blank', 'scrollbars=yes, width=700, height=500');
          	}
       	},
        eventClick: function(calEvent, jsEvent, view){
        	window.open($('#rutaCitas').val() + '/detalle/' + btoa(calEvent.id) + '/' + btoa(med), '_blank', 'scrollbars=yes, width=700, height=500');
        }
	});

	$calendario.find('span.fc-button-prev').click(function(){
		verificarFechas();
		$calendario.fullCalendar('removeEventSource', rutaCitas);
		fecha = $.fullCalendar.formatDate($('#calendario').fullCalendar('getDate'), 'yyyy-MM-dd');		
		rutaCitas = $('#rutaCitas').val() + '/citas/' + btoa(med) + '/' + btoa(fecha);
		$calendario.fullCalendar('addEventSource', rutaCitas);

		setTimeout(verificarEventos, 500);
	});

	$calendario.find('span.fc-button-next').click(function(){
		verificarFechas();
		$calendario.fullCalendar('removeEventSource', rutaCitas);
		fecha = $.fullCalendar.formatDate($('#calendario').fullCalendar('getDate'), 'yyyy-MM-dd');
		rutaCitas = $('#rutaCitas').val() + '/citas/' + btoa(med) + '/' + btoa(fecha);
		$calendario.fullCalendar('addEventSource', rutaCitas);
		setTimeout(verificarEventos, 500);
	});

	verificarFechas();
});

// recargar eventos del calendario
function recargarCitas()
{
    $('#calendario').fullCalendar('refetchEvents');
    verificarEventos();
}

function verificarEventos()
{
	var eventos = $('#calendario').fullCalendar('clientEvents');

    if (eventos.length > 0) {
    	$('#generarLista').attr('disabled', false);
    } else {
    	$('#generarLista').attr('disabled', true);
    }
}

/**
 * verificar si se puede o no generar el reporte
 */
function verificarFechas()
{
	var fecha = $.fullCalendar.formatDate($('#calendario').fullCalendar('getDate'), 'yyyy-MM-dd');

	// por default no se puede
	$('#generarLista').attr('href', $('#rutaPdf').val() + '/' + btoa($('#medico').val()) + '/' + btoa(fecha));
}