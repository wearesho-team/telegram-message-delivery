<?php

namespace Wearesho\Delivery\Telegram\Tests\Unit;

use Horat1us\Environment;
use PHPUnit\Framework\TestCase;
use Wearesho\Delivery\Telegram\EnvironmentConfig;

class EnvironmentConfigTest extends TestCase
{
    protected EnvironmentConfig $config;

    protected function setUp(): void
    {
        parent::setUp();
        $this->config = new EnvironmentConfig();
    }

    public function testBotToken()
    {
        putenv('TELEGRAM_BOT_KEY=1');
        $this->assertEquals(1, $this->config->getBotKey());
        putenv('TELEGRAM_BOT_KEY');
        $this->expectException(Environment\Exception::class);
        $this->config->getBotKey();
    }

    public function environmentProvider()
    {
        return [
            ['TELEGRAM_BOT_TOKEN=1',]
        ];
    }
}
