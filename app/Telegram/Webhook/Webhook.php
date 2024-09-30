<?php

namespace App\Telegram\Webhook;

use App\Facades\Telegram;
use Illuminate\Http\Request;

class Webhook
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function run()
    {
        return Telegram::message('5002918981', 'error')->send();
    }
}
