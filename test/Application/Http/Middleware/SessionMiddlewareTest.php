<?php

declare(strict_types=1);

namespace AntidotTest\Session\Application\Http\Middleware;

use Antidot\Session\Application\Http\Middleware\SessionMiddleware;
use Antidot\Session\Application\Http\SessionSegment;
use Antidot\Session\Application\Http\SessionSegmentFactory;
use Aura\Session\Segment;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class SessionMiddlewareTest extends TestCase
{
    public function testItShouldAddSessionToRequestAttributesOnProcess(): void
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $segment = $this->createMock(SessionSegment::class);
        $sessionFactory = $this->createMock(SessionSegmentFactory::class);
        $sessionFactory->expects($this->once())
            ->method('__invoke')
            ->willReturn($segment);
        $request->expects($this->once())
            ->method('withAttribute')
            ->with('session', $segment)
            ->willReturn($request);

        $handler = $this->createMock(RequestHandlerInterface::class);
        $middleware = new SessionMiddleware($sessionFactory);

        $middleware->process($request, $handler);

    }
}
