<?php

namespace FreeBet\Bundle\GambleBundle\Gamble;

use FreeBet\Bundle\GambleBundle\Document\Gamble;
use FreeBet\Bundle\CompetitionBundle\Document\Event;

/**
 * GambleProcessorInterface : Process gamble
 * Calculate score and update gamble properties
 *
 * @author jobou
 */
interface GambleProcessorInterface
{
    /**
     * Update all the bets in a gamble having an event which has ended
     *
     * @param \FreeBet\Bundle\GambleBundle\Document\Gamble $gamble
     * @param \FreeBet\Bundle\CompetitionBundle\Document\Event $event
     * @return void
     */
    public function processGambleWithEvent(Gamble $gamble, Event $event);

    /**
     * Update a gamble with the score
     *
     * @param \FreeBet\Bundle\GambleBundle\Document\Gamble $gamble
     * @return void
     */
    public function calculateResult(Gamble $gamble);
}
