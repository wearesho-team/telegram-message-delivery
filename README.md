# Telegram integration
[![codecov](https://codecov.io/gh/wearesho-team/telegram-message-delivery/branch/master/graph/badge.svg)](https://codecov.io/gh/wearesho-team/telegram-message-delivery)
[![Build & Test](https://github.com/wearesho-team/telegram-message-delivery/actions/workflows/php.yml/badge.svg)](https://github.com/wearesho-team/telegram-message-delivery/actions/workflows/php.yml)
[wearesho-team/telegram-message-delivery](https://github.com/wearesho-team/telegram-message-delivery) implementation of
[Delivery\ServiceInterface](https://github.com/wearesho-team/message-delivery/blob/1.3.4/src/ServiceInterface.php)

Compatibility: tested on PHP 7.4, PHP 8.1

## Installation
```bash
composer require wearesho-team/telegram-message-delivery:^2.0.0
```

### Configuration
- [ConfigInterface](./src/ConfigInterface.php)
- [EnvironmentConfig](./src/EnvironmentConfig.php)
    - TELEGRAM_BOT_KEY
    - TELEGRAM_ENDPOINT (optional)

### Usage
```php
<?php

use Wearesho\Delivery;

/** @var \TgBotApi\BotApiBase\ApiClient $apiClient */
/** @var Delivery\Telegram\ConfigInterface $config */
$botApi = new Delivery\Telegram\BotApi(
    $config, 
    $apiClient, 
    new \TgBotApi\BotApiBase\BotApiNormalizer()
);
$service = new Delivery\Telegram\Service($botApi);

$service->send(new Delivery\Message('message content', 'chat id'));
```

## Contributors
- [Alexander <horat1us> Letnikow](mailto:reclamme@gmail.com)
- [Roman <KartaviK> Varkuta](mailto:roman.varkuta@gmail.com)

## License
[MIT](./LICENSE)
