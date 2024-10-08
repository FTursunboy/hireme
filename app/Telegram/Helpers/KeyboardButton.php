<?php

namespace App\Telegram\Helpers;

class KeyboardButton
{
    public static array $buttons = [
        'keyboard' => [

        ],
        'resize_keyboard' => true,
    ];

    public static function add(mixed $text, int $row = 1)
    {
        self::$buttons['keyboard'][$row - 1][] = [
            'text' => $text,
            'request_contact' => true,
        ];
    }

    public static function remove()
    {
        self::$buttons = [
            'remove_keyboard' => true
        ];
    }
}
