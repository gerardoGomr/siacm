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
	Route::get('expedientes/ver/{pacienteId}/{medicoId}', 'Expedientes\ExpedienteController@ver');

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
	// ventana recetas
	Route::get('consultas/receta/agregar', 'Consultas\ConsultasController@capturaReceta');

	// asignar padecimientos al diente
	Route::post('consultas/asignar/diente/padecimiento', [
		'as'   => 'asignar-diente-padecimiento',
		'uses' => 'Consultas\ConsultasController@agregaDientePadecimiento'
	]);

	// generar plan de tratamiento
	Route::post('consultas/plan/agregar', [
		'as'   => 'dibujar-plan-tratamiento',
		'uses' => 'Consultas\ConsultasController@verPlan'
	]);

	// abrir ventana para plan de tratamiento
	// Route::get('consultas/plan/agregar/{med}/{id}', 'Consultas\ConsultasController@verPlan');

	// agregar un tratamiento a un diente
	Route::post('consultas/plan/tratamientos/agregar', 'Consultas\ConsultasController@agregarTratamiento');

	// agregar otro tratamiento al plan
	Route::post('consultas/plan/tratamientos/otros/agregar', 'Consultas\ConsultasController@agregarOtroTratamiento');

	// agregar receta
	Route::post('consultas/capturar/receta', 'Consultas\ConsultasController@agregarReceta');

	// agregar interconsulta
	Route::post('consultas/capturar/interconsulta', 'Consultas\ConsultasController@agregarInterconsulta');

	// guardar consulta
	Route::post('consultas/guardar', 'Consultas\ConsultasController@guardar');

	// imprimir receta
	Route::get('consultas/receta/{med}/{id}', 'Consultas\ConsultasController@receta');

	// imprimir interconsulta
	Route::get('consultas/interconsulta/{med}/{id}', 'Consultas\ConsultasController@interconsulta');

	// imprimir plan
	Route::get('consultas/plan/{med}/{id}', 'Consultas\ConsultasController@plan');

	/////////////////////////////////////////// PACIENTES //////////////////////////////////////////////
	Route::get('pacientes/{med}', 'Pacientes\PacientesController@index');
	// buscar pacientes
	Route::post('pacientes/buscar', 'Pacientes\PacientesController@buscar');
	// detalles de un paciente
	Route::post('pacientes/detalle', 'Pacientes\PacientesController@detalle');
	// agregar anexos al expediente del paciente
	Route::post('pacientes/anexo/agregar', 'Pacientes\PacientesController@agregarAnexo');
	// borrar anexos
	Route::post('pacientes/anexo/eliminar', 'Pacientes\PacientesController@eliminarAnexo');
	// generar tratamientos ortopedia - ortodoncia
	Route::post('pacientes/tratamiento/agregar', 'Pacientes\PacientesController@agregarTratamiento');

	// generar receta en PDF
	Route::get('pacientes/receta/{id}/{idPaciente}/{med}', 'Pacientes\PacientesController@generarReceta');

	// generar interconsulta PDF
	Route::get('pacientes/interconsulta/{id}/{idPaciente}/{med}', 'Pacientes\PacientesController@generarInterconsulta');

	// generar plan de tratamiento PDF
	Route::get('pacientes/plan/{id}/{idPaciente}/{med}', 'Pacientes\PacientesController@generarPlan');

	/////////////////////////////////////////// USUARIOS /////////////////////////////////////////////////////
	Route::get('usuarios', 'Usuarios\UsuariosController@index');
	Route::get('usuarios/agregar', 'Usuarios\UsuariosController@agregar');
	Route::post('usuarios/buscar', 'Usuarios\UsuariosController@buscar');
	Route::post('usuarios/agregar', [
		'as'  => 'usuarios-agregar',
		'uses' =>'Usuarios\UsuariosController@guardarUsuario'
	]);
});