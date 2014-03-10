<?php

namespace BettingSas\Bundle\GambleBundle\Component\Processor;

use BettingSas\Bundle\GambleBundle\Document\Gamble;
use BettingSas\Bundle\CompetitionBundle\Document\Event;
use BettingSas\Bundle\GambleBundle\Gamble\GambleChain;

/**
 * Description of GambleProcessor
 *
 * @author jobou
 */
class GambleProcessor
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
     * Update all the bets in a gamble habing an event which has ended
     *
     * @param \BettingSas\Bundle\GambleBundle\Document\Gamble $gamble
     * @param \BettingSas\Bundle\CompetitionBundle\Document\Event $event
     */
    public function processGambleWithEvent(Gamble $gamble, Event $event)
    {
        $bets = $gamble->findBetsWithEvent($event);
        foreach ($bets as $bet) {
            $gambleClass = $this->gambleChain->getGambleByTypeAndEventType($event->getType(), $bet->getType());
            $result = $gambleClass->processBet($bet);
            if (is_bool($result)) {
                $bet->setWinner($result);
            }
        }
    }
}
