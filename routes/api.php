<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/imagenes', 'ImagenController@index');
Route::post('/imagen', 'ImagenController@store');
Route::delete('/imagen/{id}', 'ImagenController@destroy');
Route::get('/imagen/{id}', 'ImagenController@show');
Route::get('/file/{id}', 'ImagenController@getImagen');

#Route::get('/evento/descarga/{archivo}', 'ImagenController@descarga');

//comentarios
Route::get('/comentarios/{id_imagen}', 'ComentarioController@index');
Route::post('/comentario/new', 'ComentarioController@store');
Route::delete('/imagen/{id}', 'ComentarioController@destroy');
