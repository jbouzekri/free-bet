<?php

namespace BettingSas\Bundle\SoccerBundle\BetType;

use BettingSas\Bundle\GambleBundle\BetType\BetTypeInterface;
use BettingSas\Bundle\GambleBundle\Document\Bet;

/**
 * Description of ExactScoreGamble
 *
 * @author jobou
 */
class ExactScoreGamble implements BetTypeInterface
{
    /**
     * Get choices available in gamble
     *
     * @return array
     */
    public function getChoices()
    {
        $choices = array();
        $choicesNumber = max(count($this->leftChoices)-1, count($this->nullChoices)-1, count($this->rightChoices)-1);
        for ($i = 0;$i < $choicesNumber;$i++) {
            $choices[] = $this->leftChoices[$i];
            $choices[] = (isset($this->nullChoices[$i])) ? $this->nullChoices[$i] : null;
            $choices[] = $this->rightChoices[$i];
        }
        return $choices;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'exact_score';
    }

    /**
     * {@inheritDoc}
     */
    public function getTemplate()
    {
        return 'BettingSasSoccerBundle:Gamble:exact_score.html.twig';
    }

    /**
     * {@inheritDoc}
     */
    public function getCartTemplate()
    {
        return 'BettingSasSoccerBundle:Gamble:Cart/simple.html.twig';
    }

    /**
     * {@inheritDoc}
     */
    public function processBet(Bet $bet)
    {
        $event = $bet->getEvent();

        $score = $event->getLeftTeamRealScore().'-'.$event->getRightTeamRealScore();
        if ($bet->getChoice() === $score) {
            return true;
        }

        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function validate(Bet $bet)
    {
        return $this->getName() == $bet->getType() && in_array($bet->getChoice(), $this->getChoices());
    }

    /**
     * {@inheritDoc}
     */
    public function getDifficulty()
    {
        return 15;
    }

    /**
     * Left team winner choices
     *
     * @var array
     */
    protected $leftChoices = array(
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
        "5-1",
        "5-2",
        "5-3",
        "5-4",
        "6-0",
        "6-1",
        "6-2",
        "6-3",
        "6-4",
        "6-5",
        "7-0",
        "7-1",
        "7-2",
        "7-3",
        "7-4",
        "8-0",
        "8-1",
        "8-2",
        "8-3",
        "9-0",
        "9-1",
        "9-2",
        "10-0",
        "10-1",
    );

    /**
     * Null choices
     *
     * @var array
     */
    protected $nullChoices = array(
        "0-0",
        "1-1",
        "2-2",
        "3-3",
        "4-4",
        "5-5",
    );

    /**
     * Right team winner choices
     *
     * @var array
     */
    protected $rightChoices = array(
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
        "0-5",
        "1-5",
        "2-5",
        "3-5",
        "4-5",
        "0-6",
        "1-6",
        "2-6",
        "3-6",
        "4-6",
        "5-6",
        "0-7",
        "1-7",
        "2-7",
        "3-7",
        "4-7",
        "0-8",
        "1-8",
        "2-8",
        "3-8",
        "0-9",
        "1-9",
        "2-9",
        "0-10",
        "1-10",
    );
}
