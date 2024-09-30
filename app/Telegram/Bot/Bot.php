<?php

namespace App\Telegram\Bot;

use Illuminate\Support\Facades\Http;

class Bot
{
    protected array $data;

    protected string $method;

    public function send()
    {
        return Http::post(config('telegram.bot.url') . '/' . $this->method, $this->data);
    }
}
