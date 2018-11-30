# Telegram integration

[wearesho-team/telegram-message-delivery](https://github.com/wearesho-team/telegram-message-delivery) implementation of
[Delivery\ServiceInterface](https://github.com/wearesho-team/message-delivery/blob/1.3.4/src/ServiceInterface.php)

## Installation
```bash
composer require wearesho-team/telegram-message-delivery
```

### Additional methods
Besides implementing Delivery\ServiceInterface [Service](./src/Service.php) provides
```php
<?php

use Wearesho\Delivery;
use Telegram\Bot\Api as TelegramApi;

$service = new Delivery\Telegram\Service(new TelegramApi('token'));

$service->send(new Delivery\Message('content', 'recipient'));
```

## Authors
- [Alexander <horat1us> Letnikow](mailto:reclamme@gmail.com)
- [Roman <KartaviK> Varkuta](mailto:roman.varkuta@gmail.com)

## License
[MIT](./LICENSE)
