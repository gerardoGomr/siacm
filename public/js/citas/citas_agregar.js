$(document).ready(function($) {
	// inicializar validaciones
	init()

	// validar form
	$('#formNuevacita').validate()
	agregaValidacionesElementos($('#formNuevacita'))

	// agendar cita
	$('#agendarCita').on('click', function () {
		if ($('#busquedaPacienteRealizada').val() === '0') {
			bootbox.alert('Por favor, busque a un paciente para agendarle su cita.')
			return false
		}

		if (!$('#formNuevaCita').valid()) {
			return false
		}

		// agendar
		agendarCita()
	})

	// evitar submit
	$('#nombreBusqueda').on('keypress', function(event) {
		if (event === 13 || event.which === 13) {
			return false
		}
	})

	// buscar paciente
	$('#nombreBusqueda').on('keyup', function(event) {
		if (event === 13 || event.which === 13) {
			// especificar al menos nombre y ap paterno
			buscarPacientes($('#nombreBusqueda').val())
		}
	})

	// buscar paciente
	$('#btnComprueba').on('click', function() {
		buscarPacientes($('#nombreBusqueda').val())
	})

	// mostar busqueda de nuevo
	$('#buscarDeNuevo').on('click', function() {
		$('#nombreBusqueda').focus()
		$('#buscadorPacientes').removeClass('hide')
		$('#datos').addClass('hide')
		$('#dvResultados').addClass('hide')
		$('#seguirCapturando').removeClass('hide')
		$('#buscarDeNuevo').addClass('hide')
		$('#agendarCita').attr('disabled', true)
	})

	// mostar seguir capturando
	$('#seguirCapturando').on('click', function() {
		$('#buscadorPacientes').addClass('hide')
		$('#datos').removeClass('hide')
		$('#nombre').focus()
		$('#dvResultados').addClass('hide')
		$('#seguirCapturando').addClass('hide')
		$('#buscarDeNuevo').removeClass('hide')
		$('#agendarCita').attr('disabled', false)
	})

	// clic en resultados, utilizar paciente
	$('#dvResultados').on('click', 'tr.seleccionarPaciente', function(event) {
		var pacienteId = $(this).data('id'),
			nombre     = $(this).children('td.nombreCompleto').text()

		bootbox.confirm('¿Desea agendar una nueva cita a ' + nombre + '?', function(r) {
			if(r) {
				// agendar cita
				$('#pacienteId').val(pacienteId)
				// agendar
				agendarCita()
			}
		})
	})

	$('#dvResultados').on('click', 'button.paciente-nuevo', function() {
		$('#buscadorPacientes').addClass('hide')
		$('#datos').removeClass('hide')
		$('#nombre').focus()
		$('#dvResultados').addClass('hide')
		$('#seguirCapturando').addClass('hide')
		$('#buscarDeNuevo').removeClass('hide')
		$('#agendarCita').attr('disabled', false)
	})

	/**
	 * buscar pacientes
	 * @param string dato
	 * @returns {boolean}
     */
	function buscarPacientes(dato) {
		if(dato === '') {
			bootbox.alert('Especifique al menos el nombre y apellido paterno')
			return false
		}

		$.ajax({
			url:      $('#btnComprueba').data('url'),
			type:     'post',
			dataType: 'json',
			data:	  { dato: dato, _token: $('#formNuevaCita').find('input[name="_token"]').val() },
			beforeSend: function () {
				$('#modalLoading').modal('show')
			}

		}).done(function(resultado) {
			$('#modalLoading').modal('hide')
			$('#busquedaPacienteRealizada').val('1')
			console.log(resultado.estatus)

			if(resultado.estatus === 'fail') {
				console.log(resultado.mensaje)
				bootbox.alert('No se encontraron coincidencias para ' + dato + '. Por favor, captúre sus datos para registrar su cita.', function () {
					$('#buscadorPacientes').addClass('hide')
					$('#datos').removeClass('hide')
					$('#nombre').focus()
					$('#dvResultados').addClass('hide')
					$('#seguirCapturando').addClass('hide')
					$('#buscarDeNuevo').removeClass('hide')
					$('#agendarCita').attr('disabled', false)
				})
			}

			if (resultado.estatus === 'OK') {
				$('#dvResultados').html(resultado.html).removeClass('hide')
			}

		}) .fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(textStatus + ': ' + errorThrown)
			$('#modalLoading').modal('hide')
			bootbox.alert('Error al buscar pacientes. Intente de nuevo')
		})
	}

	/**
	 * agendar nueva cita
	 */
	function agendarCita() {
		// agendar cita
		$.ajax({
			url:      $('#formNuevaCita').attr('action'),
			type:     'post',
			dataType: 'json',
			data:	  $('#formNuevaCita').serialize(),
			beforeSend: function () {
				$('#modalLoading').modal('show')
			}

		}).done(function(resultado) {
			$('#modalLoading').modal('hide')
			console.log(resultado.estatus)

			if(resultado.estatus === 'fail') {
				bootbox.alert('Ocurrió un error al agendar la cita. Por favor, intente de nuevo')
			}

			if (resultado.estatus === 'OK') {
				bootbox.alert('Cita agendada con éxito', function() {
					reiniciarForm()
					recargarCitas()
					$('#modalAgendarCita').modal('hide')
				})
			}

		}) .fail(function(XMLHttpRequest, textStatus, errorThrown) {
			$('#modalLoading').modal('hide')
			console.log(textStatus + ': ' + errorThrown)
			bootbox.alert('Ocurrió un error al agendar la cita. Por favor, intente de nuevo')
		})
	}

	/**
	 * reiniciar formulario al poner sus campos vacíos
	 * y layers
	 */
	function reiniciarForm() {
		document.getElementById('formNuevaCita').reset()

		$('#buscadorPacientes').removeClass('hide')
		$('#datos').addClass('hide')
		$('#nombreBusqueda').focus()
		$('#seguirCapturando').addClass('hide')
	}

	// recargar eventos del calendario
	function recargarCitas() {
		$('#calendario').fullCalendar('refetchEvents')
		setTimeout(activarDesactivarLinkALista, 500)
	}

	/**
	 * verificar cuantos eventos existen y activar|desactivar link
	 */
	function activarDesactivarLinkALista() {
		var eventos = $('#calendario').fullCalendar('clientEvents')

		if (eventos.length > 0) {
			$('#generarLista').attr('disabled', false)
		} else {
			$('#generarLista').attr('disabled', true)
		}
	}
})