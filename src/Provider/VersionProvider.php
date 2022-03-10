<?php

declare(strict_types=1);

namespace Twc\GitversionBundle\Provider;

use Symfony\Component\Process\Process;
use Twc\GitversionBundle\Domain\Interfaces\VersionProviderInterface;
use Twc\GitversionBundle\Domain\Version;

class VersionProvider implements VersionProviderInterface
{
    private string $defaultVersion;
    private string $baseDir;
    private string $fileName;

    public function __construct(
        string $defaultVersion,
        string $baseDir,
        string $fileName
    ) {
        $this->defaultVersion = $defaultVersion;
        $this->baseDir = $baseDir;
        $this->fileName = $fileName;
    }

    public function fromGit(): Version
    {
        $process = Process::fromShellCommandline('git describe --tag');
        $process->setTimeout(0);
        $process->run();

        if (!$process->isSuccessful()) {
            return new Version($this->getDefaultVersion());
        }

        return new Version($process->getOutput());
    }

    public function get(): Version
    {
        if (file_exists($this->getPathFile()) === false) {
            return new Version($this->getDefaultVersion());
        }
        $content = file_get_contents($this->getPathFile());

        return new Version($content);
    }

    protected function getPathFile(): string
    {
        return rtrim($this->baseDir, '/').'/'.$this->fileName;
    }

    protected function getDefaultVersion(): string
    {
        return $this->defaultVersion;
    }

}