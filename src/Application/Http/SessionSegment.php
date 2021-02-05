<?php

declare(strict_types=1);

namespace Antidot\Session\Application\Http;

interface SessionSegment
{
    /**
     * @param string $identity
     * @return mixed
     */
    public function get(string $identity);

    /**
     * @param string $identity
     * @return mixed
     */
    public function getFlash(string $identity);

    /**
     * @param string $identity
     * @param mixed $value
     */
    public function set(string $identity, $value): void;

    /**
     * @param string $identity
     * @param mixed $value
     */
    public function setFlash(string $identity, $value): void;
}
