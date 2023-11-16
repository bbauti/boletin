<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\MyStudentsController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('/no-course', function () {
    return Inertia::render('WaitCourse');
})->name('no-course');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'check.course'
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('App/Dashboard');
    })->name('dashboard');
    Route::get('/settings', function () {
        return Inertia::render('App/Settings');
    })->name('settings');
    
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'check.teacher'
])->group(function () {
    Route::get('/my-students', [MyStudentsController::class, 'show'])->name('my-students');
});
