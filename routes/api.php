<?php

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MyCoursesController;
use App\Http\Controllers\MyClassroomsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::put('/users/{id}/update-course', [UserController::class, 'updateCourse']);
Route::put('/users/{id}/update-role', [UserController::class, 'updateRole']);

Route::delete('/courses/{id}/delete-course', [MyCoursesController::class, 'deleteCourse']);
Route::post('/courses/create-course', [MyCoursesController::class, 'createCourse']);
Route::put('/courses/update-course/{id}', [MyCoursesController::class, 'updateCourse']);

Route::delete('/classrooms/{id}/delete-classroom', [MyClassroomsController::class, 'deleteClassroom']);
Route::post('/classrooms/create-classroom', [MyClassroomsController::class, 'createClassroom']);
Route::put('/classrooms/update-classroom/{id}', [MyClassroomsController::class, 'updateClassroom']);

