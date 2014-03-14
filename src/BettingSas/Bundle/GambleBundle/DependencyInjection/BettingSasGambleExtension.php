<?php

namespace BettingSas\Bundle\GambleBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Config\FileLocator;

/**
 * BettingSasCompetitionBundleExtension.
 *
 * @author jobou
 */
class BettingSasGambleExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $gambleConfig = array();

        foreach ($container->getParameter('kernel.bundles') as $bundle) {
            $reflection = new \ReflectionClass($bundle);
            if (is_file($file = dirname($reflection->getFilename()) . '/Resources/config/gamble_types.yml')) {
                $bundleConfig = Yaml::parse(realpath($file));

                if (is_array($gambleConfig)) {
                    $gambleConfig = array_merge($gambleConfig, $bundleConfig);
                }
            }
        }

        $container->setParameter('betting_sas.gamble.configuration', $gambleConfig);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        $loader->load('validators.yml');
    }
}
