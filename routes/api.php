<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function() {
});
/*
Rotas Tipos de Prova
*/
Route::get('tiposprova', 'Api\TipoProvaController@getAllTipoProva');
Route::get('tiposprova/{id}', 'Api\TipoProvaController@getTipoProva');
Route::post('tiposprova', 'Api\TipoProvaController@createTipoProva');
Route::put('tiposprova/{id}', 'Api\TipoProvaController@updateTipoProva');
Route::delete('tiposprova/{id}','Api\TipoProvaController@deleteTipoProva');
/*
Rotas Provas
*/
Route::get('corridas', 'Api\ProvasController@getAllProvas');
Route::get('corridas/{id}', 'Api\ProvasController@getProvas');
Route::post('corridas', 'Api\ProvasController@createProvas');
Route::put('corridas/{id}', 'Api\ProvasController@updateProvas');
Route::delete('corridas/{id}','Api\ProvasController@deleteProvas');
/*
Rotas Corredores
*/
Route::get('corredores', 'Api\CorredoresController@getAllCorredores');
Route::get('corredores/{id}', 'Api\CorredoresController@getCorredores');
Route::post('corredores', 'Api\CorredoresController@createCorredores');
Route::put('corredores/{id}', 'Api\CorredoresController@updateCorredores');
Route::delete('corredores/{id}','Api\CorredoresController@deleteCorredores');
/*
Rotas CorredoresProvas
*/
Route::get('competicoes', 'Api\CorredoresProvasController@getAllCorredoresProvas');
Route::get('competicoes/{id}', 'Api\CorredoresProvasController@getCorredoresProvas');
Route::post('competicoes', 'Api\CorredoresProvasController@createCorredoresProvas');
Route::put('competicoes/{id}', 'Api\CorredoresProvasController@updateCorredoresProvas');
Route::put('resultado/{id}', 'Api\CorredoresProvasController@incluirResultadoCorredoresProvas');
Route::delete('competicoes/{id}','Api\CorredoresProvasController@deleteCorredoresProvas');
