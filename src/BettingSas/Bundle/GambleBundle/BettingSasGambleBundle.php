<?php

namespace BettingSas\Bundle\GambleBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use BettingSas\Bundle\GambleBundle\DependencyInjection\Compiler\GambleCompilerPass;

/**
 * BettingSas Soccer World Cup Bundle
 *
 * @author jobou
 */
class BettingSasGambleBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new GambleCompilerPass());
    }
}
