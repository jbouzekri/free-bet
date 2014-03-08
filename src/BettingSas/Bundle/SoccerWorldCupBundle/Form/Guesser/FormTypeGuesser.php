<?php

namespace BettingSas\Bundle\SoccerWorldCupBundle\Form\Guesser;

use BettingSas\Bundle\SoccerWorldCupBundle\Form\Type\GroupMatchType;
use BettingSas\Bundle\SoccerWorldCupBundle\Form\Type\FinalMatchType;
use BettingSas\Bundle\SoccerWorldCupBundle\Document\Match;

/**
 * Description of FormTypeGuesser
 *
 * @author jobou
 */
class FormTypeGuesser
{
    public function getFormType(Match $match)
    {
        if ($match->getPhase() == "group") {
            return new GroupMatchType();
        } else {
            return new FinalMatchType();
        }
    }
}
