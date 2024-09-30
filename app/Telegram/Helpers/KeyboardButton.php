<?php

namespace App\Telegram\Helpers;

class KeyboardButton
{
    public static array $buttons = [
        'keyboard' => [

        ],
        'resize_keyboard' => true,
    ];

    public static function add(mixed $text, string $action, array $data, int $row = 1)
    {
        $data['action'] = $action;
        self::$buttons['keyboard'][$row - 1][] = [
            'text' => $text
        ];
    }

    public function remove()
    {
        self::$buttons = [
            'remove_keyboard' => true
        ];
    }
}
