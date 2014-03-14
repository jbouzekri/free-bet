<?php

namespace BettingSas\Bundle\GambleBundle\Gamble;

use BettingSas\Bundle\GambleBundle\Document\Bet;
use BettingSas\Bundle\GambleBundle\Document\Gamble;

/**
 * Description of SimpleScoreCalculator
 *
 * @author jobou
 */
class SimpleScoreCalculator implements ScoreCalculatorInterface
{
    /**
     * @var \BettingSas\Bundle\GambleBundle\Gamble\GambleChain
     */
    protected $gambleChain;

    /**
     * Constructor
     *
     * @param \BettingSas\Bundle\GambleBundle\Gamble\GambleChain $gambleChain
     */
    public function __construct(GambleChain $gambleChain)
    {
        $this->gambleChain = $gambleChain;
    }

    /**
     * {@inheritDoc}
     */
    public function calculateMultipleBet(Gamble $gamble)
    {
        $score = 0;
        foreach ($gamble->getBets() as $bet) {
            $score += $this->calculateSingleBet($bet);
        }

        // Simple rule : multiply score by the number of bet in the cart
        return $score*count($gamble->getBets());
    }

    /**
     * {@inheritDoc}
     */
    public function calculateSingleBet(Bet $bet)
    {
        $gambleClass = $this->gambleChain->getGambleByEventTypeAndType($bet->getEvent()->getType(), $bet->getType());

        return $gambleClass->getDifficulty();
    }

    /**
     *
     * @param \BettingSas\Bundle\GambleBundle\Document\Gamble $gamble
     * @return int
     */
    public function calculateLosingGamble(Gamble $gamble)
    {
        return 0;
    }
}
