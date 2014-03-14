<?php

namespace BettingSas\Bundle\GambleBundle\Document\Repository;

use BettingSas\Bundle\CompetitionBundle\Document\Event;

/**
 *
 * @author jobou
 */
interface GambleRepositoryInterface
{
    /**
     * Find all gambles having at least one bet on a specific event
     *
     * @param \BettingSas\Bundle\CompetitionBundle\Document\Event $event
     *
     * @return array
     */
    public function findAllGambleHavingBetsOnEvent(Event $event);

    /**
     * Count all gambles having at least one bet of a specific type on a specific event
     *
     * @param \BettingSas\Bundle\CompetitionBundle\Document\Event $event
     * @param string $betType
     *
     * @return array
     */
    public function countAllGambleHavingBetsOnEventWithType(Event $event, $betType);

    /**
     * Find all gambles not fully processed having at least one bet with a known result
     *
     * @return array
     */
    public function findAllGambleWithProcessedBets();
}
