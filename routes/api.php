<?php

use App\Http\Controllers\ResortsController;
use App\Http\Controllers\TiposController;
use App\Http\Controllers\DepartamentosController;
use App\Http\Controllers\AreasController;
use App\Http\Controllers\ColaboradoresController;
use App\Http\Controllers\EquiposController;
use App\Http\Controllers\ResguardosController;
use App\Http\Controllers\DictamenesController;
use App\Http\Controllers\NivelesController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\UsuariosNivelesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rutas de recursos para tus controladores
Route::resource('resorts', ResortsController::class);
Route::resource('tipos', TiposController::class);
Route::resource('departamentos', DepartamentosController::class);
Route::resource('areas', AreasController::class);
Route::resource('colaboradores', ColaboradoresController::class);
Route::resource('equipos', EquiposController::class);
Route::resource('resguardos', ResguardosController::class);
Route::resource('dictamenes', DictamenesController::class);
Route::resource('niveles', NivelesController::class);
Route::resource('usuarios', UsuariosController::class);

// Rutas de autenticación con JWT
Route::post('/login', [UsuariosController::class, 'login'])->middleware('throttle:api,5,1,no');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

