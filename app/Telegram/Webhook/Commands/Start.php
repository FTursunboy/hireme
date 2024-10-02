<?php

namespace App\Telegram\Webhook\Commands;

namespace App\Telegram\Webhook\Commands;

use App\Facades\Telegram;
use App\Models\User;
use App\Telegram\Helpers\InlineButton;
use App\Telegram\Helpers\KeyboardButton;
use App\Telegram\Webhook\Webhook;

class Start extends Webhook
{
    public function run()
    {
        $user = User::where('tg_id', $this->request->input('message')['from']['id'])->update([
            'state' => null
        ]);

        InlineButton::add('Исполнитель', 'Performer', ['data' => 1]);
        InlineButton::add('Заказчик', 'Customer',  ['data' => 2]);
        return Telegram::inlineButton($this->request->input('message')['from']['id'], 'Выберите роль', InlineButton::$buttons)->send();
    }
}
