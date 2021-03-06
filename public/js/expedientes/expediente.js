$(document).ready(function() {
	// variables
	var $formExpediente        = $('#formExpediente'),
		$formSubirImagen       = $('#formSubirImagen'),
		$numHermanos           = $('#numHermanos'),
		$numHermanosVivos      = $('#numHermanosVivos'),
		$numHermanosFinados    = $('#numHermanosFinados'),
		$adjuntarFoto          = $('#adjuntarFoto'),
		$fotografia            = $('#fotografiaAgregada'),
		_token                 = $('input[name="_token"]').val();

	// inicializar la cámara
	Webcam.set({
		fps:         45,
		crop_width:  200,
		crop_height: 200
	});

	// abrir modal para fotos
	$('#btnAbrirCamara').on('click', function () {
		$('#modalCapturarFoto').modal('show');

		// attach
		setTimeout(function() {
			Webcam.attach('#camara');
		}, 500);
	});

	// datepicker
	$formExpediente.find('input.fecha').datepicker({
		autoclose: true,
		language:  'es',
		format:    'yyyy-mm-dd',
		endDate:   '+0d'
	});

	// calcular edad
	$('#fechaNacimiento').datepicker()
		.on('changeDate', function (fechaElegida) {

			var now          = moment(),
				fechaElegida = moment(fechaElegida.date),
		  	 	years        = now.diff(fechaElegida, 'years');

			now.add(-years, 'years');

			var	months = now.diff(fechaElegida, 'months');

			now.add(-months, 'months');

		 	var days = now.diff(fechaElegida, 'days');

			$('#edadAnios').val(years);
			$('#edadMeses').val(months);
	});

	// inicializar validaciones
	init();

	// objeto para subir el form $formSubirImagen via ajax
	var opciones = {
		url:        $formSubirImagen.attr('action'),
		type:       'post',
		dataType:   'json',
		beforeSend: function() {
			if(!$formSubirImagen.valid()) {
				bootbox.alert('Anexe únicamente fotografías que tengan extensión JPG');

				return false;
			}

			$('#modalLoading').modal('show');
		},
		success: function(respuesta){
			$('#modalLoading').modal('hide');

			if (respuesta.estatus === 'fail') {
                var mensaje = respuesta.mensaje !== '' ? respuesta.mensaje : '';
				bootbox.alert("Ocurrió un error al anexar la fotografía del paciente. Intente de nuevo." + mensaje);
			}

			if (respuesta.estatus === 'OK') {
				$fotografia.html(respuesta.html);
				$('#capturada').val('1');
				// asignar la url de la foto capturada / adjuntada al elemento del form usuario
				$('#foto').val($('#urlFoto').val());
			}
		},
		error:   function(XMLHttpRequest, textStatus, errorThrown){
			$('#modalLoading').modal('hide');
			console.log(errorThrown);
			bootbox.alert("Ocurrió un error al anexar la fotografía del paciente. Intente de nuevo.");
		}
	};

	// validate
	$formSubirImagen.validate({
		ignore: []
	});

	// validate main form
	$formExpediente.validate({
		ignore: []
	});

	// validacion de formulario
	agregaValidacionesElementos($formSubirImagen);
	agregaValidacionesElementos($formExpediente);

	// form ajax
	$formSubirImagen.ajaxForm(opciones);

	// botón subida de archivos
	$('#subirFoto').on('click', function() {
		$formSubirImagen.find('input.imagenJpg').click();
	});

	//adjuntar imagen
	$formSubirImagen.on('change', 'input.imagenJpg', function() {
		//subir el archivo via ajax
		if (!$formSubirImagen.valid()) {
			bootbox.alert('Ingrese una imagen con extensión .jpg');
			return false;

		}
		$formSubirImagen.submit();
		var inputImagen = $formSubirImagen.find('input.imagenJpg');
		inputImagen.replaceWith(inputImagen.val('').clone(true));

		agregaValidacionAElemento('adjuntarFoto', 'imagenJpg');
	});

	// botón recortar imagen
	$fotografia.on('click', 'a.recortar', function() {
		$(this).siblings('a.aceptarRecorte').show();
		$(this).siblings('a.cancelarRecorte').show();
		$(this).hide();

		jcrop = $.Jcrop("#fotoCapturada", {
	    	bgOpacity: 0.4,
			onSelect:  actualizaCoordenadas
		});
	});

	// botón cancelar recorte
	$fotografia.on('click', 'a.cancelarRecorte', function(event) {
		jcrop.destroy();
		$(this).hide();
		$(this).siblings('a.aceptarRecorte').hide();
		$(this).siblings('a.recortar').show();
	});

	// boton aceptar recorte de imagen
	$fotografia.on('click', 'a.aceptarRecorte', function() {
		var datos = {
			x: 		    $("#x").val(),
			y: 		    $("#y").val(),
			w: 		    $("#w").val(),
			h: 		    $("#h").val(),
			urlFoto:    $('#urlFoto').val(),
			pacienteId: $('#pacienteId').val(),
			_token:     $formSubirImagen.find('input[name="_token"]').val()
		};

		$.ajax({
			url:      $('#urlFotoRecortada').val(),
			type:     'post',
			dataType: 'json',
			data:	  datos,
			beforeSend: function () {
				$('#modalLoading').modal('show');
			}
		}).done(function(resultado) {
			$('#modalLoading').modal('hide');
			console.log(resultado.estatus);

            var mensaje = resultado.mensaje !== '' ? resultado.mensaje : '';

			if(resultado.estatus === 'fail') {
				console.log(resultado.mensaje);
				bootbox.alert('Ocurrió un error al guardar la fotografía recortada. Intente de nuevo.' + mensaje);
			}

			if (resultado.estatus === 'OK') {
				// mostrar modal de detalle
				jcrop.destroy();
				$fotografia.html(resultado.html);
				$('#capturada').val('1');
			}

		}) .fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(textStatus + ': ' + errorThrown);
			$('#modalLoading').modal('hide');
			bootbox.alert('Ocurrió un error al guardar la fotografía recortada. Intente de nuevo');
		});
	});

	$('#widgetForm').on('click', 'a', function() {
		$(this).parents('li').addClass('bg-primary');
		$(this).parents('li').siblings('li').removeClass('bg-primary');
	});

	// activar / desctivar input de automedicado
	$formExpediente.find('input.automedicado').on('click', function(event) {

		if($(this).is(':checked')) {
			$('#conQueHaAutomedicado').attr('readonly', false).rules('add', {
				required: true,
				messages: {
					required: 'Especifique con qué lo ha automedicado'
				}
			});

		} else {
			$('#conQueHaAutomedicado').attr('readonly', 'readonly').rules('remove');
			$("label.error").hide();
			$(".error").removeClass("error");
		}
	});

	// activar / desctivar input de alergico
	$formExpediente.find('input.alergico').on('click', function(event) {

		if($(this).is(':checked')) {
			$('#aCualEsAlergico').attr('readonly', false).rules('add', {
				required: true,
				messages: {
					required: 'Especifique a qué es alérgico'
				}
			});

		} else {
			$('#aCualEsAlergico').attr('readonly', 'readonly').rules('remove');
		}
	});

	// activar / desactivar input de vive madre
	$formExpediente.find('input.viveMadre').on('click', function(event) {
		if($(this).val() === '2') {
			$('#causaMuerteMadre').attr('readonly', false);
		}

		if($(this).val() === '1') {
			$('#causaMuerteMadre').attr('readonly', 'readonly');
		}
	});

	// activar / desactivar input de vive padre
	$formExpediente.find('input.vivePadre').on('click', function(event) {
		if($(this).val() === '2') {
			$('#causaMuertePadre').attr('readonly', false);
		}

		if($(this).val() === '1') {
			$('#causaMuertePadre').attr('readonly', 'readonly');
		}
	});

	// evento keyup de hermano
	$numHermanos.on('keyup', function(event) {
		var resta;

		if ($(this).val() === '0') {
			$numHermanosVivos.val('0');
			$numHermanosFinados.val('0');

			return false;
		}

		if($numHermanosVivos.val() > 0) {
			resta = Number($numHermanos.val()) - Number($numHermanosVivos.val());
			$numHermanosFinados.val(resta);
		}
	});

	$numHermanosVivos.on('keyup', function(event) {
		var resta;

		if($numHermanos.val() > 0) {
			resta = Number($numHermanos.val()) - Number($numHermanosVivos.val());
			$numHermanosFinados.val(resta);
		}
	});

	// primera visita al dentista
	$('#primeraVisita').on('click', function() {
		if ($(this).is(':checked')) {
			$formExpediente.find('input.primeraVisita').attr('readonly', true);
			$formExpediente.find('input.primeraVisita').val('');
			$('#fechaUltimoExamen').rules('remove').removeClass('hasError');
			$('#motivoUltimoExamen').rules('remove').removeClass('hasError');

		} else {
			$formExpediente.find('input.primeraVisita').attr('readonly', false);

			// agregar validaciones
			$('#fechaUltimoExamen').rules('add', {
				required: true,
				messages: {
					required: 'Ingrese la fecha'
				}
			});

			$('#motivoUltimoExamen').rules('add', {
				required: true,
				messages: {
					required: 'Ingrese el motivo'
				}
			});
		}
	});

	// anestésico
	$('#anestesico').on('click', function() {
		if ($(this).is(':checked')) {
			$formExpediente.find('input.malaReaccion').attr('disabled', false);
		} else {
			$formExpediente.find('input.malaReaccion').attr('disabled', true);
			$('#queReaccion').attr('readonly', true);
			$('#queReaccion').rules('remove');
		}
	});

	// mala reacción
	$formExpediente.on('click', 'input.malaReaccion', function(event) {
		// si tuvo
		if ($(this).val() === '1') {
			$('#queReaccion').attr('readonly', false);
			agregaValidacionAElemento('queReaccion', 'required');
		}
		// no tuvo
		if ($(this).val() === '2') {
			$('#queReaccion').attr('readonly', true);
			$('#queReaccion').rules('remove');
		}
	});

	// otro auxiliar bucodental
	$('#otroAuxiliar').on('click',function(event) {
		if ($(this).is(':checked')) {
			$('#especifiqueAuxiliar').attr('readonly', false);
			agregaValidacionAElemento('especifiqueAuxiliar', 'required');

		} else {
			$('#especifiqueAuxiliar').attr('readonly', true);
			$('#especifiqueAuxiliar').rules('remove');
		}
	});

	// otro habito oral
	$('#otroHabito').on('click',function(event) {
		if ($(this).is(':checked')) {
			$('#especifiqueHabito').attr('readonly', false);
			agregaValidacionAElemento('especifiqueHabito', 'required');

		} else {
			$('#especifiqueHabito').attr('readonly', true);
			$('#especifiqueHabito').rules('remove');
		}
	});

	// guardar formulario
	$formExpediente.find('button.guardar').on('click', function(event) {
		// si es un correo valido
		if (!$formExpediente.valid()) {
			bootbox.alert('Existen campos obligatorios que aún no se capturan. Por favor, complete los datos.');
			return false;
		}

		if ($('#capturada').val() === '1') {
			if ($('#imagenRecortada').val() === '0') {
				bootbox.confirm('Se anexará la fotografía del paciente sin editar (tal como se capturó). ¿Desea continuar sin editarla?', function(r) {
					if (r) {
						guardarExpediente();
					} else {
						return false;
					}
				});
			} else {
				guardarExpediente();
			}
		} else {
			guardarExpediente();
		}
	});

    // registrar expediente
	function guardarExpediente() {
		$.ajax({
			url:      $formExpediente.attr('action'),
			type:     'post',
			dataType: 'json',
			data:     $formExpediente.serialize(),
			beforeSend: function() {
				$('#modalLoading').modal('show');
			}

		}).done(function(resultado) {
			$('#modalLoading').modal('hide');

			if(resultado.estatus === 'fail') {
				bootbox.alert('Ocurrió un error al generar el expediente. Intente de nuevo.');
			}

			if (resultado.estatus === 'OK') {
				// redirigir a pantalla de citas del médico actual. Enviar el id de cita abrir el modal
				bootbox.alert('Expediente generado con éxito', function(){
					window.location.href = $('#urlSiguiente').val();
				});
			}

		}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
			$('#modalLoading').modal('hide');
			console.log(textStatus + ': ' + errorThrown);
			bootbox.alert('Ocurrió un error al generar el expediente. Intente de nuevo');
		});
	}

    // activar y desactivar elementos de medida
    $formExpediente.find('input.medidas').on('click', function(event) {
        var idInputText = $(this).data('id');

        if ($(this).is(':checked')) {
            $('#' + idInputText).attr('readonly', false);
        } else {
            $('#' + idInputText).attr('readonly', true);
            $('#' + idInputText).val('');
        }
    });

    $formExpediente.find('input.regimenAlimenticio').on('click', function () {
    	if ($(this).is(':checked')) {
    		$('#especifiqueRegimen').attr('readonly', false)
    	} else {
    		$('#especifiqueRegimen').attr('readonly', false)
    		$('#especifiqueRegimen').val('')
    	}
    })
});

/**
 * actualizar coordenadas obtenidas de jCrop
 * @param  object c
 * @return
 */
function actualizaCoordenadas(c) {
	$('#x').val(c.x);
	$('#y').val(c.y);
	$('#w').val(c.w);
	$('#h').val(c.h);
}
