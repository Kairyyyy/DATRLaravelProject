<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerificationController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

// Guest routes (not logged in)
Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('admin.register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [LoginController::class, 'create'])
        ->name('admin.login');

    Route::post('login', [LoginController::class, 'store']);
});

// Email verification routes (authenticated but not verified)
Route::prefix('admin')->middleware('auth:admin')->name('admin.')->group(function () {
    Route::get('/verify-email', [VerificationController::class, 'notice'])
        ->name('verification.notice');
    
    Route::post('/verify-code', [VerificationController::class, 'verify'])
        ->name('verification.verify');
    
    Route::post('/resend-verification', [VerificationController::class, 'resend'])
        ->name('verification.resend');
});

// Authenticated and verified routes
Route::prefix('admin')->middleware(['auth:admin', 'verified.admin'])->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Interns Management
    Route::get('/interns', [AdminController::class, 'interns'])->name('interns');
    Route::get('/interns/{user}', [AdminController::class, 'showIntern'])->name('interns.show');
    
    // DATR (Daily Attendance Time Record)
    Route::get('/datr', [AdminController::class, 'datr'])->name('datr');
    Route::get('/datr/export', [AdminController::class, 'exportDatr'])->name('datr.export');
    Route::get('/datr/user/{user}', [AdminController::class, 'userAttendance'])->name('datr.user');
    
    // Admins Management
    Route::get('/admins', [AdminController::class, 'admins'])->name('admins');
    Route::get('/admins/{admin}', [AdminController::class, 'showAdmin'])->name('admins.show');
    
    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Logout
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
});