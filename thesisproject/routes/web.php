<?php

use App\Http\Controllers\ProfileUpdateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Profile update
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileUpdateController::class, 'index'])->name('update-profile');
});

/*
|--------------------------------------------------------------------------
| Website settings
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'superadmin'])->group(function () {
    Route::get('/user-settings', [\App\Http\Controllers\Controller::class, 'UserSettings'])->name('user-settings');
    Route::get('/administration', [\App\Http\Controllers\ConfigController::class, 'getCreationSite'])->name('administration');
});

/*
|--------------------------------------------------------------------------
| Administration settings
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/administration', [\App\Http\Controllers\ConfigController::class, 'getCreationSite'])->name('administration');
});
