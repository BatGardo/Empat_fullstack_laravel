<?php

// {{-- 1. Продемонструвати основи:
// - декілька рутів;
// - get запити з параметрами;
// - post запити;
// - controller з декільками методами, які будуть відповідати за той чи інший запит;
// - декілька шаблонів, які відповідним чином реагують на ті чи інші запити;
// - модель, яка буде імітувати якісь дані (наприклад дані про товар чи про юзера).

// 2. Продемонструвати можливості blade template, а саме:
// - вміння вставити змінні, які ви туди передали
// - вміння foreach-ем пройти по масиву, який ви туди передали
// - зробити if
// - зробити наслідування від базового шаблону --}}

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Main
Route::get('/', [ProductController::class, 'home']);

// GET without parametres
Route::get('/products', [ProductController::class, 'index']);

// GET with parametres
Route::get('/products/{id}', [ProductController::class, 'show']);

// POST request
Route::post('/products', [ProductController::class, 'store']);
