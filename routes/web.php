<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TaskController;

// Стартовая страница (авторизация)
Route::get('/', function () {
    return view('auth.authorize');
})->name('/');

// Регистрация
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Авторизация
Route::post('/auth', [AuthController::class, 'auth']);

// Группа маршрутов, доступных только для авторизованных пользователей
Route::middleware('auth')->group(function () {
    // Главная страница CRM
    Route::get('/crm', function () {
        return view('crm.index');
    });

    // Выход
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Ресурсные маршруты
    Route::resources([
        '/user' => UserController::class,
        '/category' => CategoryController::class,
        '/product' => ProductController::class,
        '/order' => OrderController::class
    ]);
});

 Route::resource('tasks', TaskController::class);

