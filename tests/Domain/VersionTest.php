<?php

namespace Twc\GitversionBundle\Tests\Domain;

use PHPUnit\Framework\TestCase;
use Twc\GitversionBundle\Domain\Version;

class VersionTest extends TestCase
{
    public function testToString()
    {
        $version = new Version('v1.0.0');
        $this->assertSame('v1.0.0', $version->toString());
    }
}