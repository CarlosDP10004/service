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

Route::post('login', 'UsuarioController@login')->name('login');
Route::post('register', 'AuthController@register');

Route::get('roles', 'RolController@index')->middleware('auth:sanctum');
Route::get('roles/{id}', 'RolController@show')->middleware('auth:sanctum');
Route::post('roles', 'RolController@store')->middleware('auth:sanctum');
Route::put('roles/{id}', 'RolController@update')->middleware('auth:sanctum');
Route::get('permisos', 'RolController@permissions')->middleware('auth:sanctum');

Route::post('usuarios', 'UsuarioController@store')->middleware('auth:sanctum');
Route::get('usuarios', 'UsuarioController@index')->middleware('auth:sanctum');
Route::get('usuarios/{id}', 'UsuarioController@show')->middleware('auth:sanctum');
Route::put('usuarios/{id}', 'UsuarioController@update')->middleware('auth:sanctum');
Route::post('logout', 'UsuarioController@logout')->middleware('auth:sanctum');

Route::get('unidades', 'UnidadController@index')->middleware('auth:sanctum');
Route::post('unidades', 'UnidadController@store')->middleware('auth:sanctum');
Route::get('unidades/{id}', 'UnidadController@show')->middleware('auth:sanctum');
Route::put('unidades/{id}', 'UnidadController@update')->middleware('auth:sanctum');