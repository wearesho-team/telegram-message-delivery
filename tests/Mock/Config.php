<?php

namespace Wearesho\Delivery\Telegram\Tests\Mock;

use Wearesho\Delivery;

class Config implements Delivery\Telegram\ConfigInterface
{
    public const BOT_KEY = '1337';

    public function getBotKey(): string
    {
        return static::BOT_KEY;
    }

    public function getEndPoint(): string
    {
        return static::DEFAULT_ENDPOINT;
    }
}
