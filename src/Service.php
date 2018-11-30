<?php

namespace Wearesho\Delivery\Telegram;

use Telegram\Bot\Api as TelegramApi;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Wearesho\Delivery;

/**
 * Class Service
 * @package Wearesho\Delivery\Telegram
 */
class Service implements Delivery\ServiceInterface
{
    /** @var TelegramApi */
    protected $api;

    public function __construct(TelegramApi $api)
    {
        $this->api = $api;
    }

    /**
     * @param Delivery\MessageInterface $message
     *
     * @throws Delivery\Exception
     */
    public function send(Delivery\MessageInterface $message): void
    {
        try {
            $this->api->sendMessage([
                'chat_id' => $message->getRecipient(),
                'text' => $message->getText()
            ]);
        } catch (TelegramSDKException $exception) {
            throw new Delivery\Exception(
                "Telegram Bot error: " . $exception->getMessage(),
                $exception->getCode(),
                $exception
            );
        }
    }
}
