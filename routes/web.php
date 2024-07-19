<?php

use App\Http\Controllers as C;
use Illuminate\Support\Facades\Route;

Route::get('/', C\HomeController::class . '@index')->name('home');
Route::get('storage/{filename}', C\HomeController::class . '@productImage')
    ->where('filename', '(.+)')->name('product.image');

// Auth
Route::get('login', C\AuthController::class . '@loginForm')->name('login');
Route::post('login', C\AuthController::class . '@doLogin');
Route::get('logout', C\AuthController::class . '@doLogout')->name('logout');
Route::post('logout', C\AuthController::class . '@doLogout');

Route::middleware(['auth'])->group(function () {

    // CRUD for Products
    Route::prefix('admin/products')->group(function () {
        Route::get('add', C\AdminProductController::class . '@createForm')
            ->name('product.create');
        Route::post('add', C\AdminProductController::class . '@doCreate');

        Route::get('{object}/edit', C\AdminProductController::class . '@updateForm')
            ->name('product.update');
        Route::post('{object}/edit', C\AdminProductController::class . '@doUpdate');

        Route::get('{object}/delete',
            C\AdminProductController::class . '@deleteForm')
            ->name('product.delete');
        Route::post('{object}/delete',
            C\AdminProductController::class . '@doDelete');
    });

});
