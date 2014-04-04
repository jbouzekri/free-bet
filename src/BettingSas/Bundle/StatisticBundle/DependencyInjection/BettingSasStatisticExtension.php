<?php

namespace BettingSas\Bundle\StatisticBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;

/**
 * BettingSasStatisticExtension.
 *
 * @author jobou
 */
class BettingSasStatisticExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $configs);
        $this->loadConfiguration($config, $container);
    }

    public function loadConfiguration(array $configs, ContainerBuilder $container)
    {
        var_dump($configs);
        $container->setParameter('betting_sas.default_widgets', $configs['default_widgets']);
    }
}
