<?php

declare(strict_types=1);

namespace Twc\GitversionBundle\Domain\Interfaces;

use Twc\GitversionBundle\Domain\Version;

interface VersionProviderInterface
{
    public function fromGit(): Version;
    public function get(): Version;
}