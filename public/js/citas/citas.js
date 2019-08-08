$(document).ready(function($) {
	var $calendario       = $('#calendario'),
		date              = new Date(),
		d                 = date.getDate(),
		m                 = date.getMonth() + 1,
		y                 = date.getFullYear(),
		medicoId          = $('#medicoId').val(),
		fecha             = y + '-' + m + '-' + d,
		rutaCitas         = $('#rutaCitas').val() + '/ver/' + medicoId + '/' + btoa(fecha),
		$modalAgendarCita = $('#modalAgendarCita')

	moment.locale('es')

    // configuración del calendario
	$calendario.fullCalendar({
		header: {
			left: 'prev,next, today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		buttonText: {
            prev: '<span class="fa fa-caret-left"></span>',
            next: '<span class="fa fa-caret-right"></span>',
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
            day: 'Día'
        },
        monthNames:      ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ],
        monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
        dayNames:        [ 'Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort:   ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
        defaultView:     'agendaDay',
        defaultDate:     d,
        minTime:         7,
        maxTime:         20,
        slotMinutes:     15,
        selectable:      true,
        editable:        false,
        events:          rutaCitas,
		allDaySlot:      false,
		dayClick: function(date, allDay, jsEvent, view) {
			var month  = (date.getMonth() + 1),
				fecha  = date.getFullYear() + '-' + month + '-' + date.getDate(),
				hora   = date.getHours() + ':' + date.getMinutes()

			let selectedDate = moment(date),
				today 		 = moment()

			//prevenir la seleccion en el horario de comida
            if(selectedDate.hour() >= 14 && selectedDate.hour() < 17) {
				bootbox.alert('No se puede agendar una cita en este horario.')
                return false
            }

            if(today.isAfter(selectedDate, 'day')) {
				bootbox.alert('No se pueden seleccionar días anteriores al día actual')
				return false
			}

            if($('#reprogramar').val() === '1') {
				// reprogramar
				bootbox.confirm('¿Desea reprogramar la cita a la fecha ' + check + ' y hora ' + hora + '?', function(resp) {
					if(resp) {
						//reprogramar
						$.ajax({
							url:      $('#rutaCitas').val() + '/reprogramar/confirmar',
							type:     'post',
							data:	  {date: date.getFullYear()+'-'+(date.getMonth() + 1)+'-'+date.getDate(), time: date.getHours()+':'+date.getMinutes(), _token: $('#_token').val()},
							dataType: 'json',
							beforeSend: function() {
								$('#modalLoading').modal('show')
							}

						}).done(function(resultado) {
							$('#modalLoading').modal('hide')

							console.log(resultado.estatus)

							if(resultado.estatus === 'fail') {
								bootbox.alert('Ocurrió un error al reprogramar la cita. Intente de nuevo')
							}

							if(resultado.estatus === 'OK') {
								// resetear variable reprogramar y recargar eventos
								$('#reprogramar').val('0')
								recargarCitas()

								bootbox.alert('Cita reprogramada con éxito.')
							}

						}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
							console.log(textStatus + ': ' + errorThrown)
							$('#reprogramar').val('0')
							bootbox.alert('Ocurrió un error al reprogramar la cita. Intente de nuevo')
						})
					}
				})
          	} else {
          		$modalAgendarCita.find('.fecha').val(selectedDate.format('YYYY-MM-DD'))
				$modalAgendarCita.find('.fecha').text(selectedDate.format('D MMMM YYYY'))
				$modalAgendarCita.find('.hora').val(selectedDate.format('HH:mm'))
				$modalAgendarCita.find('.hora').text(selectedDate.format('HH:mm'))
				$modalAgendarCita.modal('show')
				setTimeout(function() {
					$('#nombreBusqueda').focus()
				}, 500)
          	}
       	},
        eventClick: function(calEvent, jsEvent, view){
			$.ajax({
				url:      $('#rutaCitas').val() + '/detalle',
				type:     'POST',
				dataType: 'json',
				data:	  { citaId: btoa(calEvent.id) },
				beforeSend: function () {
					$('#modalLoading').modal('show')
				}

			})
			.done(function(resultado) {
				$('#modalLoading').modal('hide')
				console.log(resultado.estatus)

				if(resultado.estatus === 'fail') {
					console.log(resultado.mensaje)
					bootbox.alert('Ocurrió un error al visualizar la cita')
				}

				if (resultado.estatus === 'OK') {
					// mostrar modal de detalle
					$('#citaDetalle').html(resultado.html)
					$('#modalDetalleCita').modal('show')
				}

			})
			.fail(function(XMLHttpRequest, textStatus, errorThrown) {
				console.log(textStatus + ': ' + errorThrown)
				$('#modalLoading').modal('hide')
				bootbox.alert('Error al visualizar la cita. Intente de nuevo')
			})
        }
	})

	/**
	 * recargar citas cuando se pulsen los botones de anterior y siguiente así como cuando se presionen
	 * los botones de las visas
	 */
	$calendario.find('span.fc-button-prev, span.fc-button-next, span.fc-button-month, span.fc-button-agendaWeek').on('click', function(event) {
		recargarCitasPorDia()
	})

	// on load event for button
	setTimeout(function () {
		activarDesactivarLinkALista()
		generarLinkALista()
	}, 500)

	/**
	 * responde al evento click de dia anterior o siguiente
	 */
	function recargarCitasPorDia() {

		$('#modalLoading').modal('show')

		var view = $calendario.fullCalendar('getView')

		if (view.name === 'agendaDay') {
			generarLinkALista()
			$calendario.fullCalendar('removeEventSource', rutaCitas)
			//$calendario.fullCalendar('refetchEvents')

			fecha     = $.fullCalendar.formatDate($calendario.fullCalendar('getDate'), 'yyyy-MM-dd')
			rutaCitas = $('#rutaCitas').val() + '/ver/' + medicoId + '/' + btoa(fecha)

			$calendario.fullCalendar('addEventSource', rutaCitas)
			$calendario.fullCalendar('refetchEvents')

			setTimeout(activarDesactivarLinkALista, 1500)

		} else {
			$calendario.fullCalendar('removeEventSource', rutaCitas)
			//$calendario.fullCalendar('refetchEvents')

			rutaCitas = $('#rutaCitas').val() + '/ver/' + medicoId

			$calendario.fullCalendar('addEventSource', rutaCitas)
			$calendario.fullCalendar('refetchEvents')
			$('#generarLista').attr('disabled', true)
		}

		$('#modalLoading').modal('hide')
	}

	/**
	 * verificar cuantos eventos existen y activar|desactivar link
	 */
	function activarDesactivarLinkALista() {
		var eventos = $calendario.fullCalendar('clientEvents')

		if (eventos.length > 0) {
			$('#generarLista').attr('disabled', false)
		} else {
			$('#generarLista').attr('disabled', true)
		}
	}

	/**
	 * construir el link para la lista de citas PDF
	 */
	function generarLinkALista() {
		var fecha = $.fullCalendar.formatDate($calendario.fullCalendar('getDate'), 'yyyy-MM-dd')

		// por default no se puede
		$('#generarLista').attr('href', $('#rutaPdf').val() + '/' + $('#medicoId').val() + '/' + btoa(fecha))
	}

	function getIdOrFilter () {
		var view  = $calendario.fullCalendar('getView')
		var start = view.intervalStart
		var end   = view.intervalEnd
		return function (e) {
			// this is our event filter
			if (e.start >= start && e.end <= end) {
				// event e is within the view interval
				return true
			}
			// event e is not within the current displayed interval
			return false
		}
	}

	// al cerrar modal de detalle
	$('#modalDetalleCita').on('hidden.bs.modal', function () {
	    $('#citaDetalle').empty()
	})
})

// recargar eventos del calendario
function recargarCitas() {
	$('#calendario').fullCalendar('refetchEvents')
	activarDesactivarLinkALista()
}