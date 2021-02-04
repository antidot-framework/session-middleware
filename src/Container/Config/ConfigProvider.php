<?php

declare(strict_types=1);

namespace Antidot\Session\Container\Config;

use Antidot\Session\Application\Http\Middleware\SessionMiddleware;

class ConfigProvider
{
    /**
     * @return array<string, array<string, string>>
     */
    public function __invoke(): array
    {
        return [
            'services' => [
                SessionMiddleware::class => SessionMiddleware::class,
            ],
        ];
    }
}
