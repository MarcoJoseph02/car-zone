<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
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
    return view('index');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name("admin.dashboard");

Route::get('/event', function () {
    return view('event');
})->name("event");

Route::get('/location', function () {
    return view('location');
})->name("location");

Route::get('/store', function () {
    return view('store');
})->name("store");


Route::group(
    ["as" => "admin."],
    function () {
        Route::resource("/users", UserController::class);
        Route::resource("/category", CategoryController::class);
        Route::resource("/brand", BrandController::class);
        Route::resource("/branch", BranchController::class);
        Route::resource("/supplier", SupplierController::class);
        Route::resource("/car", CarController::class);
        Route::get('/cars/{car}/book', [CarController::class, 'getBookPage'])->name('car.getBookPage');
        Route::post('/car/{car}/book', [CarController::class, 'processBook'])->name('car.processBook');
        Route::get('/cars/{car}/sell', [CarController::class, 'getSellPage'])->name('car.getSellPage');
        Route::post('/car/{car}/sell', [CarController::class, 'processSell'])->name('car.processSell');

        Route::put('/brand/{brand}', [BrandController::class, 'update'])->name('admin.brand.update');
        Route::get('/cars/{car}/cancel-booking', [CarController::class, 'cancelBooking'])
            ->name('car.cancel-booking');
    }
);
