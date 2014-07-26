<?php

namespace FreeBet\Bundle\SoccerLeagueBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use FreeBet\Bundle\SoccerLeagueBundle\DependencyInjection\Compiler\SoccerLeagueScraperCompilerPass;

/**
 * FreeBet Soccer League Bundle
 *
 * @author jobou
 */
class FreeBetSoccerLeagueBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new SoccerLeagueScraperCompilerPass());
    }
}
