<?php

declare(strict_types=1);

namespace Twc\GitversionBundle\Provider;

use Symfony\Component\Process\Process;
use Twc\GitversionBundle\Domain\Interfaces\VersionProviderInterface;
use Twc\GitversionBundle\Domain\Version;

class VersionProvider implements VersionProviderInterface
{
    private $defaultVersion;
    private $baseDir;
    private $fileName;

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
        $process = Process::fromShellCommandline($this->getCommand());
        $process->setTimeout(0);
        $process->run();

        if (!$process->isSuccessful()) {
            return new Version($this->getDefaultVersion());
        }

        return new Version($process->getOutput());
    }

    protected function getCommand(): string
    {
        return 'git describe --tag';
    }

    public function get(): Version
    {
        if ($this->isFileNotExist()) {
            return new Version($this->getDefaultVersion());
        }

        return new Version($this->getContent());
    }

    protected function isFileNotExist(): bool
    {
        return file_exists($this->getPathFile()) === false;
    }

    protected function getContent(): string
    {
        return file_get_contents($this->getPathFile());
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