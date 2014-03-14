<?php

namespace BettingSas\Bundle\GambleBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
     /**
     * Generates the configuration tree.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder;
        $rootNode = $treeBuilder->root('betting_sas_gamble');

        $rootNode
            ->children()
                ->scalarNode('validation_group')->defaultValue('betting_sas')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
