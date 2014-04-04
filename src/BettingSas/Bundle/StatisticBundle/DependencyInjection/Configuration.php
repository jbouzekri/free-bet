<?php

namespace BettingSas\Bundle\StatisticBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('betting_sas_statistic');

        $rootNode
            ->children()
                ->arrayNode('default_widgets')
                    ->prototype('scalar')->end()
                    ->defaultValue(
                        array(
                            '1',
                            '2',
                            '3'
                        )
                    )
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
