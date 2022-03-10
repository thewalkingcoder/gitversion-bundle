<?php

namespace Twc\GitversionBundle\Tests\Provider;

use PHPUnit\Framework\TestCase;
use Twc\GitversionBundle\Domain\Version;
use Twc\GitversionBundle\Provider\VersionProvider;

class VersionProviderTest extends TestCase
{
    public function testDefaultVersion()
    {
        $provider = $this->createPartialMock(VersionProvider::class, ['getCommand', 'getDefaultVersion']);
        $provider->method('getCommand')->willReturn('bad command');
        $provider->method('getDefaultVersion')->willReturn('v0.1.0');

        $version = $provider->fromGit();
        $this->assertInstanceOf(Version::class, $version);
        $this->assertSame('v0.1.0', $version->toString());
    }

    /**
     * @dataProvider dataProvideVersionProvider
     */
    public function testGetWithFile(string $defaultVersion, bool $fileNotExist, string $content, string $expected)
    {
        $provider = $this->createPartialMock(
            VersionProvider::class,
            ['getDefaultVersion', 'isFileNotExist', 'getContent']
        );
        $provider->method('getDefaultVersion')->willReturn($defaultVersion);
        $provider->method('isFileNotExist')->willReturn($fileNotExist);
        $provider->method('getContent')->willReturn($content);
        $this->assertSame($expected, $provider->get()->toString());
    }

    public function dataProvideVersionProvider()
    {
        //data in file
        yield ['v0.1.0', false, 'v5.0.0', 'v5.0.0'];
        //file not exist
        yield ['v0.1.0', true, '', 'v0.1.0'];
    }
}
