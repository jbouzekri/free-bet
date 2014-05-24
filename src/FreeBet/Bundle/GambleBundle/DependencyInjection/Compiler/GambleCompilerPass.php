<?php

namespace FreeBet\Bundle\GambleBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Definition;

class GambleCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
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
            $this->processTags($definition, $id, $tagAttributes);
        }
    }

    /**
     * Process tagged services
     *
     * @param \Symfony\Component\DependencyInjection\Definition $definition
     * @param string $id
     * @param array $tagAttributes
     *
     * @return void
     */
    public function processTags(Definition $definition, $id, $tagAttributes)
    {
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
