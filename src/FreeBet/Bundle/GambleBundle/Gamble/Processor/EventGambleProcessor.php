<?php

namespace FreeBet\Bundle\GambleBundle\Gamble\Processor;

use FreeBet\Bundle\GambleBundle\Document\Gamble;
use FreeBet\Bundle\CompetitionBundle\Document\Event;
use FreeBet\Bundle\GambleBundle\BetType\BetTypeChain;

/**
 * Description of EventGambleProcessor
 *
 * @author jobou
 */
class EventGambleProcessor implements GambleProcessorInterface
{
    /**
     * @var \FreeBet\Bundle\GambleBundle\BetType\BetTypeChain
     */
    protected $betTypeChain;

    /**
     * Constructor
     *
     * @param \FreeBet\Bundle\GambleBundle\BetType\BetTypeChain $betTypeChain
     */
    public function __construct(BetTypeChain $betTypeChain)
    {
        $this->betTypeChain = $betTypeChain;
    }

    /**
     * {@inheritDoc}
     */
    public function process(Gamble $gamble, Event $event, \DateTime $date)
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

    /**
     * {@inheritDoc}
     */
    public function apply(Gamble $gamble)
    {
        return !$gamble->hasEnded();
    }
}
