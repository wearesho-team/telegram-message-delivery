<?php

namespace Wearesho\Delivery\Telegram\Tests\Unit;

use GuzzleHttp;
use Klev\TelegramBotApi\Methods\SendMessage;
use Klev\TelegramBotApi\TelegramException;
use PHPUnit\Framework\Constraint\IsEqual;
use PHPUnit\Framework\Constraint\JsonMatches;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Wearesho\Delivery;

/**
 * Class ServiceTest
 * @package Wearesho\Delivery\Telegram\Tests\Unit
 */
class ServiceTest extends TestCase
{
    /** @var MockObject|Delivery\Telegram\Telegram */
    protected Delivery\Telegram\Telegram $bot;

    protected Delivery\Telegram\Service $service;

    protected function setUp(): void
    {
        /** @var Delivery\Telegram\Telegram|MockObject $bot */
        $bot = $this->createMock(
            Delivery\Telegram\Telegram::class
        );
        $this->bot = $bot;
        $this->service = new Delivery\Telegram\Service($bot);
    }

    public function testSend(): void
    {
        $chatId = mt_rand(1, 10000);
        $text = 'Для микрожизней есть микрозаймы. Надо же держаться и не злить хозяина.';

        $method = new SendMessage($chatId, $text);
        $message = new Delivery\Message($text, $chatId);

        $this->bot
            ->expects($this->once())
            ->method('sendMessage')
            ->with(new IsEqual($method));

        $this->service->send($message);
    }

    /**
     * @dataProvider exceptionProvider
     */
    public function testFail(\Throwable $internalException, string $expectedMessage, int $expectedCode): void
    {
        $this->bot
            ->expects($this->once())
            ->method('sendMessage')
            ->willThrowException($internalException);

        $this->expectException(Delivery\Exception::class);
        $this->expectExceptionMessage($expectedMessage);
        $this->expectExceptionCode($expectedCode);
        try {
            $this->service->send($this->mockMessage());
        } catch (Delivery\Exception $e) {
            $this->assertEquals($internalException, $e->getPrevious());
            throw $e;
        }
    }

    public function exceptionProvider(): array
    {
        return [
            [
                new TelegramException(
                    "SomeShitHappens",
                    mt_rand(0, 100),
                ),
                'Telegram Response Error: SomeShitHappens',
                0
            ],
            [
                new \DomainException("DomainErr"),
                'Telegram Error: DomainErr',
                1
            ]
        ];
    }

    protected function mockMessage()
    {
        return new Delivery\Message('text', 'chat_id');
    }
}
