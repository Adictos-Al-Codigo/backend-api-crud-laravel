<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\UserController;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login',[UserController::class,'login']);



Route::middleware('auth:sanctum')->group(function () {
    Route::resource('marcas', MarcaController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('proveedor', ProveedorController::class);
    Route::resource('producto', ProductoController::class);
    Route::resource('user',UserController::class);
});


