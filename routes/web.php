<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\LoginController;

// ==================== FRONTEND ROUTES ====================
Route::get('/', [ProfileController::class, 'index'])->name('home');
Route::get('/about', [ProfileController::class, 'about'])->name('about');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects'); // <- DIUBAH
Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact'); // <- DIUBAH
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Books Routes
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
Route::get('/books/category/{category}', [BookController::class, 'byCategory'])->name('books.byCategory');

// Orders Routes
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

// ==================== AUTHENTICATION ROUTES ====================
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login']);
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

// ==================== ADMIN ROUTES (PROTECTED) ====================
Route::prefix('admin')->middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Profile Management
    Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('admin.profile.update');
    
    // Projects Management
    Route::get('/projects', [App\Http\Controllers\Admin\ProjectController::class, 'index'])->name('admin.projects.index');
    Route::get('/projects/create', [App\Http\Controllers\Admin\ProjectController::class, 'create'])->name('admin.projects.create');
    Route::post('/projects', [App\Http\Controllers\Admin\ProjectController::class, 'store'])->name('admin.projects.store');
    Route::get('/projects/{project}/edit', [App\Http\Controllers\Admin\ProjectController::class, 'edit'])->name('admin.projects.edit');
    Route::put('/projects/{project}', [App\Http\Controllers\Admin\ProjectController::class, 'update'])->name('admin.projects.update');
    Route::delete('/projects/{project}', [App\Http\Controllers\Admin\ProjectController::class, 'destroy'])->name('admin.projects.destroy');
    
    // Contacts Management
    Route::get('/contacts', [App\Http\Controllers\Admin\ContactController::class, 'index'])->name('admin.contacts.index');
    Route::get('/contacts/{contact}', [App\Http\Controllers\Admin\ContactController::class, 'show'])->name('admin.contacts.show');
    Route::put('/contacts/{contact}/read', [App\Http\Controllers\Admin\ContactController::class, 'markAsRead'])->name('admin.contacts.markAsRead');
    Route::delete('/contacts/{contact}', [App\Http\Controllers\Admin\ContactController::class, 'destroy'])->name('admin.contacts.destroy');
    
    // Books Management
    Route::get('/books', [App\Http\Controllers\Admin\BookController::class, 'index'])->name('admin.books.index');
    Route::get('/books/create', [App\Http\Controllers\Admin\BookController::class, 'create'])->name('admin.books.create');
    Route::post('/books', [App\Http\Controllers\Admin\BookController::class, 'store'])->name('admin.books.store');
    Route::get('/books/{book}/edit', [App\Http\Controllers\Admin\BookController::class, 'edit'])->name('admin.books.edit');
    Route::put('/books/{book}', [App\Http\Controllers\Admin\BookController::class, 'update'])->name('admin.books.update');
    Route::delete('/books/{book}', [App\Http\Controllers\Admin\BookController::class, 'destroy'])->name('admin.books.destroy');
    
    // Orders Management
    Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{order}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('admin.orders.show');
    Route::put('/orders/{order}/status', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::delete('/orders/{order}', [App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('admin.orders.destroy');
});