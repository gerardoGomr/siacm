$(function() {
	var $txtPaciente         = $('#txtPaciente'),
		$formPaciente        = $('#formPaciente'),
		$formOtroTratamiento = $('#formOtroTratamiento'),
		idForm               = '';

	setTimeout(function(){
		$txtPaciente.focus();
	}, 500);

	// prevenir submit normal
	$txtPaciente.on('keypress', function(event) {
		if (event === 13 || event.which === 13) {
			return false;
		}
	});

	// buscar pacientes
	$txtPaciente.on('keyup', function(event) {
		if (event === 13 || event.which === 13) {
			// busqueda ajax - modo cargar
        	ajax($formPaciente.attr('action'), 'post', 'html', $formPaciente.serialize(), 'cargar', 'pacientesLoading', 'listaPacientes');
		}
	});

	// detalles de un paciente
	$('#listaPacientes').on('click', 'a.paciente', function(event) {
		event.preventDefault();

		var url   = $(this).attr('href'),
			datos = {
				'idPaciente': $(this).siblings('input.idPaciente').val(),
				'username'  : $('#username').val(),
				'_token'    : $formPaciente.find('input[name="_token"]').val()
			};

		var respuesta = ajax(url, 'post', 'html', datos, 'guardar');

		respuesta.done(function(respuesta){
			$('#dvDetalles').html(respuesta);
			idForm = $('#dvDetalles').find('form').attr('id');

			// validación básica
			$('#' + idForm).validate();

			// validar formulario
			agregaValidacionesElementos($('#' + idForm));

			// generar ajax form
			generarAjaxForm(idForm);

			// asignar valores a form de otros tratamientos
			//$('#userOtroTratamiento').val(btoa($('#' + idForm).find('input[name="idPaciente"]').val()));
			$('#userOtroTratamiento').val($('#' + idForm).find('input[name="userMedico"]').val());
			$('#idPacienteOtroTratamiento').val($('#' + idForm).find('input[name="idPaciente"]').val());
		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown){
			console.log(textStatus + ': ' + errorThrown);
		});
	});

	// borrar anexos
	$('#dvDetalles').on('click', 'a.eliminarAnexo', function(event){
		event.preventDefault();

		var idForm     = $('#dvDetalles').find('form').attr('id'),
			idPaciente = $('#' + idForm).find('input[name="idPaciente"]').val(),
			userMedico = $('#' + idForm).find('input[name="userMedico"]').val(),
			url        = $(this).attr('href'),
			datos      = {
				idPaciente: idPaciente,
				userMedico: userMedico,
				anexo     : $(this).data('id'),
				_token    : $formPaciente.find('input[name="_token"]').val()
			};

		var respuesta = ajax(url, 'post', 'html', datos, 'guardar');
		respuesta.done(function(respuesta){
			if(respuesta === '0') {
				bootbox.alert('Ocurrió un error al eliminar el anexo. Intente de nuevo');
				return false;
			}

			bootbox.alert('Anexo eliminado con éxito', function () {
				recargarDetalles(idPaciente);
			});
		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown){
			console.log(textStatus + ': ' + errorThrown);
		});
	});

	// inicializar form validación
	init();

	// validación vacía
	$formOtroTratamiento.validate();

	// validar formulario de otros tratamientos
	agregaValidacionesElementos($formOtroTratamiento);

	// guardar formulario otros tratamientos
	$('#guardarFormOtros').on('click', function(event) {
		if ($formOtroTratamiento.valid() === true) {
			if (!$formOtroTratamiento.find('input[name="ortodoncia"]').is(':checked') && !$formOtroTratamiento.find('input[name="ortopedia"]').is(':checked')) {
				bootbox.alert('Por favor, seleccione al menos un tipo de tratamiento');
				return false;
			}

			// guardar
			var respuesta = ajax($formOtroTratamiento.attr('action'), 'post', 'html', $formOtroTratamiento.serialize(), 'guardar');
			respuesta.done(function(respuesta){
				if(respuesta === '0') {
					bootbox.alert('Ocurrió un error al generar el tratamiento. Intente de nuevo');
					return false;
				}

				var idForm     = $('#dvDetalles').find('form').attr('id'),
					idPaciente = $('#' + idForm).find('input[name="idPaciente"]').val();

				bootbox.alert('Tratamiento generado con éxito', function () {
					// refrescar detalles del paciente seleccionado
					recargarDetalles(idPaciente);
				});
			})
			.fail(function(XMLHttpRequest, textStatus, errorThrown){
				console.log(textStatus + ': ' + errorThrown);
			});
		}
	});

	/**
	 * funcion para generar un formulario ajax
	 * @param form
     */
	function generarAjaxForm(form)
	{
		// agregar anexos a expediente via AJAX
		var opciones = {
			url: $('#' + form).attr('action'),
			type: 'post',
			beforeSend: function() {
				if ($('#' + form).valid() === false) {
					return false;
				}
			},
			success: function(respuesta) {
				if(respuesta === '0') {
					bootbox.alert('Ocurrió un error al agregar el anexo. Intente de nuevo');
					return false;
				}

				var idPaciente = $('#' + form).find('input[name="idPaciente"]').val();
				bootbox.alert('Anexo agregado con éxito', function () {
					recargarDetalles(idPaciente);
				});
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				console.log(textStatus + ': ' + errorThrown);
			}
		};

		$('#' + form).ajaxForm(opciones);
	}

	function recargarDetalles(idPaciente)
	{
		var url   = $('#urlDespuesAgregar').val(),
			datos = {
				idPaciente: idPaciente,
				username  : $('#username').val(),
				_token    : $formPaciente.find('input[name="_token"]').val()
			};

		var respuesta = ajax(url, 'post', 'html', datos, 'guardar');

		respuesta.done(function(respuesta){
			$('#dvDetalles').html(respuesta);
			idForm = $('#dvDetalles').find('form').attr('id');

			// validación básica
			$('#' + idForm).validate();

			// validar formulario
			agregaValidacionesElementos($('#' + idForm));

			// generar ajax form
			generarAjaxForm(idForm);
		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown){
			console.log(textStatus + ': ' + errorThrown);
		});
	}
});