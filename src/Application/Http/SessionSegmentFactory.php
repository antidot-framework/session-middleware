<?php

declare(strict_types=1);

namespace Antidot\Session\Application\Http;

use Psr\Http\Message\ServerRequestInterface;

interface SessionSegmentFactory
{
    public function __invoke(ServerRequestInterface $request): SessionSegment;
}
