<?php

namespace App\Facades;


use App\Telegram\Bot\Bot;
use App\Telegram\Bot\Message;
use Illuminate\Support\Facades\Facade;

/**

 * @method static Message message(string $chat_id, string $text, $reply_id = null)
 *
 * @method static Message editMessage(string $chat_id, string $text, int $message_id = null)
 * @method static Message inlineButton(mixed $chat_id, string $text, array $buttons)
 * @method static Message keyBoardButton(mixed $chat_id, string $text, array $buttons)
 * @method  Bot send()
 */


class Telegram extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Telegram::class;
    }
}
