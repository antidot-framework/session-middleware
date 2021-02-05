# Antidot Session Middleware

[![link-packagist](https://img.shields.io/packagist/v/antidot-fw/session.svg?style=flat-square)](https://packagist.org/packages/antidot-fw/session)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/antidot-framework/session-middleware/badges/quality-score.png?b=1.x.x)](https://scrutinizer-ci.com/g/antidot-framework/session-middleware/?branch=1.x.x)
[![Code Coverage](https://scrutinizer-ci.com/g/antidot-framework/session-middleware/badges/coverage.png?b=1.x.x)](https://scrutinizer-ci.com/g/antidot-framework/session-middleware/?branch=1.x.x)
[![type-coverage](https://shepherd.dev/github/antidot-framework/react-framework/coverage.svg)](https://shepherd.dev/github/antidot-framework/react-framework)
[![Build Status](https://scrutinizer-ci.com/g/antidot-framework/session-middleware/badges/build.png?b=1.x.x)](https://scrutinizer-ci.com/g/antidot-framework/session-middleware/build-status/1.x.x)

PSR-15 middleware that allows having session inside the request attributes.

## Install

Install using composer, by default it uses an implementation of [Aura Session](https://github.com/auraphp/Aura.Session).

```bash
composer require antidot-fw/session
```

## Config

Using [Antidot Framework Starter](), it will work after adding the middleware to the pipeline. Also, you can use it in any
PSR-15 compatible middleware pipeline using PSR-11 container.

```php
<?php

$sessionFactory = new AuraSessionFactory();
$sessionMiddleware = new SessionMiddleware($sessionFactory($container));
```

Add it to your pipeline

```php
<?php

use Antidot\Application\Http\Application;
use Antidot\Application\Http\Middleware\RouteDispatcherMiddleware;
use Antidot\Session\Application\Http\Middleware\SessionMiddleware;
...

return static function (Application $app) : void {
    $app->pipe(...);
    $app->pipe(SessionMiddleware::class); // added here
    $app->pipe(RouteDispatcherMiddleware::class);
    ...
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
        /** @var \Antidot\Session\Application\Http\SessionSegment $session */
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

## Adding custom session implementation

To create a wrapper for your own custom session, you need to implement both `Antidot\Session\Application\Http\SessionSegment` 
and  `Antidot\Session\Application\Http\SessionSegmentFactory` clases, take a look to the 
`Antidot\Session\Infrastructure\AuraSessionSegment` and `Antidot\Session\Infrastructure\AuraSessionSegmentFactory`.

```php
<?php

declare(strict_types=1);

namespace Antidot\Session\Application\Http;

interface SessionSegment
{
    public function get(string $identity);
    public function getFlash(string $identity);
    public function set(string $identity, $value): void;
    public function setFlash(string $identity, $value): void;
}
```

```php
<?php

declare(strict_types=1);

namespace Antidot\Session\Application\Http;

use Psr\Http\Message\ServerRequestInterface;

interface SessionSegmentFactory
{
    public function __invoke(ServerRequestInterface $request): SessionSegment;
}
```
