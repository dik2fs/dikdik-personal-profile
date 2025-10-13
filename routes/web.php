<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

// ==================== FRONTEND ROUTES ====================
Route::get('/', [ProfileController::class, 'index'])->name('home');
Route::get('/about', [ProfileController::class, 'about'])->name('about');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// ==================== ADMIN ROUTES ====================
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Auth\LoginController;

// Authentication Routes
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login']);
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

// Admin Routes (Protected)
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Profile Management
    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    
    // Projects Management
    Route::get('/projects', [AdminProjectController::class, 'index'])->name('admin.projects.index');
    Route::get('/projects/create', [AdminProjectController::class, 'create'])->name('admin.projects.create');
    Route::post('/projects', [AdminProjectController::class, 'store'])->name('admin.projects.store');
    Route::get('/projects/{project}/edit', [AdminProjectController::class, 'edit'])->name('admin.projects.edit');
    Route::put('/projects/{project}', [AdminProjectController::class, 'update'])->name('admin.projects.update');
    Route::delete('/projects/{project}', [AdminProjectController::class, 'destroy'])->name('admin.projects.destroy');
    
    // Contacts Management
    Route::get('/contacts', [AdminContactController::class, 'index'])->name('admin.contacts.index');
    Route::get('/contacts/{contact}', [AdminContactController::class, 'show'])->name('admin.contacts.show');
    Route::put('/contacts/{contact}/read', [AdminContactController::class, 'markAsRead'])->name('admin.contacts.markAsRead');
    Route::delete('/contacts/{contact}', [AdminContactController::class, 'destroy'])->name('admin.contacts.destroy');
});

// Books Routes
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
Route::get('/books/category/{category}', [BookController::class, 'byCategory'])->name('books.byCategory');

// Admin Books Routes
Route::prefix('admin')->middleware(['auth'])->group(function () {
    // ... routes sebelumnya
    
    // Books Management
    Route::get('/books', [AdminBookController::class, 'index'])->name('admin.books.index');
    Route::get('/books/create', [AdminBookController::class, 'create'])->name('admin.books.create');
    Route::post('/books', [AdminBookController::class, 'store'])->name('admin.books.store');
    Route::get('/books/{book}/edit', [AdminBookController::class, 'edit'])->name('admin.books.edit');
    Route::put('/books/{book}', [AdminBookController::class, 'update'])->name('admin.books.update');
    Route::delete('/books/{book}', [AdminBookController::class, 'destroy'])->name('admin.books.destroy');

    // Orders Routes
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

// Admin Orders Routes
Route::prefix('admin')->middleware(['auth'])->group(function () {
    // ... routes sebelumnya
    
    // Orders Management
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::put('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy'])->name('admin.orders.destroy');
});
});