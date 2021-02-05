<?php

declare(strict_types=1);

namespace AntidotTest\Session\Container;

use Antidot\Session\Container\AuraSessionFactory;
use Antidot\Session\Infrastructure\AuraSessionSegment;
use Aura\Session\Segment;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

class AuraSessionFactoryTest extends TestCase
{
    /** @runInSeparateProcess */
    public function testItShouldCreateInstanceOfAuraSession(): void
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $request->expects($this->once())
            ->method('getCookieParams')
            ->willReturn([]);
        $container = $this->createMock(ContainerInterface::class);
        $factory = new AuraSessionFactory();

        $sessionFromRequest = $factory->__invoke($container);
        $session = $sessionFromRequest($request);
        $this->assertInstanceOf(AuraSessionSegment::class, $session);
    }
}
