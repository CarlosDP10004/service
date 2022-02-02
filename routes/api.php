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

Route::group([
    'middleware' => 'api',

], function ($router) {
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    Route::get('roles', 'RolController@index');
    Route::get('roles/{id}', 'RolController@show');
    Route::post('roles', 'RolController@store');
    Route::put('roles/{id}', 'RolController@update');
    Route::get('permisos', 'RolController@permissions');

    Route::post('usuarios', 'UsuarioController@store');
    Route::get('usuarios', 'UsuarioController@index');
    Route::get('usuarios/{id}', 'UsuarioController@show');
    Route::put('usuarios/{id}', 'UsuarioController@update');
    Route::post('logout', 'UsuarioController@logout');

    Route::get('unidades', 'UnidadController@index');
    Route::post('unidades', 'UnidadController@store');
    Route::get('unidades/{id}', 'UnidadController@show');
    Route::put('unidades/{id}', 'UnidadController@update');

    Route::get('plazas', 'PlazaController@index');
    Route::post('plazas', 'PlazaController@store');
    Route::get('plazas/{id}', 'PlazaController@show');
    Route::put('plazas/{id}', 'PlazaController@update');

    Route::get('origenes', 'OrigenController@index');

    Route::get('cuentas', 'CuentaController@index');
    Route::post('cuentas', 'CuentaController@store');
    Route::get('cuentas/{id}', 'CuentaController@show');
    Route::put('cuentas/{id}', 'CuentaController@update');

    Route::get('proveedores', 'ProveedorController@index');
    Route::post('proveedores', 'ProveedorController@store');
    Route::get('proveedores/{id}', 'ProveedorController@show');
    Route::put('proveedores/{id}', 'ProveedorController@update');

    Route::get('clasificaciones', 'ClasificacionController@index');
    Route::post('clasificaciones', 'ClasificacionController@store');
    Route::get('clasificaciones/{id}', 'ClasificacionController@show');
    Route::put('clasificaciones/{id}', 'ClasificacionController@update');
});
