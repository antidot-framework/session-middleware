<?php

declare(strict_types=1);

namespace Antidot\Session\Application\Http\Middleware;

use Antidot\Session\Application\Http\SessionSegmentFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class SessionMiddleware implements MiddlewareInterface
{
    private SessionSegmentFactory $sessionFactory;

    public function __construct(SessionSegmentFactory $sessionFactory)
    {
        $this->sessionFactory = $sessionFactory;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $sessionFactory = $this->sessionFactory;

        return $handler->handle($request->withAttribute('session', $sessionFactory($request)));
    }
}
