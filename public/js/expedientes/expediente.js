$(function() {
	// variables
	var $formExpediente    	  = $('#formExpediente'),
		$formSubirImagen        = $('#formSubirImagen'),
		$txtNumHermanos         = $('#txtNumHermanos'),
		$txtNumHermanosVivos   = $('#txtNumHermanosVivos'),
		$txtNumHermanosFinados = $('#txtNumHermanosFinados'),
		$adjuntarFoto           = $('#adjuntarFoto'),
		$btnAbrirCamara 	      = $('#btnAbrirCamara'),
		$btnRecortarImagen      = $('#btnRecortarImagen'),
		$btnAceptarRecorte      = $('#btnAceptarRecorte'),
		$fotografia		      = $('#fotografiaAgregada'),
		_token                   = $('input[name="_token"]').val();

	// datepicker
	$formExpediente.find('input.fecha').datepicker({
		autoclose: true,
		language:  'es',
		format:    'yyyy-mm-dd'
	});

	// inicializar validaciones
	init();

	// objeto para subir el form $formSubirImagen via ajax
	var opciones = {
		url:        $formSubirImagen.attr('action'),
		type:       'post',
		beforeSend: function() {
			if($formSubirImagen.valid() === false) {
				return false;
			}
		},
		success: function(foto, statusText, xhr, $form){
			$fotografia.html(foto);
			$('#capturada').val('1');
			// asignar la url de la foto capturada / adjuntada al elemento del form usuario
			$('#foto').val($('#urlFoto').val());
		},
		error:   function(XMLHttpRequest, textStatus, errorThrown){
			console.log(errorThrown);
			bootbox.alert("Imposible realizar la operación solicitada.");
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
	$('#subirFoto').on('click', function(event) {
		$adjuntarFoto.click();
	});

	//adjuntar imagen
	$adjuntarFoto.on('change', function(event) {
		//subir el archivo via ajax
		$formSubirImagen.submit();
		$adjuntarFoto.replaceWith($adjuntarFoto.val('').clone(true));
	});

	// evento para boton abrir cámara
	$btnAbrirCamara.on('click', function(event) {
		// prevenir evento default
		event.preventDefault();
		// abrir ventana de captura
		window.open($btnAbrirCamara.attr('href'), '_blank', 'width=400, height=500, scrollbars=yes');
	});

	// botón recortar imagen
	$fotografia.on('click', 'a.recortar', function(event) {
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
	$fotografia.on('click', 'a.aceptarRecorte', function(event) {
		var datos = {
			x: 		    $("#x").val(),
			y: 		    $("#y").val(),
			w: 		    $("#w").val(),
			h: 		    $("#h").val(),
			urlFoto:    $('#urlFoto').val(),
			idPaciente: $('#idPaciente').val(),
			userMedico: $('#userMedico').val(),
			_token:     $formSubirImagen.find('input[name="_token"]').val()
		};

		var respuesta = ajax($('#urlFotoRecortada').val(), 'post', 'html', datos, 'guardar', '', '');

		respuesta.done(function(resultado) {
			console.log(resultado);

			if(resultado === '0') {
				bootbox.alert('Ocurrió un error al realizar la operación solicitada. Intente de nuevo.');
				return false;
			}
			bootbox.alert('Operación realizada con éxito', function() {
				jcrop.destroy();
				$fotografia.html(resultado);
			});
		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(errorThrown);
			bootbox.alert('Imposible realizar la operación solicitada');
		});
	});

	// activar / desctivar input de automedicado
	$formExpediente.find('input.automedicado').on('click', function(event) {

		if($(this).val() === '1') {
			$('#txtConQueHaAutomedicado').attr('readonly', false);
		}

		if($(this).val() === '2') {
			$('#txtConQueHaAutomedicado').attr('readonly', 'readonly');
		}
	});

	// activar / desctivar input de alergico
	$formExpediente.find('input.alergico').on('click', function(event) {

		if($(this).val() === '1') {
			$('#txtACualEsAlergico').attr('readonly', false);
		}

		if($(this).val() === '2') {
			$('#txtACualEsAlergico').attr('readonly', 'readonly');
		}
	});

	// activar / desactivar input de vive madre
	$formExpediente.find('input.viveMadre').on('click', function(event) {

		if($(this).val() === '2') {
			$('#txtCausaMuerteMadre').attr('readonly', false);
		}

		if($(this).val() === '1') {
			$('#txtCausaMuerteMadre').attr('readonly', 'readonly');
		}
	});

	// activar / desactivar input de vive padre
	$formExpediente.find('input.vivePadre').on('click', function(event) {

		if($(this).val() === '2') {
			$('#txtCausaMuertePadre').attr('readonly', false);
		}

		if($(this).val() === '1') {
			$('#txtCausaMuertePadre').attr('readonly', 'readonly');
		}
	});

	// evento keyup de hermano
	$txtNumHermanos.on('keyup', function(event) {
		var resta;

		if ($(this).val() === '0') {
			$txtNumHermanosVivos.val('0');
			$txtNumHermanosFinados.val('0');

			return false;
		}

		if($txtNumHermanosVivos.val() > 0) {
			resta = Number($txtNumHermanos.val()) - Number($txtNumHermanosVivos.val());
			$txtNumHermanosFinados.val(resta);
		}
	});

	$txtNumHermanosVivos.on('keyup', function(event) {
		var resta;

		if($txtNumHermanos.val() > 0) {
			resta = Number($txtNumHermanos.val()) - Number($txtNumHermanosVivos.val());
			$txtNumHermanosFinados.val(resta);
		}
	});

	// guardar formulario
	$formExpediente.find('a.guardar').on('click', function(event) {
		// si es un correo valido
		if ($formExpediente.valid() === true) {
			$.ajax({
				url:      $formExpediente.attr('action'),
				type:     'post',
				// dataType: 'json',
				data:     $formExpediente.serialize()
			})
			.done(function(resultado) {
				console.log(resultado);

				// exito
				if(resultado !== '1') {
					bootbox.alert('Ocurrió un error. Intente de nuevo');
					return false;
				}

				bootbox.alert('Expediente generado con éxito', function(){
					$('#modo').val('2');
					window.opener.location.reload(true);
					window.close();
				});
			})
			.fail(function(XMLHttpRequest, textStatus, errorThrown) {
				console.log(errorThrown.responseJSON);
			});
		} else {
			bootbox.alert('Existen campos obligatorios que aún no se capturan. Por favor, complete los datos.');
		}
	});
});

/**
 * actualizar coordenadas obtenidas de jCrop
 * @param  object c
 * @return
 */
function actualizaCoordenadas(c)
{
	$('#x').val(c.x);
	$('#y').val(c.y);
	$('#w').val(c.w);
	$('#h').val(c.h);
}