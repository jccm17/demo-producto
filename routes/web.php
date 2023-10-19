<?php

use App\Http\Controllers\ProductoController;
use App\Http\Middleware\EnsureTokenIsValid;
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

Route::get('/', function () {
    return view('welcome');
});

Route::withoutMiddleware([EnsureTokenIsValid::class])->group(function () {
    Route::get('product',[ProductoController::class, 'index'])->name('products');
    Route::post('product',[ProductoController::class,'store']);
    Route::get('product/{id}',[ProductoController::class,'edit']);
    Route::put('product',[ProductoController::class,'update']);
    Route::delete('product/{id}',[ProductoController::class,'destroy']);

});
