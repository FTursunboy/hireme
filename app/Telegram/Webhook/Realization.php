<?php

namespace App\Telegram\Webhook;

use App\Models\User;
use App\Telegram\Webhook\Commands\Start;
use Illuminate\Http\Request;

class Realization
{
    protected const COMMANDS = [
        '/start' => Start::class
    ];

    public function take(Request $request)
    {
        if ($request->input('message')) {
            if (isset($request->input('message')['text'])) {
                $text = $request->input('message')['text'];
                $user_id = $request->input('message')['from']['id'];
                $user = User::where('tg_id', $user_id)->first();
                if (isset($request->input('message')['entities'][0]['type']) &&
                    $request->input('message')['entities'][0]['type'] == 'bot_command') {
                    $command_name = explode(' ', $text)[0];
                    return self::COMMANDS[$command_name];
                }

                if ($user && $user->state) {
                    return '\App\Telegram\Webhook\Action\Performer';
                };
            }
            if (isset($request->input('message')['contact'])) {
                return '\App\Telegram\Webhook\Action\Performer';
            }

        }

        // Обработка callback_query
        if ($request->input('callback_query')) {
            $data = json_decode($request->input('callback_query')['data']);
            return '\App\Telegram\Webhook\Action\\' . $data->action;
        }

        return false;
    }

}
