<?php

namespace Wearesho\Delivery\Telegram;

use Horat1us\Environment;

/**
 * Class EnvironmentConfig
 * @package Wearesho\Delivery\Telegram
 */
class EnvironmentConfig extends Environment\Config implements ConfigInterface
{
    public function __construct(string $keyPrefix = 'TELEGRAM_')
    {
        parent::__construct($keyPrefix);
    }

    public function getBotKey(): string
    {
        return $this->getEnv('BOT_KEY');
    }

    public function getEndPoint(): string
    {
        return $this->getEnv("ENDPOINT", static::DEFAULT_ENDPOINT);
    }
}
