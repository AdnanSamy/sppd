<?php

use App\Http\Controllers\DinasTravelController;
use App\Http\Controllers\ItemDinasTravelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

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

Route::get('/login', [LoginController::class, 'index']);
Route::post('login-proccess', [LoginController::class, 'login_proccess']);
Route::middleware(['auth_check'])->group(function(){
    Route::get('/', [MainController::class, 'index']);

    Route::get('/api/role', [RoleController::class, 'readAll']);

    Route::get('/user', [UserController::class, 'index']);
    Route::get('/dinas-travel', [DinasTravelController::class, 'index']);
    Route::get('/item-dinas-travel', [ItemDinasTravelController::class, 'index']);

    Route::get('/api/user', [UserController::class, 'readAll']);
    Route::get('/api/user/{id}', [UserController::class, 'readOne']);
    Route::post('/api/user', [UserController::class, 'create']);
    Route::put('/api/user', [UserController::class, 'update']);
    Route::delete('/api/user/{id}', [UserController::class, 'delete']);

    Route::get('/api/dinas-travel', [DinasTravelController::class, 'readAll']);
    Route::get('/api/dinas-travel/{id}', [DinasTravelController::class, 'readOne']);
    Route::post('/api/dinas-travel', [DinasTravelController::class, 'create']);
    Route::put('/api/dinas-travel', [DinasTravelController::class, 'update']);
    Route::delete('/api/dinas-travel/{id}', [DinasTravelController::class, 'delete']);

    Route::get('/api/item-dinas-travel', [ItemDinasTravelController::class, 'readAll']);
    Route::get('/api/item-dinas-travel/{id}', [ItemDinasTravelController::class, 'readOne']);
    Route::post('/api/item-dinas-travel', [ItemDinasTravelController::class, 'create']);
    Route::put('/api/item-dinas-travel', [ItemDinasTravelController::class, 'update']);
    Route::delete('/api/item-dinas-travel/{id}', [ItemDinasTravelController::class, 'delete']);
});
