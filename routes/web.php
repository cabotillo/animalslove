<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

Auth::routes();

Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::get('editarperfil/cuenta', ['as' => 'editarperfil.cuenta', 'uses' => 'EditarPerfil@cuenta']);
Route::post('editarperfil/cuenta', ['as' => 'editarperfil.cuenta', 'uses' => 'EditarPerfil@updateCuenta']);

Route::get('editarperfil/premium', ['as' => 'editarperfil.premium', 'uses' => 'EditarPerfil@premium']);
Route::post('editarperfil/premium', ['as' => 'editarperfil.premium', 'uses' => 'EditarPerfil@updatePremium']);

Route::get('editarperfil/password', ['as' => 'editarperfil.password', 'uses' => 'EditarPerfil@password']);
Route::post('editarperfil/password', ['as' => 'editarperfil.password', 'uses' => 'EditarPerfil@updatePassword']);

Route::get('editar/mascota/{id}', ['as' => 'editarperfil.editarmascota', 'uses' => 'EditarPerfil@editarMascota']);
Route::post('editar/mascota/{id}', ['as' => 'editarperfil.editarmascota', 'uses' => 'EditarPerfil@updateMascota']);

Route::get('editarperfil/mascotas', ['as' => 'editarperfil.mascotas', 'uses' => 'EditarPerfil@addMascota']);
Route::post('editarperfil/mascotas', ['as' => 'editarperfil.addmascota', 'uses' => 'EditarPerfil@insertarMascota']);

Route::get('perfil/{login}', ['as' => 'miperfil', 'uses' => 'Vistas@miperfil']);

Route::get('nuevapublicacion', ['as' => 'nuevapublicacion', 'uses' => 'EditarPerfil@addPublicacion']);
Route::post('nuevapublicacion', ['as' => 'nuevapublicacion', 'uses' => 'EditarPerfil@insertarPublicacion']);

Route::get('/filtrar', ['as' => 'filtrar', 'uses' => 'Vistas@selectRaza']);
Route::post('/busqueda', ['as' => 'busqueda', 'uses' => 'Vistas@busqueda']);

Route::get('/admin', ['as' => 'admin', 'uses' => 'AdminController@index']);

Route::get('/mascota/{id}', ['as' => 'mascota', 'uses' => 'Vistas@mascota']);

Route::get('/publicacion/{id}', ['as' => 'publicacion', 'uses' => 'Vistas@publicacion']);

Route::get('reporte/{id}', ['as' => 'reporte', 'uses' => 'AdminController@reporte']);
Route::post('reporte/{id}', ['as' => 'reporte', 'uses' => 'AdminController@postReporte']);

Route::get('daradmin/{id}', ['as' => 'postadmin', 'uses' => 'AdminController@admin']);
Route::get('quitaradmin/{id}', ['as' => 'postadmin', 'uses' => 'AdminController@adminD']);

Route::get('bloquear/{id}', ['as' => 'bloquear', 'uses' => 'AdminController@bloquear']);
Route::get('desbloquear/{id}', ['as' => 'bloquear', 'uses' => 'AdminController@bloquearD']);
Route::get('eliminarMascota/{id}', ['as' => 'bloquear', 'uses' => 'EditarPerfil@eliminarMascota']);
Route::get('eliminarPublicacion/{id}', ['as' => 'eliminar', 'uses' => 'EditarPerfil@eliminarPublicacion']);


Route::get('admin/editarcuenta/{id}', ['as' => 'getperfil', 'uses' => 'AdminController@getPerfil']);
Route::post('admin/editarcuenta/{id}', ['as' => 'postperfil', 'uses' => 'AdminController@postPerfil']);

Route::get('imagenes/{id}', ['as' => 'imagenes', 'uses' => 'EditarPerfil@addImagenes']);
Route::post('imagenesdelete/{id}', ['as' => 'imagenesdelete', 'uses' => 'EditarPerfil@postDeleteImagenes']);
Route::post('imagenesadd/{id}', ['as' => 'imagenesadd', 'uses' => 'EditarPerfil@postInsertImagenes']);


Route::get('mensajes/',['as' => 'mensajes', 'uses' => 'ChatController@index']);

//Comprobar si esta el chat
Route::get('chat/{login}',['as' => 'chat', 'uses' => 'ChatController@comprobar']);

//Cargar el chat
Route::get('mensajes/{login}',['as' => 'chats', 'uses' => 'ChatController@cargarMensajes']);

Route::post('mensajes/{login}',['as' => 'chats', 'uses' => 'ChatController@enviarMensaje']);


//Contador de mensajes no leidos
Route::get('cMensajes',['as' => 'chats', 'uses' => 'HomeController@countM']);

Route::get('welcome',['as' => 'welcome', 'uses' => 'HomeController@welcome']);

Route::get('contacto',['as' => 'contacto', 'uses' => 'ContactoController@index']);
Route::post('contacto',['as' => 'contacto', 'uses' => 'ContactoController@enviar']);

Route::get('administrar',['as' => 'administrar', 'uses' => 'EditarPerfil@administrar']);
Route::post('administrar',['as' => 'administrar', 'uses' => 'ContactoController@postAdministrar']);

Route::get('filtro',['as' => 'filtro', 'uses' => 'Vistas@getFiltro']);
Route::post('filtro',['as' => 'filtro', 'uses' => 'HomeController@filtro']);

Route::get('filtrousuarios',['as' => 'filtrousuarios', 'uses' => 'Vistas@getFiltro']);
Route::post('filtrousuarios',['as' => 'filtrousuarios', 'uses' => 'Vistas@filtroUsuarios']);

Route::resource('Imagenes', 'ImagenesController');
Route::resource('mascota1', 'MascotaController');
Route::resource('raza', 'RazaController');
Route::resource('animal', 'AnimalController');
Route::resource('publicacion1', 'PublicacionesController');
Route::resource('reporte1', 'ReporteController');