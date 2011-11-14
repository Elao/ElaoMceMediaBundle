<?php

namespace Elao\TinyMceBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration for ElaoTinyMceBundle
 */
class Configuration implements ConfigurationInterface
{

    /**
     * Get config tree
     * 
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $root = $treeBuilder->root('elao_tiny_mce');

        $root
            ->children()
                ->booleanNode('is_login')->cannotBeEmpty()->defaultValue(false)->end()
                ->scalarNode('role')->defaultValue('')->end()
                ->scalarNode('path')->cannotBeEmpty()->defaultValue('/')->end()
                ->scalarNode('rootpath')->cannotBeEmpty()->defaultValue('%kernel.root_dir%/../web/medias')->end()
                ->arrayNode('configs')
                    ->useAttributeAsKey('key')
                        ->prototype('scalar')->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }

}