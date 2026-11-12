<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SettingController;

// 1. Public Portfolio & Contact Form Routes
Route::get('/', [HomeController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// 2. Admin Panel Routes (Login ke baad access honge)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [ProjectController::class, 'index'])->name('dashboard');
    Route::resource('projects', ProjectController::class);
    Route::post('/resume-update', [SettingController::class, 'updateResume'])->name('resume.update');
});

// 3. Breeze Default Dashboard & Profile Routes
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 4. Authentication Routes
require __DIR__.'/auth.php';