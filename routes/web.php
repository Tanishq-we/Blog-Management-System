<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================
// HEALTH CHECK (for uptime monitors like UptimeRobot)
// ==========================================
Route::get('/ping', fn() => response()->json(['status' => 'ok']))->name('ping');

// ==========================================
// FRONTEND ROUTES
// ==========================================
Route::get('/', [BlogController::class, 'index'])->name('home');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// ==========================================
// AJAX ROUTES
// ==========================================
Route::prefix('ajax')->group(function () {
    Route::get('/blogs', [AjaxController::class, 'filterBlogs'])->name('ajax.blogs');
    Route::get('/search', [AjaxController::class, 'searchBlogs'])->name('ajax.search');
    Route::get('/categories', [AjaxController::class, 'getCategories'])->name('ajax.categories');
});

// ==========================================
// ADMIN AUTH ROUTES
// ==========================================
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

// ==========================================
// ADMIN PANEL ROUTES (Protected)
// ==========================================
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Blog CRUD
    Route::get('/blogs', [AdminController::class, 'index'])->name('admin.blogs.index');
    Route::get('/blogs/create', [AdminController::class, 'create'])->name('admin.blogs.create');
    Route::post('/blogs', [AdminController::class, 'store'])->name('admin.blogs.store');
    Route::get('/blogs/{blog}/edit', [AdminController::class, 'edit'])->name('admin.blogs.edit');
    Route::put('/blogs/{blog}', [AdminController::class, 'update'])->name('admin.blogs.update');
    Route::delete('/blogs/{blog}', [AdminController::class, 'destroy'])->name('admin.blogs.destroy');
});
