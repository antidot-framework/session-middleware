<?php

declare(strict_types=1);

namespace Antidot\Session\Infrastructure;

use Antidot\Session\Application\Http\SessionSegment;
use Antidot\Session\Application\Http\SessionSegmentFactory;
use Aura\Session\SessionFactory;
use Psr\Http\Message\ServerRequestInterface;

class AuraSessionSegmentFactory implements SessionSegmentFactory
{
    private SessionFactory $factory;
    private string $segmentName;

    public function __construct(SessionFactory $factory, string $segmentName = 'app')
    {
        $this->factory = $factory;
        $this->segmentName = $segmentName;
    }

    public function __invoke(ServerRequestInterface $request): SessionSegment
    {
        $session = $this->factory->newInstance($request->getCookieParams());
        if (false === $session->isStarted()) {
            $session->start();
        }

        return new AuraSessionSegment($session->getSegment($this->segmentName));
    }
}
