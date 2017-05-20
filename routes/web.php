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

Route::get('editarperfil/mascotas', ['as' => 'editarperfil.mascotas', 'uses' => 'EditarPerfil@mascotas']);

Route::get('editarperfil/editar/mascotas/{id}', ['as' => 'editarperfil.editarmascota', 'uses' => 'EditarPerfil@editarMascota']);
Route::post('editarperfil/editar/mascotas/{id}', ['as' => 'editarperfil.editarmascota', 'uses' => 'EditarPerfil@updateMascota']);

Route::get('editarperfil/mascotas/add', ['as' => 'editarperfil.addmascota', 'uses' => 'EditarPerfil@addMascota']);
Route::post('editarperfil/mascotas/add', ['as' => 'editarperfil.addmascota', 'uses' => 'EditarPerfil@insertarMascota']);

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

Route::get('imagenes/{id}', ['as' => 'imagenes', 'uses' => 'EditarPerfil@addImagenes']);
Route::post('imagenesdelete/{id}', ['as' => 'imagenesdelete', 'uses' => 'EditarPerfil@postDeleteImagenes']);
Route::post('imagenesadd/{id}', ['as' => 'imagenesadd', 'uses' => 'EditarPerfil@postInsertImagenes']);


Route::get('mensajes/',['as' => 'mensajes', 'uses' => 'ChatController@index']);
Route::get('chat/{login}',['as' => 'chat', 'uses' => 'ChatController@comprobar']);

Route::get('mensajes/{login}', function ($login){
    return View::make('mensajes')->with('login',$login);
});

Route::post('mensajes/sendMessage', array('uses' => 'ChatController@sendMessage'));
Route::post('mensajes/isTyping', array('uses' => 'ChatController@isTyping'));
Route::post('mensajes/notTyping', array('uses' => 'ChatController@notTyping'));
Route::post('mensajes/retrieveChatMessages', array('uses' => 'ChatController@retrieveChatMessages'));
Route::post('mensajes/retrieveTypingStatus', array('uses' => 'ChatController@retrieveTypingStatus'));




Route::resource('Imagenes', 'ImagenesController');
Route::resource('mascota1', 'MascotaController');
Route::resource('raza', 'RazaController');
Route::resource('animal', 'AnimalController');
Route::resource('publicacion1', 'PublicacionesController');
Route::resource('reporte1', 'ReporteController');