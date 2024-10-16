<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PerformerController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('categories', [CategoryController::class, 'index'])->name('categories');
Route::get('getSubcategories/{category}', [CategoryController::class, 'getSubcategories'])->name('category');


Route::group(['prefix' => 'performers'], function () {
    Route::get('/', [PerformerController::class, 'index'])->name('performers');
    Route::get('/{profile}', [PerformerController::class, 'show'])->name('performers.show');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/admin.php';
require __DIR__.'/auth.php';
