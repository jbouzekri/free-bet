<?php

namespace BettingSas\Bundle\SoccerWorldCupBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GroupMatchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('leftTeamScore', 'integer', array(
            'required'=>false
        ));
        $builder->add('rightTeamScore', 'integer', array(
            'required'=>false
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BettingSas\Bundle\SoccerBundle\Document\Match',
        ));
    }

    public function getName()
    {
        return 'soccer_group_match';
    }
}