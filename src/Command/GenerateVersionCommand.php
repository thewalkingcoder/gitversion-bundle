<?php

declare(strict_types=1);

namespace Twc\GitversionBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Twc\GitversionBundle\Domain\Interfaces\VersionProviderInterface;
use Twc\GitversionBundle\Domain\Interfaces\VersionWriterInterface;

class GenerateVersionCommand extends Command
{
    protected static $defaultName = 'twc:generate:version';
    protected static $defaultDescription = "Generate app version related to last git tag.";

    private $versionProvider;
    private $writer;

    public function __construct(
        VersionProviderInterface $versionProvider,
        VersionWriterInterface $writer

    ) {
        parent::__construct();
        $this->versionProvider = $versionProvider;
        $this->writer = $writer;
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $version = $this->versionProvider->fromGit();
        $this->writer->write($version);


        return Command::SUCCESS;
    }
}