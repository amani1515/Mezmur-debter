<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/categories', [App\Http\Controllers\AdminController::class, 'categories'])->name('admin.categories');
    Route::post('/admin/categories', [App\Http\Controllers\AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::put('/admin/categories/{category}', [App\Http\Controllers\AdminController::class, 'updateCategory'])->name('admin.categories.update');
    Route::get('/admin/subcategories', [App\Http\Controllers\AdminController::class, 'subcategories'])->name('admin.subcategories');
    Route::post('/admin/subcategories', [App\Http\Controllers\AdminController::class, 'storeSubcategory'])->name('admin.subcategories.store');
    Route::put('/admin/subcategories/{subcategory}', [App\Http\Controllers\AdminController::class, 'updateSubcategory'])->name('admin.subcategories.update');
});
