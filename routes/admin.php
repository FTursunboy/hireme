<?php

use App\Http\Controllers\Admin\AdministratorController;
use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PerformerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::group(['prefix' => 'administrator', 'as' => 'administrator.'], function () {
        Route::post('/post', [AdministratorController::class, 'store'])->name('post');
        Route::get('/', [AdministratorController::class, 'index'])->name('index');
        Route::get('/{user}/edit', [AdministratorController::class, 'edit'])->name('edit');
        Route::get('/create', [AdministratorController::class, 'create'])->name('create');
        Route::patch('/{user}', [AdministratorController::class, 'update'])->name('update');
        Route::delete('/{user}', [AdministratorController::class, 'destroy'])->name('destroy');
        Route::get('/{user}/block', [AdministratorController::class, 'block'])->name('block');
    });
    Route::resource('performers', PerformerController::class);
    Route::get('/performers/archive/{profile}', [PerformerController::class, 'archive'])->name('performers.archive');
    Route::get('/subcategories/{categoryId}', [PerformerController::class, 'getSubcategories'])->name('subcategories');

    Route::resource('customers', CustomersController::class);
    Route::get('/customers/archive/{user}', [CustomersController::class, 'archive'])->name('customers.archive');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


require __DIR__ . '/auth.php';
