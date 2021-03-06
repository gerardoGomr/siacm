<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('login', 'Usuarios\LoginController@index');
Route::post('login', 'Usuarios\LoginController@logueo');
Route::get('logout', 'Usuarios\LoginController@logout');

// aplicacion
Route::group(['middleware' => 'checaLogin'], function() {
	// pagina principal
	Route::get('/', 'PrincipalController@index');
	/////////////////////////////////////////// CITAS /////////////////////////////////////////////////////
	// pagina principal
	Route::get('citas/{medicoId}', 'Citas\CitasController@index');

	// ver eventos
	Route::get('citas/ver/{medicoId}/{fecha?}', 'Citas\CitasController@verCitas');

	// guardar cita
	Route::post('citas/agendar', 'Citas\CitasController@agendar');

	// verificar que exista un expediente
	Route::post('citas/pacientes/buscar', 'Citas\CitasController@buscarPacientes');

	// ver detalles de una cita
	Route::post('citas/detalle', 'Citas\CitasController@verDetalle');

	// ver formulario de editar
	Route::get('citas/editar/{id}', 'Citas\CitasController@editar');

	// actualizar cita
	Route::post('citas/actualizar', 'Citas\CitasController@actualizar');

	// modificar estatus de cita
	Route::post('citas/estatus', 'Citas\CitasController@cambiarEstatus');

	// seleccion de reprogramar
	Route::post('citas/reprogramar/asignar', 'Citas\CitasController@asignarReprogramacion');

	// acción de reprogramar
	Route::post('citas/reprogramar/confirmar', 'Citas\CitasController@reprogramar');

	// generar el reporte de las citas del dia
	Route::get('citas/lista/pdf/{medicoId}/{fecha}', 'Citas\CitasController@generarLista');
	///////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////// EXPEDIENTES //////////////////////////////////////////////
	// abrir formulario de captura
	Route::get('expedientes/registrar/{pacienteId}/{medicoId}/{citaId?}', 'Expedientes\ExpedienteController@registrar');

	// abrir pantalla de vista previa
	Route::get('expedientes/ver/{pacienteId}/{medicoId}/{citaId?}', 'Expedientes\ExpedienteController@ver');

	// guardar / editar expediente
	Route::post('expedientes/registrar', 'Expedientes\ExpedienteController@registrarExpediente');

	// firmar expediente
	Route::post('expedientes/firmar', 'Expedientes\ExpedienteController@firmar');

	// subir foto
	Route::post('expedientes/foto/anexar', 'Expedientes\ExpedienteController@anexarFoto');

	//recortar foto
	Route::post('expedientes/foto/recortar', 'Expedientes\ExpedienteController@recortarFoto');

	// guardar foto capturada por camara
	Route::post('expedientes/foto/guardar', 'Expedientes\ExpedienteController@capturarFoto');

    // desplegar una foto anexada-capturada
    Route::get('expedientes/foto/mostrar/{imagen}', function ($imagen) {
        $imagen   = base64_decode($imagen);
        $archivo  = File::get($imagen);
        $response = Response::make($archivo, 200);

        $response->header('Content-Type', File::mimeType($imagen));

        return $response;
    });

    // generar el expediente en PDF
    Route::get('expedientes/pdf/{expedienteId}/{medicoId}', 'Expedientes\ExpedienteController@generarExpedientePDF');

	/////////////////////////////////////////// CONSULTAS //////////////////////////////////////////////
	// principal consultas
	Route::get('consultas/{medicoId}', 'Consultas\ConsultasController@index');

	// buscar citas por dia
	Route::post('consultas/citas', 'Consultas\ConsultasController@verCitasDelDia');

	// ver detalle de una cita
	Route::post('consultas/cita/detalle', 'Consultas\ConsultasController@citaDetalle');

	// abrir pantalla de captura de consulta
	Route::get('consultas/capturar/{pacienteId}/{medicoId}/{citaId}', 'Consultas\ConsultasController@capturar');

	// abrir pantalla de selección de estatus, pasando el número de diente
	Route::get('consultas/odontograma/estatus/{id}', 'Consultas\ConsultasController@seleccionEstatus');

	// guardar estatus para el odontograma
	Route::post('consultas/odontograma/estatus/asignar', 'Consultas\ConsultasController@asignarEstatusDental');

	// pintar odontograma
	Route::post('consultas/odontograma/dibujar', 'Consultas\ConsultasController@dibujar');

	// agregar una receta a la consulta
	Route::post('consultas/receta/agregar', 'Consultas\ConsultasController@agregarReceta');

	// agregar higiene dental
    Route::post('consultas/higiene/agregar', 'Consultas\ConsultasController@agregarHigieneDental');

    // agregar indicacion
    Route::post('consultas/indicacion/agregar', 'Consultas\ConsultasController@agregarIndicacion');

	// asignar padecimientos al diente
	Route::post('consultas/asignar/diente/padecimiento', [
		'as'   => 'asignar-diente-padecimiento',
		'uses' => 'Consultas\ConsultasController@agregaDientePadecimiento'
	]);

    // remover padecimientos al diente
    Route::post('consultas/diente-padecimientos/remover', 'Consultas\ConsultasController@removerDientePadecimiento');

	// generar plan de tratamiento
	Route::post('consultas/plan/agregar', [
		'as'   => 'dibujar-plan-tratamiento',
		'uses' => 'Consultas\ConsultasController@generarPlanTratamiento'
	]);

	// agregar un tratamiento a un diente
	Route::post('consultas/plan/tratamientos/agregar', 'Consultas\ConsultasController@agregarTratamiento');

	// agregar otro tratamiento al plan
	Route::post('consultas/plan/tratamientos/otros/agregar', 'Consultas\ConsultasController@agregarOtroTratamiento');

	// eliminar otro tratamiento del plan
	Route::post('consultas/plan/tratamientos/otros/eliminar', 'Consultas\ConsultasController@eliminarOtroTratamiento');

	// eliminar tratamiento del plan
	Route::post('consultas/plan/tratamientos/eliminar', 'Consultas\ConsultasController@eliminarTratamiento');

	Route::post('plan-tratamiento/atender', 'Pacientes\PacientesController@atenderPlan');

	// imprimir plan
	Route::get('consultas/plan/pdf/{pacienteId}/{medicoId}', 'Consultas\ConsultasController@planPDF');

	// agregar interconsulta
	Route::post('consultas/interconsulta/agregar', 'Consultas\ConsultasController@agregarInterconsulta');

	// guardar consulta
	Route::post('consultas/guardar', 'Consultas\ConsultasController@guardarConsulta');

	// imprimir receta
	Route::get('consultas/receta/{pacienteId}/{medicoId}', 'Consultas\ConsultasController@generarRecetaEnPDF');

	// imprimir higiene dental
    Route::get('consultas/higiene/{pacienteId}/{medicoId}', 'Consultas\ConsultasController@generarHigieneDentalPDF');

    // imprimir indicacion
    Route::get('consultas/indicacion/{pacienteId}/{medicoId}', 'Consultas\ConsultasController@generarIndicacionPDF');

	// imprimir interconsulta
	Route::get('consultas/interconsulta/{pacienteId}/{medicoId}', 'Consultas\ConsultasController@generarInterconsultaEnPDF');

    // imprimir la nota médica PDF
    Route::get('consultas/nota/{consultaId}/{expedienteId}', 'Consultas\ConsultasController@notaMedicaPDF');

	/////////////////////////////////////////// PACIENTES //////////////////////////////////////////////
    // generar vista de búsqueda de expedientes
	Route::get('pacientes/{medicoId}', 'Pacientes\PacientesController@index');

	// buscar pacientes
	Route::post('pacientes/buscar', 'Pacientes\PacientesController@buscar');

	// detalles de un paciente
	Route::post('pacientes/detalle', 'Pacientes\PacientesController@detalle');

	// agregar anexos al expediente del paciente
	Route::post('pacientes/anexos/agregar', 'Pacientes\PacientesController@agregarAnexo');

    // ver anexo
    Route::get('pacientes/anexos/ver/{expedienteId}/{medicoId}/{nombre}', 'Pacientes\PacientesController@verAnexo');

	// borrar anexos
	Route::post('pacientes/anexos/eliminar', 'Pacientes\PacientesController@eliminarAnexo');

	// generar tratamientos ortopedia - ortodoncia
	Route::post('pacientes/tratamiento/otros/agregar', 'Pacientes\PacientesController@agregarTratamiento');

	// editar tratamientos ortopedia - ortodoncia
    Route::post('pacientes/tratamiento/otros/editar', 'Pacientes\PacientesController@editarTratamiento');

    // tratamientos ortopedia - ortodoncia en PDF
    Route::get('pacientes/tratamientos/otros/pdf/{tratamientoId?}', 'Pacientes\PacientesController@otroTratamientoPdf');

	// generar receta en PDF
	Route::get('pacientes/receta/{recetaId}/{expedienteId}', 'Pacientes\PacientesController@generarReceta');

    // generar indicaciones en PDF
    Route::get('pacientes/higiene/{higieneId}/{expedienteId}', 'Pacientes\PacientesController@generarIndicacionesHigieneDental');

    // generar indicaciones en PDF
    Route::get('pacientes/indicacion/{indicacionId}/{expedienteId}', 'Pacientes\PacientesController@generarIndicaciones');

	// generar interconsulta PDF
	Route::get('pacientes/interconsulta/{interconsultaId}/{expedienteId}', 'Pacientes\PacientesController@generarInterconsulta');

	// generar plan de tratamiento PDF
	Route::get('pacientes/plan/{odontogramaId}/{expedienteId}', 'Pacientes\PacientesController@generarPlan');

    // cobrar consulta
    Route::post('pacientes/consultas/cobrar', 'Pacientes\PacientesController@cobrarConsulta');

    // generar PDF de comprobante de pago
    Route::get('pacientes/consulta/recibo/{consultaId?}', 'Pacientes\PacientesController@generarReciboPago');

    // cobrar otros tratamientos
    Route::post('pacientes/otrosTratamientos/cobrar', 'Pacientes\PacientesController@cobrarOtroTratamiento');

    // ruta para mostrar PDF del cobro de otro tratamiento
    Route::get('pacientes/otrosTratamientos/recibo/{id}', 'Pacientes\PacientesController@generarReciboPagoOtros');

    // ruta para generar reporte de pagos de otros tratamientos
    Route::get('pacientes/tratamientos/otros/{id}/pagos', 'Reportes\ReportesController@pagosOtrosTratamientos');

	/////////////////////////////////////////// USUARIOS /////////////////////////////////////////////////////
    // ruta para mostrar listado de usuarios
	Route::get('usuarios', 'Usuarios\UsuariosController@index');

	// ruta para agregar nuevo usuario
	Route::get('usuarios/agregar', 'Usuarios\UsuariosController@agregar');

	// ruta para buscar usuarios
	Route::post('usuarios/buscar', 'Usuarios\UsuariosController@buscar');

	// ruta para guardar usuario
	Route::post('usuarios/agregar', 'Usuarios\UsuariosController@guardar');

	// ruta para editar un usuario
    Route::get('usuarios/editar/{id?}', 'Usuarios\UsuariosController@editar');

    // ruta para modificar un usuario
    Route::post('usuarios/editar', 'Usuarios\UsuariosController@modificar');

    // ruta para eliminar a un usuario
    Route::post('usuarios/eliminar', 'Usuarios\UsuariosController@eliminar');

    // ruta para activar a un usuario
    Route::post('usuarios/activar', 'Usuarios\UsuariosController@activar');

    // ruta para cambiar la contraseña de usuario
    Route::post('usuarios/cambiar-contrasenia', 'Usuarios\UsuariosController@cambiarContrasenia');

    // ruta para pago de consultas
    Route::get('consultas/pago/{medicoId?}', 'Pagos\ConsultasPagosController@index');

    // ruta para buscar no pagadas
    Route::post('consultas/buscar/no-pagadas', 'Pagos\ConsultasPagosController@buscarNoPagadas');

    // reportes
    Route::get('reportes/cobro-consultas/{medicoId?}', 'Reportes\ReportesController@vistaCobroConsultas');

    // consultas del dia
    Route::post('reportes/cobro-consultas', 'Reportes\ReportesController@cobroConsultas');
    
    // editar anexos
    Route::post('pacientes/anexos/editar', 'Pacientes\PacientesController@editarAnexo');

    // guardar plan cirugía
    Route::post('pacientes/cirugias/agregar', 'Pacientes\PacientesController@guardarPlanCirugia');
    
    // abrir pdf plan
    Route::get('pacientes/cirugias/pdf/{id}/{expId}', 'Pacientes\PacientesController@planCirugiaPdf');
});
