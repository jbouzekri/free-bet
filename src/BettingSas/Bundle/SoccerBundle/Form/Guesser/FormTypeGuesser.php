<?php

namespace BettingSas\Bundle\SoccerBundle\Form\Guesser;

use BettingSas\Bundle\SoccerBundle\Form\Type\GroupMatchType;
use BettingSas\Bundle\SoccerBundle\Form\Type\FinalMatchType;
use BettingSas\Bundle\CompetitionBundle\Form\Guesser\EventFormTypeGuesserInterface;

/**
 * Description of FormTypeGuesser
 *
 * @author jobou
 */
class FormTypeGuesser implements EventFormTypeGuesserInterface
{
    public function getFormType($match)
    {
        if ($match->getPhase() == "group") {
            return new GroupMatchType();
        } else {
            return new FinalMatchType();
        }
    }
}
