<?php

namespace BettingSas\Bundle\CompetitionBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class EventFormTypeGuesserCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('betting_sas.event_form_type_guesser_chain')) {
            return;
        }

        $definition = $container->getDefinition(
            'betting_sas.event_form_type_guesser_chain'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'betting_sas.event_form_type_guesser'
        );
        var_dump($taggedServices);
        foreach ($taggedServices as $id => $tagAttributes) {
            foreach ($tagAttributes as $attributes) {
                $definition->addMethodCall(
                    'addEventFormTypeGuesser',
                    array(new Reference($id), $attributes['type'])
                );
            }
        }
    }
}
