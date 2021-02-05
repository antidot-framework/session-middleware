# Antidot Session Middleware

[![link-packagist](https://img.shields.io/packagist/v/antidot-fw/session.svg?style=flat-square)](https://packagist.org/packages/antidot-fw/session)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/antidot-framework/session-middleware/badges/quality-score.png?b=1.x.x)](https://scrutinizer-ci.com/g/antidot-framework/session-middleware/?branch=1.x.x)
[![Code Coverage](https://scrutinizer-ci.com/g/antidot-framework/session-middleware/badges/coverage.png?b=1.x.x)](https://scrutinizer-ci.com/g/antidot-framework/session-middleware/?branch=1.x.x)
[![type-coverage](https://shepherd.dev/github/antidot-framework/react-framework/coverage.svg)](https://shepherd.dev/github/antidot-framework/react-framework)
[![Build Status](https://scrutinizer-ci.com/g/antidot-framework/session-middleware/badges/build.png?b=1.x.x)](https://scrutinizer-ci.com/g/antidot-framework/session-middleware/build-status/1.x.x)

PSR-15 middleware that allows having [Aura Session](https://github.com/auraphp/Aura.Session) inside our request attributes.

## Install

Intall using composer

```bash
composer require antidot-fw/session
```

Add it to your pipeline

```php
<?php

declare(strict_types=1);

use Antidot\Application\Http\Application;
use Antidot\Application\Http\Middleware\ErrorMiddleware;
use Antidot\Application\Http\Middleware\RouteDispatcherMiddleware;
use Antidot\Application\Http\Middleware\RouteNotFoundMiddleware;
use Antidot\Logger\Application\Http\Middleware\ExceptionLoggerMiddleware;
use Antidot\Logger\Application\Http\Middleware\RequestLoggerMiddleware;
use Antidot\Session\Application\Http\Middleware\SessionMiddleware;

return static function (Application $app) : void {
    $app->pipe(ErrorMiddleware::class);
    $app->pipe(ExceptionLoggerMiddleware::class);
    $app->pipe(SessionMiddleware::class); // added here
    $app->pipe(RequestLoggerMiddleware::class);
    $app->pipe(RouteDispatcherMiddleware::class);
    $app->pipe(RouteNotFoundMiddleware::class);
};

```

## Usage

The session will be stored as request attribute, For example using a Request handler, and it will be available in middleware 
loaded after it too.

```php
<?php
// src/Handler/SomeHandler.php

declare(strict_types=1);

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;

class SomeHandler implements RequestHandlerInterface
{

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        /** @var \Aura\Session\Segment $session */
        $session = $request->getAttribute('session');

        $session->set('foo', 'bar');
        $session->set('baz', 'dib');
        $message = $session->get('foo'); // 'bar'
        $message = $session->get('baz'); // 'dib'
        $session->setFlash('message', 'Hello world!');
        $message = $session->getFlash('message'); // 'Hello world!'
        ...
    }
}

```
