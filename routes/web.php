<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
require __DIR__.'/auth.php';

// Створити Laravel проєкт та налаштувати підключення до БД, після цього:

//     Створити моделі: користувача, категорії, товару
//     Створити відношення один до багатьох категорія -> товар
//     Створити міграції, фабрики, сідери для всіх моделей
//     Наповнити БД згенерованими даними
//     Створити роути для аутентифікацї та реєстрації користувачів, роути для перегляду категорії, товарів в категорії
//     Створити контролер для роутів
//     Налаштувати валідацію для роутів аутентифікації та реєстрації
//     Закрити роут для отримання товарів авторизацією

// Бонусне завдання:

//     Створити роути для створення та оновлення категорій та товарів
//     Закрити їх авторизацією

// Main page
Route::get('/', function () {
    return view('welcome');
});

// Route for profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Resource routes for models
Route::middleware('auth')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('tags', TagController::class);
    Route::resource('reviews', ReviewController::class);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
