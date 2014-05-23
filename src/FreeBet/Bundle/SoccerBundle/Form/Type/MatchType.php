<?php

namespace FreeBet\Bundle\SoccerBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use FreeBet\Bundle\CompetitionBundle\Form\Type\TeamNameType;

class MatchType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('teamName', new TeamNameType());

        $builder->add('leftTeamScore', 'integer', array(
            'required'=>false
        ));
        $builder->add('rightTeamScore', 'integer', array(
            'required'=>false
        ));
        $builder->add('leftTeamHalfTimeScore', 'integer', array(
            'required'=>false
        ));
        $builder->add('rightTeamHalfTimeScore', 'integer', array(
            'required'=>false
        ));
        $builder->add('leftTeamAfterExtendedTimeScore', 'integer', array(
            'required'=>false
        ));
        $builder->add('rightTeamAfterExtendedTimeScore', 'integer', array(
            'required'=>false
        ));
        $builder->add('leftTeamPenaltyScore', 'integer', array(
            'required'=>false
        ));
        $builder->add('rightTeamPenaltyScore', 'integer', array(
            'required'=>false
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FreeBet\Bundle\SoccerBundle\Document\Match',
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'match';
    }
}