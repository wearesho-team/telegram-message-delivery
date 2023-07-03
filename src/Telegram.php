<?php

declare(strict_types=1);

namespace Wearesho\Delivery\Telegram;

use Klev\TelegramBotApi;

class Telegram extends TelegramBotApi\Telegram
{
    public function __construct(ConfigInterface $config)
    {
        parent::__construct($config->getBotKey());
    }
}
