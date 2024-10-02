<?php

namespace App\Telegram\Helpers;

class InlineButton
{
    public static array $buttons = [
        'inline_keyboard' => [
            [

            ]
        ]
    ];

    public static int $button_number = 1;

    public static function add(mixed $text, string $action, array $data)
    {
        $data['button_number'] = self::$button_number;
        $data['action'] = $action;

        if (empty(self::$buttons['inline_keyboard'])) {
            self::$buttons['inline_keyboard'][0] = [];
        }

        $lastRow = count(self::$buttons['inline_keyboard']) - 1;

        if (count(self::$buttons['inline_keyboard'][$lastRow]) >= 1) {
            self::$buttons['inline_keyboard'][] = [];
            $lastRow++;
        }

        self::$buttons['inline_keyboard'][$lastRow][] = [
            'text' => $text,
            'callback_data' => json_encode($data),
            'reply_markup' => [
                'remove_keyboard' => true // Удаление клавиатуры
            ]
        ];
    }




    public static function link(mixed $text, string $url, int $row = 1)
    {

        self::$buttons['inline_keyboard'][$row - 1][] = [
            'text' => $text,
            'url' => $url
        ];
    }
}
