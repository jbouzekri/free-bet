<?php

namespace FreeBet\Bundle\SoccerLeagueBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('free_bet_soccer_league');

        $rootNode
            ->children()
                ->arrayNode('scrapers')
                    ->prototype('array')
                    ->children()
                        ->scalarNode('url')->isRequired()->end()
                    ->end()
                ->end()
            ->end();
        ;

        return $treeBuilder;
    }
}
