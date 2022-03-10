<?php

declare(strict_types=1);

namespace Twc\GitversionBundle\Domain\Interfaces;

use Twc\GitversionBundle\Domain\Version;

interface VersionWriterInterface
{
    public function write(Version $version): void;
}