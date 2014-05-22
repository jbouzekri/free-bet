<?php

namespace FreeBet\Bundle\StatisticBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;

/**
 * FreeBetStatisticExtension.
 *
 * @author jobou
 */
class FreeBetStatisticExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $configs);
        $this->loadConfiguration($config, $container);
    }

    /**
     * Load custom configuration in container
     *
     * @param array $configs
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function loadConfiguration(array $configs, ContainerBuilder $container)
    {
        $container->setParameter('free_bet.default_widgets', $configs['default_widgets']);
    }
}
