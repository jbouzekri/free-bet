<?php

namespace FreeBet\Bundle\GambleBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class GambleCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('free_bet.bet_type_chain')) {
            return;
        }

        $definition = $container->getDefinition(
            'free_bet.bet_type_chain'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'free_bet.bet_type'
        );
        foreach ($taggedServices as $id => $tagAttributes) {
            foreach ($tagAttributes as $attributes) {

                $order = null;
                if (isset($attributes['order'])) {
                    $order = $attributes['order'];
                }

                $definition->addMethodCall(
                    'addBetType',
                    array(new Reference($id), $attributes['type'], $order)
                );
            }
        }
    }
}
