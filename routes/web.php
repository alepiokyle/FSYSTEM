<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\DeanAccountController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\GradeController;
use App\Models\User;

// Home route - redirect based on authentication status
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// Authentication routes - use only custom controller
Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminLoginController::class, 'login']);
Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

// Register routes
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Protected routes for authenticated users
Route::middleware(['auth'])->group(function () {
    // Main dashboard
    Route::get('/dashboard', function () {
        $user = Auth::user();

        switch ($user->role) {
            case 'admin':
                $studentCount = User::where('role', 'student')->count();
                $teacherCount = User::where('role', 'teacher')->count();
                $adminCount = User::where('role', 'admin')->count();
                return view('Admin.Dashboard', compact('studentCount', 'teacherCount', 'adminCount'));
            case 'dean':
                return view('Dean.deandashboard');
            case 'teacher':
                return view('Teacher.teacherdashboard');
            case 'student':
                return view('Student.studentdashboard');
            case 'parent':
                return view('Parent.parentsdashboard');
            default:
                return view('Admin.Dashboard');
        }
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Grade Management Routes
    Route::get('/viewgrade', [GradeController::class, 'viewGrades'])->name('grades.view');
    Route::get('/grades/create', [GradeController::class, 'create'])->name('grades.create');
    Route::post('/grades', [GradeController::class, 'store'])->name('grades.store');
    Route::patch('/grades/{grade}/status', [GradeController::class, 'updateStatus'])->name('grades.updateStatus');
    
    // Static Admin Views
    Route::get('/dean', fn() => view('Admin.dean'))->name('dean');
    Route::get('/teacher-account', fn() => view('Admin.Teacher'))->name('teacher.account');
    Route::get('/student-account', fn() => view('Admin.student'))->name('student.account');
    Route::get('/parent-account', fn() => view('Admin.parent'))->name('parent.account');
});

// Admin protected routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', fn() => view('Admin.Dashboard'))->name('admin.dashboard');
    Route::get('/deans/create', [DeanAccountController::class, 'create'])->name('admin.deans.create');
    Route::post('/deans/store', [DeanAccountController::class, 'store'])->name('admin.deans.store');
});

// Separate route file for Upload Subjects
require __DIR__ . '/upload.php';
