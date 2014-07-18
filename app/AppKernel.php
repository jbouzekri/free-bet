<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    /**
     * {@inheritDoc}
     */
    public function __construct($environment, $debug)
    {
        // All date in DB must be in UTC. The setting of the timezone is done in the template.
        date_default_timezone_set( 'UTC' );

        parent::__construct($environment, $debug);
    }

    /**
     * {@inheritDoc}
     */
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
        );

        $freeBetBundles = array(
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new Doctrine\Bundle\MongoDBBundle\DoctrineMongoDBBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Jb\Bundle\ConfigKnpMenuBundle\JbConfigKnpMenuBundle(),
            new FreeBet\Bundle\UIBundle\FreeBetUIBundle(),
            new FreeBet\Bundle\UserBundle\FreeBetUserBundle(),
            new FreeBet\Bundle\GambleBundle\FreeBetGambleBundle(),
            new FreeBet\Bundle\CompetitionBundle\FreeBetCompetitionBundle(),
            new FreeBet\Bundle\StatisticBundle\FreeBetStatisticBundle(),
            new FreeBet\Bundle\SoccerBundle\FreeBetSoccerBundle(),
            new FreeBet\Bundle\SoccerWorldCupBundle\FreeBetSoccerWorldCupBundle(),
            new FreeBet\Bundle\SoccerLeagueBundle\FreeBetSoccerLeagueBundle()
        );

        $bundles = array_merge($bundles, $freeBetBundles);

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Webfactory\Bundle\ExceptionsBundle\WebfactoryExceptionsBundle();
        }

        return $bundles;
    }

    /**
     * Load config for current env
     *
     * @param \Symfony\Component\Config\Loader\LoaderInterface $loader
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
