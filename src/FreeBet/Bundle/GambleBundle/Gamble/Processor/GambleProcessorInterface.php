<?php

namespace FreeBet\Bundle\GambleBundle\Gamble\Processor;

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
     * Process the gamble
     *
     * @param \FreeBet\Bundle\GambleBundle\Document\Gamble $gamble
     * @param \FreeBet\Bundle\CompetitionBundle\Document\Event $event
     * @param \DateTime $date
     * @return void
     */
    public function process(Gamble $gamble, Event $event, \DateTime $date);

    /**
     * Check if the process can be apply to this gamble
     *
     * @return bool
     */
    public function apply(Gamble $gamble);
}
