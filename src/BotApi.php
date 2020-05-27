<?php

namespace Wearesho\Delivery\Telegram;

use TgBotApi\BotApiBase;

class BotApi extends BotApiBase\BotApi
{
    public function __construct(
        ConfigInterface $config,
        BotApiBase\ApiClientInterface $apiClient,
        BotApiBase\NormalizerInterface $normalizer
    ) {
        parent::__construct($config->getBotKey(), $apiClient, $normalizer, $config->getEndPoint());
    }
}
