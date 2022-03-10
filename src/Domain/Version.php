<?php

declare(strict_types=1);

namespace Twc\GitversionBundle\Domain;

class Version
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function toString(): string
    {
        return $this->name;
    }

    public static function default(): self
    {
        return  new self('v0.1.0');

    }
}