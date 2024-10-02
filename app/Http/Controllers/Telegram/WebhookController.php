<?php

namespace App\Http\Controllers\Telegram;

use App\Telegram\Webhook\Realization;
use App\Telegram\Webhook\Webhook;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WebhookController
{
    public function index(Request $request, Webhook $webhook, Realization $realization)
    {
        $path = $realization->take($request);
        if ($path) {
            App::make($path)->run();
            return true;
        }
        else {
            $webhook->run();
        }
        return true;
    }


    public function setWebhook() :Response
    {
        return Http::post( config('telegram.bot.url') . '/setWebhook', [
                'url' => 'https://a8fc-95-142-87-132.ngrok-free.app/api/v1/telegram/webhook'
        ]);
    }
}
