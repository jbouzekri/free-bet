<?php

namespace FreeBet\Bundle\GambleBundle\Gamble\Processor;

use FreeBet\Bundle\GambleBundle\Document\Gamble;
use FreeBet\Bundle\CompetitionBundle\Document\Event;
use FreeBet\Bundle\GambleBundle\Gamble\ScoreCalculatorInterface;

/**
 * Description of CompleteGambleProcessor
 *
 * @author jobou
 */
class CompleteGambleProcessor implements GambleProcessorInterface
{
    /**
     * @var \FreeBet\Bundle\GambleBundle\Gamble\ScoreCalculatorInterface
     */
    protected $calculator;

    /**
     * Constructor
     *
     * @param \FreeBet\Bundle\GambleBundle\Gamble\ScoreCalculatorInterface $calculator
     */
    public function __construct(ScoreCalculatorInterface $calculator)
    {
        $this->calculator = $calculator;
    }

    /**
     * {@inheritDoc}
     */
    public function process(Gamble $gamble, Event $event, \DateTime $date)
    {
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
        $gamble->setProcessedDate($date);
    }

    /**
     * {@inheritDoc}
     */
    public function apply(Gamble $gamble)
    {
        return $gamble->hasEnded();
    }
}
