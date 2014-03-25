<?php

namespace BettingSas\Bundle\GambleBundle\Gamble;

use BettingSas\Bundle\GambleBundle\Document\Bet;
use BettingSas\Bundle\GambleBundle\Document\Gamble;
use BettingSas\Bundle\GambleBundle\BetType\BetTypeChain;

/**
 * Description of SimpleScoreCalculator
 *
 * @author jobou
 */
class SimpleScoreCalculator implements ScoreCalculatorInterface
{
    /**
     * @var \BettingSas\Bundle\GambleBundle\BetType\BetTypeChain
     */
    protected $betTypeChain;

    /**
     * Constructor
     *
     * @param \BettingSas\Bundle\GambleBundle\BetType\BetTypeChain $betTypeChain
     */
    public function __construct(BetTypeChain $betTypeChain)
    {
        $this->betTypeChain = $betTypeChain;
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
        $betTypeEntity = $this->betTypeChain->findByEventTypeAndType($bet->getEvent()->getType(), $bet->getType());

        return $betTypeEntity->getDifficulty();
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
