<?php

namespace FreeBet\Bundle\SoccerLeagueBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Definition\Processor;

/**
 * FreeBetSoccerLeagueExtension
 *
 * @author jobou
 */
class FreeBetSoccerLeagueExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $config = $processor->processConfiguration(new Configuration(), $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        $loader->load('scrapers.yml');

        $this->loadScrapers($container, $config['scrapers']);
    }

    private function loadScrapers(ContainerBuilder $container, array $configs)
    {
        foreach ($configs as $type => $config) {
            foreach ($config as $configKey => $configValue) {
                $container->setParameter('free_bet.scraper.'.$type.'.'.$configKey, $configValue);
            }
        }
    }
}
