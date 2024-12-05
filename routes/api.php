<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Models\Category;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

// Route::get('users' , [UserController::class , 'index'] )->name('users.index');
// Route::post('users' , [UserController::class , 'store'] );
// Route::put('users/{$user}' , [UserController::class , 'update'] );
// Route::get('users/{$user}' , [UserController::class , 'show'] );
// Route::delete('users/{$user}' , [UserController::class , 'delete'] );


Route::resource('users', UserController::class);
Route::resource('brand', BrandController::class);
Route::resource('events', EventController::class);
Route::resource('cars', EventController::class);
Route::resource('category', CategoryController::class);
Route::resource('order', OrderController::class);