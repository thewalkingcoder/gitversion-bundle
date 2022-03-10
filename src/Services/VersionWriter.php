<?php

declare(strict_types=1);

namespace Twc\GitversionBundle\Services;

use Twc\GitversionBundle\Domain\Interfaces\VersionWriterInterface;
use Twc\GitversionBundle\Domain\Version;

class VersionWriter implements VersionWriterInterface
{
    private $baseDir;
    public const FILE_VERSION_NAME = 'VERSION';

    public function __construct(string $baseDir)
    {
        $this->baseDir = $baseDir;
    }

    public function write(Version $version): void
    {
        file_put_contents($this->getPath().self::FILE_VERSION_NAME, $version->toString());
    }

    protected function getPath(): string
    {
        return rtrim($this->baseDir, '/').'/';
    }
}