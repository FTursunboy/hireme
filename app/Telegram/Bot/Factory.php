<?php

namespace App\Telegram\Bot;

class Factory
{
    private Message $message;

    public function __construct()
    {
        $this->message = new Message();
    }

    public function __call(string $name, array $arguments)
    {
        foreach ($this as $key => $prop) {
            if (method_exists($this->$key, $name)) {
                return $this->$key->$name(...$arguments);
            }
        }

        throw new \Exception('no such method');
    }
}
