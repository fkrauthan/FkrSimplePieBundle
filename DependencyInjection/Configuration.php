<?php

namespace Fkr\SimplePieBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('fkr_simple_pie');

        $rootNode
			->children()
				->booleanNode('cache_enabled')->defaultFalse()->end()
				->scalarNode('cache_dir')->defaultValue('%kernel.cache_dir%/rss')->end()
				->scalarNode('cache_duration')->defaultValue('3600')->end()
			->end();

        return $treeBuilder;
    }
}
