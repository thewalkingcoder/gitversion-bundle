<?php

declare(strict_types=1);

namespace Twc\GitversionBundle\Twig;

use Twc\GitversionBundle\Domain\Interfaces\VersionProviderInterface;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class VersionExtension extends AbstractExtension implements GlobalsInterface
{
    private VersionProviderInterface $provider;

    public function __construct(VersionProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    public function getGlobals(): array
    {
        return [
            'twc_version' => $this->provider->get()->toString(),
        ];
    }

}