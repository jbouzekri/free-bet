<?php

namespace BettingSas\Bundle\GambleBundle\Gamble;

use BettingSas\Bundle\GambleBundle\Document\Gamble;
use BettingSas\Bundle\CompetitionBundle\Document\Event;
use BettingSas\Bundle\GambleBundle\BetType\BetTypeChain;

/**
 * Description of GambleProcessor
 *
 * @author jobou
 */
class GambleProcessor
{
    /**
     * @var \BettingSas\Bundle\GambleBundle\BetType\BetTypeChain
     */
    protected $betTypesChain;

    /**
     * @var \BettingSas\Bundle\GambleBundle\Gamble\ScoreCalculatorInterface
     */
    protected $calculator;

    /**
     * Constructor
     *
     * @param \BettingSas\Bundle\GambleBundle\BetType\BetTypeChain $betTypeChain
     * @param \BettingSas\Bundle\GambleBundle\Gamble\ScoreCalculatorInterface $calculator
     */
    public function __construct(BetTypeChain $betTypeChain, ScoreCalculatorInterface $calculator)
    {
        $this->betTypeChain = $betTypeChain;
        $this->calculator = $calculator;
    }

    /**
     * Update a gamble with the score
     *
     * @param \BettingSas\Bundle\GambleBundle\Document\Gamble $gamble
     */
    public function calculateResult(Gamble $gamble)
    {
        if (!$gamble->hasEnded()) {
            return;
        }

        // Fill the winner field in the gamble according to the winner field in its bets
        $gamble->fillWinner();


        if (!$gamble->getWinner()) {
            // Process the case of a losing gamble
            $score = $this->calculator->calculateLosingGamble($gamble);
        } elseif (count($gamble->getBets()) > 1) {
            // Multiple bets gamble score
            $score = $this->calculator->calculateMultipleBet($gamble);
        } else {
            // Single bet gamble score
            $score = $this->calculator->calculateSingleBet($gamble->getBets()->get(0));
        }
        $gamble->setPoint($score);
    }

    /**
     * Update all the bets in a gamble habing an event which has ended
     *
     * @param \BettingSas\Bundle\GambleBundle\Document\Gamble $gamble
     * @param \BettingSas\Bundle\CompetitionBundle\Document\Event $event
     */
    public function processGambleWithEvent(Gamble $gamble, Event $event)
    {
        $bets = $gamble->findBetsWithEvent($event);
        foreach ($bets as $bet) {
            // Update the winner field in each bet
            $betTypeEntity = $this->betTypeChain->findByEventTypeAndType($event->getType(), $bet->getType());
            $result = $betTypeEntity->processBet($bet);
            if (is_bool($result)) {
                $bet->setWinner($result);
            }
        }
    }
}
