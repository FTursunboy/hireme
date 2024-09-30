<?php

use App\Http\Controllers\Telegram\WebhookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'telegram'], function () {
        Route::post('webhook', [WebhookController::class, 'index']);
        Route::get('setWebhook', [WebhookController::class, 'setWebhook']);
    });
});
