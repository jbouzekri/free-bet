<?php

namespace FreeBet\Bundle\SoccerLeagueBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Definition;

class SoccerLeagueScraperCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('free_bet.soccer.leage.scraper_chain')) {
            return;
        }

        $definition = $container->getDefinition(
            'free_bet.soccer.leage.scraper_chain'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'free_bet.web_scraper'
        );

        foreach ($taggedServices as $id => $attributes) {
            $this->processScrapers($definition, $id, $attributes);
        }
    }

    /**
     * Process web scraper services
     *
     * @param \Symfony\Component\DependencyInjection\Definition $definition
     * @param string $id
     * @param array $attributes
     *
     * @return void
     */
    public function processScrapers(Definition $definition, $id, $attributes)
    {
        foreach ($attributes as $attribute) {
            $definition->addMethodCall(
                'addScraper',
                array(new Reference($id), $attribute['alias'])
            );
        }
    }
}
