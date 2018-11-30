<?php

namespace Wearesho\Delivery\Telegram\Tests\Unit;

use GuzzleHttp;
use PHPUnit\Framework\TestCase;
use Telegram\Bot\Api as TelegramApi;
use Telegram\Bot\HttpClients\GuzzleHttpClient;
use Wearesho\Delivery;

/**
 * Class ServiceTest
 * @package Wearesho\Delivery\Telegram\Tests\Unit
 */
class ServiceTest extends TestCase
{
    /** @var Delivery\Telegram\Service */
    protected $service;

    /** @var GuzzleHttp\Handler\MockHandler */
    protected $mock;

    /** @var array */
    protected $container;
    
    protected function setUp(): void
    {
        $this->mock = new GuzzleHttp\Handler\MockHandler();
        $this->container = [];
        $history = GuzzleHttp\Middleware::history($this->container);

        $stack = new GuzzleHttp\HandlerStack($this->mock);
        $stack->push($history);

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->service = new Delivery\Telegram\Service(new TelegramApi(
            'token',
            false,
            new GuzzleHttpClient(
                new GuzzleHttp\Client([
                    'handler' => $stack,
                ])
            )
        ));
    }

    public function testSend(): void
    {
        $response = new GuzzleHttp\Psr7\Response();
        $this->mock->append($response);

        $this->service->send($this->mockMessage());

        $this->assertEquals($response, $this->container[0]['response']);
    }

    public function testFail(): void
    {
        $this->expectException(Delivery\Exception::class);
        $this->expectExceptionMessage('Telegram bot error: Error');

        $this->mock->append(
            new GuzzleHttp\Exception\RequestException('Error', new GuzzleHttp\Psr7\Request('GET', 'uri'))
        );

        $this->service->send($this->mockMessage());
    }

    protected function mockMessage()
    {
        return new Delivery\Message('text', 'chat_id');
    }
}
