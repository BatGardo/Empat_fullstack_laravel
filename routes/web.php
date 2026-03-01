<?php

// - створити міграції та сформуйте структуру БД
// - забезпечити щоб в БД були такі сутності, між якими буде встановлений зв’язок один-до-багатьох та багато-до-багатьох
// - hasMany
// - belongsToMany
// - побудувати відповідні рути та контролери, які дозволять вам мати навігацію по сутностям із БД. Приклад показано у прикріпленому відео

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return view('welcome');
});

// Categories Routes
Route::resource('categories', CategoryController::class);

// Products Routes
Route::resource('products', ProductController::class);

// Tags Routes
Route::resource('tags', TagController::class);

// Reviews Routes
Route::resource('reviews', ReviewController::class);
