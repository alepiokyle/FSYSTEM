<?php
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\Admin\DeanAccountController;

// Redirect to login
Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');

// Main dashboard
Route::get('/dashboard', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $studentCount = 346;
    $teacherCount = 12;
    $adminCount = 2;

    return view('Admin.Dashboard', compact('studentCount', 'teacherCount', 'adminCount'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin routes
Route::get('/admin', [AdminController::class, 'index']);

// Upload Subjects - Fixed authentication flow
Route::middleware(['auth'])->group(function () {
    Route::get('/upload-subjects', [UploadController::class, 'index'])->name('upload.subjects');
    Route::post('/upload-subjects', [UploadController::class, 'store'])->name('subjects.store');
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Static Admin Views
Route::middleware(['auth'])->group(function () {
    Route::get('/viewgrade', fn() => view('Admin.viewgrade'))->name('viewgrade');
    Route::get('/dean', fn() => view('Admin.dean'))->name('dean');
    Route::get('/teacher-account', fn() => view('Admin.Teacher'))->name('teacher.account');
    Route::get('/student-account', fn() => view('Admin.student'))->name('student.account');
    Route::get('/parent-account', fn() => view('Admin.parent'))->name('parent.account');
});

// Auth routes
Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminLoginController::class, 'login']);

// Admin protected routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', fn() => view('Admin.Dashboard'))->name('admin.dashboard');
    Route::get('/deans/create', [DeanAccountController::class, 'create'])->name('admin.deans.create');
    Route::post('/deans/store', [DeanAccountController::class, 'store'])->name('admin.deans.store');
});

require __DIR__ . '/auth.php';
