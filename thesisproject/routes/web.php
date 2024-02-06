<?php

use App\Http\Controllers\ConfigController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileUpdateController;
use App\Http\Controllers\TeacherController;
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
    Route::get('/user-settings', [Controller::class, 'UserSettings'])->name('user-settings');
    Route::get('/administration', [ConfigController::class, 'getCreationSite'])->name('administration'); // TODO REMOVE
});

/*
|--------------------------------------------------------------------------
| Administration settings
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/administration', [ConfigController::class, 'getCreationSite'])->name('administration');
});

/*
|--------------------------------------------------------------------------
| Teacher routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'teacher'])->group(function () {
    Route::get('teacher-subjects', [TeacherController::class, 'teacherSubjects'])->name('teacher-subjects');
});

/*
|--------------------------------------------------------------------------
| Student routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'student'])->group(function () {

});
