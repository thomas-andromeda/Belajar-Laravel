<?php

use App\Models\ClassRoom;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ExtracurricularController;



Route::get('/home', function () {
    return view('home');
})->middleware('auth');

Route::get('/login', ([AuthController::class, 'login']))->name('login')->middleware('guest');
Route::post('/login', ([AuthController::class, 'authenticating']))->middleware('guest');

Route::get('/logout', ([AuthController::class, 'logout']))->middleware('auth');

Route::get('/student', ([StudentController::class, 'index']))->middleware('auth');
Route::get('/student-detail/{id}', ([StudentController::class, 'show']))->middleware('auth');
Route::get('/student-add', ([StudentController::class, 'create']))->middleware(['auth', 'must-admin-or-teacher']);
Route::post('/student', ([StudentController::class, 'store']))->middleware(['auth', 'must-admin-or-teacher']);
Route::get('/student-edit/{id}', ([StudentController::class, 'edit']))->middleware(['auth', 'must-admin-or-teacher']);
Route::put('/student/{id}', ([StudentController::class, 'update']))->middleware(['auth', 'must-admin-or-teacher']);
Route::get('/student-delete/{id}', ([StudentController::class, 'delete']))->middleware(['auth', 'must-admin']);
Route::delete('/student-destroy/{id}', ([StudentController::class, 'destroy']))->middleware(['auth', 'must-admin']);
Route::get('/student-deleted-list', ([StudentController::class, 'deletedStudent']))->middleware(['auth', 'must-admin']);
Route::get('/student/{id}/restore', ([StudentController::class, 'restore']))->middleware(['auth', 'must-admin']);

Route::get('/classroom', ([ClassController::class, 'index']))->middleware('auth');
Route::get('/classroom-detail/{id}', ([ClassController::class, 'show']))->middleware('auth');
Route::get('/classroom-add', ([ClassController::class, 'create']))->middleware(['auth', 'must-admin']);
Route::post('/classroom', ([ClassController::class, 'store']))->middleware(['auth', 'must-admin']);
Route::get('/classroom-edit/{id}', ([ClassController::class, 'edit']))->middleware(['auth', 'must-admin']);
Route::put('/classroom/{id}', ([ClassController::class, 'update']))->middleware(['auth', 'must-admin']);
Route::get('/classroom-delete/{id}', ([ClassController::class, 'delete']))->middleware(['auth', 'must-admin']);
Route::delete('/classroom-destroy/{id}', ([ClassController::class, 'destroy']))->middleware(['auth', 'must-admin']);
Route::get('/classroom-deleted-list', ([ClassController::class, 'deletedClass']))->middleware(['auth', 'must-admin']);
Route::get('/classroom/{id}/restore', ([ClassController::class, 'restore']))->middleware(['auth', 'must-admin']);

Route::get('/extracurricular', ([ExtracurricularController::class, 'index']))->middleware('auth');
Route::get('/extracurricular-detail/{id}', ([ExtracurricularController::class, 'show']))->middleware('auth');
Route::get('/extracurricular-add', ([ExtracurricularController::class, 'create']))->middleware('auth');
Route::post('/extracurricular', ([ExtracurricularController::class, 'store']))->middleware('auth');
Route::get('/extracurricular-edit/{id}', ([ExtracurricularController::class, 'edit']))->middleware('auth');
Route::put('/extracurricular/{id}', ([ExtracurricularController::class, 'update']))->middleware('auth');
Route::get('/extracurricular-delete/{id}', ([ExtracurricularController::class, 'delete']))->middleware(['auth', 'must-admin']);
Route::delete('/extracurricular-destroy/{id}', ([ExtracurricularController::class, 'destroy']))->middleware(['auth', 'must-admin']);
Route::get('/extracurricular-deleted-list', ([ExtracurricularController::class, 'deletedExtracurricular']))->middleware(['auth', 'must-admin']);
Route::get('/extracurricular/{id}/restore', ([ExtracurricularController::class, 'restore']))->middleware(['auth', 'must-admin']);


Route::get('/teacher', ([TeacherController::class, 'index']))->middleware('auth');
Route::get('/teacher-detail/{id}', ([TeacherController::class, 'show']))->middleware(['auth', 'must-admin-or-teacher']);
Route::get('/teacher-add', ([TeacherController::class, 'create']))->middleware(['auth', 'must-admin']);
Route::post('/teacher', ([TeacherController::class, 'store']))->middleware(['auth', 'must-admin']);
Route::get('/teacher-edit/{id}', ([TeacherController::class, 'edit']))->middleware(['auth', 'must-admin']);
Route::put('/teacher/{id}', ([TeacherController::class, 'update']))->middleware(['auth', 'must-admin']);
Route::get('/teacher-delete/{id}', ([TeacherController::class, 'delete']))->middleware(['auth', 'must-admin']);
Route::delete('/teacher-destroy/{id}', ([TeacherController::class, 'destroy']))->middleware(['auth', 'must-admin']);
Route::get('/teacher-deleted-list', ([TeacherController::class, 'deletedTeacher']))->middleware(['auth']);
Route::get('/teacher/{id}/restore', ([TeacherController::class, 'restore']))->middleware(['auth', 'must-admin']);



