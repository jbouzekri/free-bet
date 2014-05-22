<?php

namespace FreeBet\Bundle\GambleBundle\Gamble;

use FreeBet\Bundle\GambleBundle\Document\Bet;
use FreeBet\Bundle\GambleBundle\Document\Gamble;

/**
 * ScoreCalculatorInterface
 *
 * @author jobou
 */
interface ScoreCalculatorInterface
{
    /**
     * Calculate a score on a single bet
     *
     * @return int
     */
    public function calculateSingleBet(Bet $bet);

    /**
     * Calculate a score on a gamble with multiple bets
     *
     * @return int
     */
    public function calculateMultipleBet(Gamble $gamble);

    /**
     * Score for a losing gamble (in case you want to do a negative one
     *
     * @param \FreeBet\Bundle\GambleBundle\Document\Gamble $gamble
     * 
     * @return int
     */
    public function calculateLosingGamble(Gamble $gamble);
}
