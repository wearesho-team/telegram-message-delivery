<?php

declare(strict_types=1);

namespace Wearesho\Delivery\Telegram;

use Horat1us\Environment;

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
}
