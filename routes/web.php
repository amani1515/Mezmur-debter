<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [App\Http\Controllers\PublicController::class, 'welcome'])->name('welcome');
Route::post('/submit-poem', [App\Http\Controllers\PublicController::class, 'submitPoem'])->name('submit.poem');
Route::get('/check-title', [App\Http\Controllers\PublicController::class, 'checkTitle'])->name('check.title');
Route::post('/api/submit-structured-poem', [App\Http\Controllers\PublicController::class, 'submitStructuredPoem'])->name('api.submit.structured.poem')->withoutMiddleware(['web']);
Route::get('/api/categories', [App\Http\Controllers\PublicController::class, 'getCategories'])->name('api.categories');
Route::get('/login-page', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('login.page');

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
    Route::get('/admin/poems', [App\Http\Controllers\PoemController::class, 'index'])->name('admin.poems');
    Route::get('/admin/poems/{poem}', [App\Http\Controllers\PoemController::class, 'show'])->name('admin.poems.show');
    Route::put('/admin/poems/{poem}', [App\Http\Controllers\PoemController::class, 'update'])->name('admin.poems.update');
});
