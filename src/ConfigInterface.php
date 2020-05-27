<?php

namespace Wearesho\Delivery\Telegram;

interface ConfigInterface
{
    public const DEFAULT_ENDPOINT = 'https://api.telegram.org';

    public function getBotKey(): string;

    public function getEndPoint(): string;
}
