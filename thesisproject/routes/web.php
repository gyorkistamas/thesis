<?php

use App\Http\Controllers\ConfigController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileUpdateController;
use App\Http\Controllers\StudentController;
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

Route::get('/manifest', [Controller::class, 'manifest'])->name('manifest');

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
    Route::get('/administration', [ConfigController::class, 'getCreationSite'])->name('administration');
    Route::get('/config', [ConfigController::class, 'getConfig'])->name('config');
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
    Route::get('teacher-class/{courseClass}', [TeacherController::class, 'teacherClass'])->name('teacher-view-class');
    Route::get('teacher-justifications', [TeacherController::class, 'getJustifications'])->name('teacher-justifications');
});

/*
|--------------------------------------------------------------------------
| Student routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'student'])->group(function () {
    Route::get('student-class-login/{uuid}', [StudentController::class, 'loginToClass'])->name('student-class-login');
    Route::get('student-class-login-link', [StudentController::class, 'getLoginLink'])->name('student-class-login-link');
    Route::get('student-subjects', [StudentController::class, 'studentSubjects'])->name('student-subjects');
    Route::get('/student-justifications', [StudentController::class, 'getJustifications'])->name('student-justifications');
});

/*
|--------------------------------------------------------------------------
| Routes for both student and teacher
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'studentorteacher'])->group(function () {
    Route::get('timetable', [Controller::class, 'getTimetable'])->name('timetable');
});

/*
|--------------------------------------------------------------------------
| Timetable export
|--------------------------------------------------------------------------
*/
Route::get('export-timetable/{uuid}', [Controller::class, 'exportTimetable'])->name('export-timetable');
