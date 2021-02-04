<?php

declare(strict_types=1);

namespace AntidotTest\Session\Container\Config;

use Antidot\Session\Application\Http\Middleware\SessionMiddleware;
use Antidot\Session\Container\Config\ConfigProvider;
use PHPUnit\Framework\TestCase;

class ConfigProviderTest extends TestCase
{
    public function testItShouldHaveMinimumConfigDefined(): void
    {
        $configProvider = new ConfigProvider();
        $this->assertEquals([
            'services' => [
                SessionMiddleware::class => SessionMiddleware::class,
            ],
        ], $configProvider());
    }
}
