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
    protected $choices = array(
        "1-0",
        "2-0",
        "2-1",
        "3-0",
        "3-1",
        "3-2",
        "4-0",
        "4-1",
        "4-2",
        "4-3",

        "0-0",
        "1-1",
        "2-2",
        "3-3",
        "4-4",
        "5-5",

        "0-1",
        "0-2",
        "1-2",
        "0-3",
        "1-3",
        "2-3",
        "0-4",
        "1-4",
        "2-4",
        "3-4",
    );

    public function getChoices()
    {
        return $this->choices;
    }

    public function getName()
    {
        return 'exact_score';
    }

    public function getTemplate()
    {
        return 'BettingSasSoccerBundle:Gamble:exact_score.html.twig';
    }
}
