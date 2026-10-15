<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TextController;
use App\Http\Controllers\AdminController;

// Публичные маршруты — доступны всем
Route::get('/', [TextController::class, 'index'])->name('home');
Route::get('/category/{id?}', [TextController::class, 'category'])->name('category');

// Авторизация
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Только для журналиста и админа
Route::middleware(['auth', 'role:Журналист,Администратор'])->group(function () {
    Route::get('/journalist', [TextController::class, 'create'])->name('journalist');
    Route::post('/journalist', [TextController::class, 'store'])->name('texts.store');
});

// Только для админа
Route::middleware(['auth', 'role:Администратор'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::delete('/texts/{id}', [AdminController::class, 'destroy'])->name('admin.texts.destroy');
    Route::post('/texts/{id}/toggle-block', [AdminController::class, 'toggleBlock'])->name('admin.texts.toggle-block');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/users/{id}/role', [AdminController::class, 'changeRole'])->name('admin.users.role');
});