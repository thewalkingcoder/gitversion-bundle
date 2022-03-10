<?php

declare(strict_types=1);

namespace Twc\GitversionBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('twc_gitversion');
        $treeBuilder->getRootNode()->children()
            ->scalarNode("default_version")
            ->defaultValue("v0.1.0")
            ->end()
            ->scalarNode("file_name")
            ->defaultValue("VERSION")
            ->end();

        return $treeBuilder;
    }
}