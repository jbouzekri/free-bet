<?php

namespace BettingSas\Bundle\SoccerBundle\Gamble;

use BettingSas\Bundle\GambleBundle\Gamble\GambleInterface;

/**
 * Description of ExactScoreGamble
 *
 * @author jobou
 */
class ExactScoreGamble implements GambleInterface
{
    public function getName()
    {
        return 'exact_score';
    }

    public function getTemplate()
    {
        return 'BettingSasSoccerBundle:Gamble:exact_score.html.twig';
    }
}
