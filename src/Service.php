<?php

namespace Wearesho\Delivery\Telegram;

use Wearesho\Delivery;
use TgBotApi\BotApiBase;

/**
 * Class Service
 * @package Wearesho\Delivery\Telegram
 */
class Service implements Delivery\ServiceInterface
{
    protected BotApiBase\BotApiInterface $api;

    public function __construct(BotApiBase\BotApiInterface $api)
    {
        $this->api = $api;
    }

    public function send(Delivery\MessageInterface $message): void
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        $method = BotApiBase\Method\SendMessageMethod::create($message->getRecipient(), $message->getText());
        try {
            $this->api->send($method);
        } catch (BotApiBase\Exception\ResponseException $exception) {
            throw new Delivery\Exception(
                "Telegram Response Error: " . $exception->getMessage(),
                0,
                $exception
            );
        } catch (\Throwable $exception) {
            throw new Delivery\Exception(
                "Telegram Delivery Failed",
                1,
                $exception
            );
        }
    }
}
