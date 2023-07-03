<?php

declare(strict_types=1);

namespace Wearesho\Delivery\Telegram;

interface ConfigInterface
{
    public function getBotKey(): string;
}
