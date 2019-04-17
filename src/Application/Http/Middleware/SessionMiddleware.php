<?php

declare(strict_types=1);

namespace Antidot\Session\Application\Http\Middleware;

use Aura\Session\Session;
use Aura\Session\SessionFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class SessionMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /** @var Session $session */
        $session = (new SessionFactory())->newInstance($request->getCookieParams());
        if (false === $session->isStarted()) {
            $session->start();
        }

        return $handler->handle($request->withAttribute('session', $session->getSegment('app')));
    }
}
