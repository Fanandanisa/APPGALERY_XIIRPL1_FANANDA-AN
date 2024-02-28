<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GaleryController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[UserController::class,'login'])->name('login');
Route::get('/register',[UserController::class,'register']);
Route::post('/simpanreg',[UserController::class,'saveRegister']);
Route::post('/postlogin',[UserController::class,'proseslogin']);
Route::get('/logout',[UserController::class,'logout']);

Route::resource('/galery', GaleryController::class)->middleware('auth');
Route::post('hapusfoto/{$id}',[GaleryController::class,'delete']);
