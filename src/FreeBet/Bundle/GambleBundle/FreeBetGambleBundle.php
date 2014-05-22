<?php

namespace FreeBet\Bundle\GambleBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use FreeBet\Bundle\GambleBundle\DependencyInjection\Compiler\GambleCompilerPass;

/**
 * FreeBet Soccer World Cup Bundle
 *
 * @author jobou
 */
class FreeBetGambleBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new GambleCompilerPass());
    }
}
