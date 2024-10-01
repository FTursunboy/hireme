<?php

namespace App\Telegram\Webhook\Commands;

namespace App\Telegram\Webhook\Commands;

use App\Facades\Telegram;
use App\Telegram\Helpers\InlineButton;
use App\Telegram\Helpers\KeyboardButton;
use App\Telegram\Webhook\Webhook;

class Start extends Webhook
{
    public function run()
    {
        InlineButton::add('Исполнитель', 'Performer', ['data' => 1]);
        InlineButton::add('Заказчик', 'Customer',  ['data' => 2]);
        Telegram::editMessage('5002918981', 'hello motherfucker',62 )->send();
        return Telegram::inlineButton('5002918981', 'Выберите роль', InlineButton::$buttons)->send();
    }
}
