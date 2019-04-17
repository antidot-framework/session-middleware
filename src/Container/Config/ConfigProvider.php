<?php

declare(strict_types=1);

namespace Antidot\Session\Container\Config;

use Antidot\Session\Application\Http\Middleware\SessionMiddleware;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                'invokables' => [
                    SessionMiddleware::class => SessionMiddleware::class,
                ]
            ]
        ];
    }
}
