<?php

use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\DeanAccountController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\dean\DeanController;
use App\Models\User;


Route::get('/', function () {
    return view('userAuth.login');
});

Route::get('/register', [App\Http\Controllers\Auth\RegistrationController::class, 'index'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegistrationController::class, 'store'])->name('register.store');
Route::get('/registration/review', [App\Http\Controllers\Auth\RegistrationController::class, 'view'])->name('review');



// Authentication Routes
Route::get('/login', [App\Http\Controllers\Auth\loginController::class, 'create'])->name('login');
Route::post('/signin', [App\Http\Controllers\Auth\loginController::class, 'store'])->name('signin');
Route::post('/logout', [App\Http\Controllers\Auth\logoutController::class, 'userDestroy'])->name('logout');

// Admin
Route::prefix('admin')->middleware('auth:web')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::controller(App\Http\Controllers\Admin\addFacultyController::class)->group(function () {
        Route::get('/upload-subject', 'index')->name('admin.upload-subject');
    });


    Route::controller(App\Http\Controllers\DeanController::class)->group(function () {
        Route::get('/view-dean', 'index')->name('view.dean');
    });


    Route::controller(App\Http\Controllers\Admin\ViewTeacherController::class)->group(function () {
        Route::get('/view-teacher', 'index')->name('view.teacher');
    });

    Route::controller(App\Http\Controllers\Admin\viewstudentController::class)->group(function () {
        Route::get('/view-student', 'index')->name('view.student');
    });

    Route::controller(App\Http\Controllers\Admin\ParentAccountController::class)->group(function () {
        Route::get('/view-parent', 'index')->name('view.parent');
    });

    Route::controller(App\Http\Controllers\Admin\ViewAddStaffController::class)->group(function () {
        Route::get('/view-addstaff', 'index')->name('view.addstaff');
    });

    Route::get('/uploadsubject', [App\Http\Controllers\Admin\UploadSubjectController::class, 'index'])->name('admin.uploadsubject');
});



// dean
Route::prefix('dean')->middleware('auth:web')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\dean\DashboardController::class, 'index'])->name('Dean.deandashboard');



    Route::controller(App\Http\Controllers\dean\AssignController::class)->group(function () {
        Route::get('/AssignTeacher', 'index')->name('dean.AssignTeacher');
    });


    Route::controller(App\Http\Controllers\dean\SubjectLoadingController::class)->group(function () {
        Route::get('/SubjectLoading', 'index')->name('Dean.SubjectLoading');
    });

    Route::controller(App\Http\Controllers\dean\ApproveGradesController::class)->group(function () {
        Route::get('/ApproveGrades', 'index')->name('Dean.ApproveGrades');
    });

    Route::controller(App\Http\Controllers\dean\PostGradesController::class)->group(function () {
        Route::get('/PostGrades', 'index')->name('Dean.PostGrades');
    });

    //Route::post('/admin/deans', [DeanController::class, 'store'])->name('deans.store');
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
Route::prefix('parent')->middleware('auth:parent')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\parent\parentDashboardController::class, 'index'])->name('parent.dashboard');
});
