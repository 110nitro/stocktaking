<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductoController;

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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Auth::routes();

Route::view('/usuarios', 'usuarios')->name('usuario');
Route::get('/usuarios', [UserController::class, "MostrarUsuarios"])->name('usuarios');
Route::post('/usuarios-crear', [UserController::class, 'Crear'])->name('usuarios-crear');
Route::post('/usuarios-activar', [UserController::class, 'Activar'])->name('usuarios-activar');
Route::post('/usuarios-desactivar', [UserController::class, 'Desactivar'])->name('usuarios-desactivar');
Route::post('/usuarios-editar', [UserController::class, 'Editar'])->name('usuarios-editar');

Route::view('/perfil', 'perfil');
Route::get('/perfil', [UserController::class, "Mostrar"])->name('perfil');
Route::post('/perfil-actualizar', [UserController::class, "Actualizar"])->name('perfil-actualizar');
Route::post('/perfil-actualizar-contraseña', [UserController::class, "ActualizarContraseña"])->name('perfil-actualizar-contraseña');

Route::view('/productos', 'productos')->name('producto');
Route::get('/productos', [ProductoController::class, "MostrarProductos"])->name('productos');
Route::post('/productos-crear', [ProductoController::class, 'Crear'])->name('productos-crear');
Route::post('/productos-activar', [ProductoController::class, 'Activar'])->name('productos-activar');
Route::post('/productos-desactivar', [ProductoController::class, 'Desactivar'])->name('productos-desactivar');
Route::post('/productos-editar', [ProductoController::class, 'Editar'])->name('productos-editar');