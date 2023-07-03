<?php

declare(strict_types=1);

namespace Wearesho\Delivery\Telegram;

use Klev\TelegramBotApi\Methods\SendMessage;
use Klev\TelegramBotApi\TelegramException;
use Wearesho\Delivery;

class Service implements Delivery\ServiceInterface
{
    protected Telegram $telegram;

    public function __construct(Telegram $telegram)
    {
        $this->telegram = $telegram;
    }

    public function send(Delivery\MessageInterface $message): void
    {
        try {
            $this->telegram->sendMessage(new SendMessage(
                $message->getRecipient(),
                $message->getText()
            ));
        } catch (TelegramException $exception) {
            throw new Delivery\Exception(
                "Telegram Response Error: " . $exception->getMessage(),
                0,
                $exception
            );
        } catch (\Exception $exception) {
            throw new Delivery\Exception(
                "Telegram Error: " . $exception->getMessage(),
                1,
                $exception
            );
        }
    }
}
