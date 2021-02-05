<?php

declare(strict_types=1);

namespace AntidotTest\Session\Infrastructure;

use Antidot\Session\Infrastructure\AuraSessionSegment;
use Aura\Session\Segment;
use PHPUnit\Framework\TestCase;

class AuraSessionSegmentTest extends TestCase
{
    public function testItShouldGetSessionDataByIdentity(): void
    {
        $segment = $this->createMock(Segment::class);
        $segment->expects($this->once())
            ->method('get');

        $session = new AuraSessionSegment($segment);

        $session->get('test');
    }
    public function testItShouldGetFlashSessionDataByIdentity(): void
    {
        $segment = $this->createMock(Segment::class);
        $segment->expects($this->once())
            ->method('getFlash');

        $session = new AuraSessionSegment($segment);

        $session->getFlash('test');
    }

    public function testItShouldSetSessionDataWithIdentity(): void
    {
        $segment = $this->createMock(Segment::class);
        $segment->expects($this->once())
            ->method('set');

        $session = new AuraSessionSegment($segment);

        $session->set('test', []);
    }
    public function testItShouldSetFlashSessionDataWithIdentity(): void
    {
        $segment = $this->createMock(Segment::class);
        $segment->expects($this->once())
            ->method('setFlash');

        $session = new AuraSessionSegment($segment);

        $session->setFlash('test', []);
    }
}
