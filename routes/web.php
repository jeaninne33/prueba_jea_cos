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

Route::post('datos_users', 'UserController@getData')->name('users.datos');
Route::post('lista_Departamentos','UserController@Departamentos')->name('users.departamentos');
Route::post('lista_Municipios','UserController@Municipios')->name('users.municipios');;
Route::resource('users', 'UserController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');