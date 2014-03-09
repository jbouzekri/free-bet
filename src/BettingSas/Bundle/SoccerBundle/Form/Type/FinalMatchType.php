<?php

namespace BettingSas\Bundle\SoccerBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * Description of FinalMatchType
 *
 * @author jobou
 */
class FinalMatchType extends GroupMatchType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

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

    public function getName()
    {
        return 'soccer_final_match';
    }
}
