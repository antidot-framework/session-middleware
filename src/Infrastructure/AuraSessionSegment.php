<?php

declare(strict_types=1);

namespace Antidot\Session\Infrastructure;

use Antidot\Session\Application\Http\SessionSegment;
use Aura\Session\Segment;

class AuraSessionSegment implements SessionSegment
{
    private Segment $segment;

    public function __construct(Segment $segment)
    {
        $this->segment = $segment;
    }

    public function get(string $identity)
    {
        return $this->segment->get($identity);
    }

    public function getFlash(string $identity)
    {
        return $this->segment->getFlash($identity);
    }

    public function set(string $identity, $value): void
    {
        $this->segment->set($identity, $value);
    }

    public function setFlash(string $identity, $value): void
    {
        $this->segment->setFlash($identity, $value);
    }
}
