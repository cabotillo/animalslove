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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('editarperfil/cuenta', ['as' => 'editarperfil.cuenta', 'uses' => 'EditarPerfil@cuenta']);
Route::post('editarperfil/cuenta', ['as' => 'editarperfil.cuenta', 'uses' => 'EditarPerfil@updateCuenta']);

Route::get('editarperfil/premium', ['as' => 'editarperfil.premium', 'uses' => 'EditarPerfil@premium']);
Route::post('editarperfil/premium', ['as' => 'editarperfil.premium', 'uses' => 'EditarPerfil@updatePremium']);
