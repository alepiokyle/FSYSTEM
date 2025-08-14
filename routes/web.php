<?php

use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\DeanAccountController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\GradeController;
use App\Models\User;


Route::get('/', function () {
    return view('userAuth.login');
});

Route::get('/register', [App\Http\Controllers\Auth\RegistrationController::class, 'index'])->name('register');


// Authentication Routes
Route::get('/login', [App\Http\Controllers\Auth\loginController::class, 'create'])->name('login');
Route::post('/signin', [App\Http\Controllers\Auth\loginController::class, 'store'])->name('signin');
Route::post('/logout', [App\Http\Controllers\Auth\logoutController::class, 'userDestroy'])->name('logout');

// Admin
Route::prefix('admin')->middleware('auth:web')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/faculty', [App\Http\Controllers\Admin\addFacultyController::class, 'index'])->name('admin.faculty');

    Route::get('/uploadsubject', [App\Http\Controllers\Admin\UploadSubjectController::class, 'index'])->name('admin.uploadsubject');
});

// Dean
Route::prefix('dean')->middleware('auth:web')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\dean\dashboardcontroller::class, 'index'])->name('dean.dashboard');
});

// Teacher
Route::prefix('teacher')->middleware('auth:web')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\teacher\TeacherDashboardController::class, 'index'])->name('teacher.dashboard');
});

// Student
Route::prefix('student')->middleware('auth:web')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\student\studentDashboardController::class, 'index'])->name('student.dashboard');
});


//parent
Route::prefix('parent')->middleware('auth:web')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\parent\parentDashboardController::class, 'index'])->name('parent.dashboard');
});



require __DIR__ . '/upload.php';
