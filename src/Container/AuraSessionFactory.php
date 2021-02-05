<?php

declare(strict_types=1);

namespace Antidot\Session\Container;

use Antidot\Session\Application\Http\SessionSegmentFactory;
use Antidot\Session\Infrastructure\AuraSessionSegmentFactory;
use Aura\Session\SessionFactory;
use Psr\Container\ContainerInterface;

class AuraSessionFactory
{
    public function __invoke(ContainerInterface $container): SessionSegmentFactory
    {
        $factory = new SessionFactory();

        return new AuraSessionSegmentFactory($factory);
    }
}
