<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Corredores;
use App\Http\Controllers\Api\CorredoresProvas;
use App\Http\Controllers\Api\Provas;
use App\Http\Controllers\Api\ResultadoProvas;
use App\Http\Controllers\Api\TipoProva;


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

Route::get('home', 'HomeController@index')->name('home');
Route::get('logout', function () {
    return view('welcome');
});

Route::get('tiposprova', 'Api\TipoProvaController@getAllTipoProva')->name('tiposprova');
Route::get('corridas', 'Api\ProvasController@getAllProvas')->name('corridas');
Route::get('corredores', 'Api\CorredoresController@getAllCorredores')->name('corredores');
Route::get('competicoes', 'Api\CorredoresProvasController@getAllCorredoresProvas')->name('competicoes');
Route::get('resultados', 'Api\ResultadoProvasController@getAllResultadoProvas')->name('resultados');
Route::get('clgeral', 'Api\CorredoresProvasController@listaResultadoGeral')->name('clgeral');
Route::get('clpidade', 'Api\CorredoresProvasController@listaResultadoIdade')->name('clpidade');

// Route::get('login', function () {
//     return view('auth.login');
// });
//
// Route::get('register', function () {
//     return view('auth.register');
// });
