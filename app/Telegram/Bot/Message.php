<?php

namespace App\Telegram\Bot;

class Message extends Bot
{
    protected array $data;

    protected string $method;

    public function message(string $chat_id, string $text, $reply_id = null)
    {
        $this->method = 'sendMessage';
        $this->data = [
            'chat_id' => $chat_id,
            'text' => $text,
            'parse_mode' => 'html',
            'reply_markup' => [
                'remove_keyboard' => true
            ]
        ];

        if ($reply_id) {
            $this->data["reply_parameters"] =[
                'message_id' => $reply_id,
            ]
            ;
        }
        return $this;
    }

    public function inlineButton(mixed $chat_id, string $text, array $buttons)
    {
        $this->method = 'sendMessage';

        $this->data = [
            'chat_id' => $chat_id,
            'text' => $text,
            'parse_mode' => 'html',
            'reply_markup' => $buttons
        ];

        return $this;
    }

    public function editMessage(string $chat_id, string $text, int $message_id = null)
    {
        $this->method = 'editMessageText';
        $this->data = [
            'chat_id' => $chat_id,
            'text' => $text,
            'parse_mode' => 'html',
            'message_id' => $message_id,
        ];

        return $this;
    }
}
