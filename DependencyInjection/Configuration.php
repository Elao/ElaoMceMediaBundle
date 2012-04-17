<?php

namespace Elao\Bundle\MceMediaBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration for ElaoMceMediaBundle
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

        $root = $treeBuilder->root('elao_mce_media');

        $root
            ->children()
                ->booleanNode('is_login')->defaultValue(false)->end()
                ->scalarNode('role')->defaultValue('')->end()
                ->scalarNode('secret_key')->defaultValue('')->end()
                ->arrayNode('configs')
                    ->useAttributeAsKey('key')
                        ->prototype('scalar')->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }

}