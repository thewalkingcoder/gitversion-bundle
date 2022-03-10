<?php

namespace Twc\GitversionBundle\Tests\Services;

use PHPUnit\Framework\TestCase;
use Twc\GitversionBundle\Domain\Version;
use Twc\GitversionBundle\Services\VersionWriter;

class VersionWriterTest extends TestCase
{
    public function testWriteData()
    {
        $writer = new VersionWriter(__DIR__);
        $writer->write(new Version('v1.0.0'));

        $pathFile = __DIR__.'/'.VersionWriter::FILE_VERSION_NAME;
        $this->assertFileExists($pathFile);
        $content = file_get_contents($pathFile);
        $this->assertSame('v1.0.0', $content);
        @unlink($pathFile);
    }
}
