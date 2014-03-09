<?php

namespace BettingSas\Bundle\CompetitionBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use BettingSas\Bundle\CompetitionBundle\DependencyInjection\Compiler\EventFormTypeGuesserCompilerPass;

/**
 * BettingSas Competition Bundle
 *
 * @author jobou
 */
class BettingSasCompetitionBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new EventFormTypeGuesserCompilerPass());
    }
}
