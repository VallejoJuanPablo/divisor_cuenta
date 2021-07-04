<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () { return view('home');});
Route::get('/home', function () {return view('home');})->name('home');



Route::get('/crearreunion', 'ReunionController@formulariocrearreunion')->name('crear.reunion');
Route::post('/procesar_crearreunion', 'ReunionController@crearreunion')->name('procesar_crearreunion');

Route::get('/agregargastoreunion', 'ReunionGastoController@formularioagregargastoreunion')->name('agregargasto.reunion');
Route::post('/procesar_agregargastoreunion', 'ReunionGastoController@agregargastoreunion')->name('procesar_agregargastoreunion');

Route::get('/generarpagos', 'PagoController@formulariogenerarpagosreunion')->name('generarpagos.reunion');
Route::post('/procesar_generarpagos', 'PagoController@generarpagosreunion')->name('procesar_generarpagosreunion');