<?php

declare(strict_types=1);

namespace AntidotTest\Session\Infrastructure;

use Antidot\Session\Infrastructure\AuraSessionSegmentFactory;
use Aura\Session\Segment;
use Aura\Session\Session;
use Aura\Session\SessionFactory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

class SessionSegmentFactoryTest extends TestCase
{
    public function testItShouldStartSessionIfNotAlreadyStartedAndReturnASegment(): void
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $request->expects($this->once())
            ->method('getCookieParams')
            ->willReturn([]);
        $session = $this->createMock(Session::class);
        $session->expects($this->once())
            ->method('isStarted')
            ->willReturn(false);
        $session->expects($this->once())
            ->method('start');
        $session->expects($this->once())
            ->method('getSegment')
            ->with('app')
            ->willReturn($this->createMock(Segment::class));
        $factory = $this->createMock(SessionFactory::class);
        $factory->expects($this->once())
            ->method('newInstance')
            ->willReturn($session);

        $sessionSegmentFactory = new AuraSessionSegmentFactory($factory);
        $sessionSegmentFactory($request);
    }
}
