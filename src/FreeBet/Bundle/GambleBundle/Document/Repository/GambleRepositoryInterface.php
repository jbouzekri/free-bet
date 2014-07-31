<?php

namespace FreeBet\Bundle\GambleBundle\Document\Repository;

use FreeBet\Bundle\CompetitionBundle\Document\Event;
use FreeBet\Bundle\UserBundle\Document\User;

/**
 *
 * @author jobou
 */
interface GambleRepositoryInterface
{
    /**
     * Find all gambles having at least one bet on a specific event
     *
     * @param \FreeBet\Bundle\CompetitionBundle\Document\Event $event
     *
     * @return array
     */
    public function findAllGambleHavingBetsOnEvent(Event $event);

    /**
     * Count all gambles having at least one bet of a specific type on a specific event for a user
     *
     * @param \FreeBet\Bundle\UserBundle\Document\User $user
     * @param \FreeBet\Bundle\CompetitionBundle\Document\Event $event
     * @param string $betType
     *
     * @return array
     */
    public function countAllGambleHavingBetsOnEventWithType(User $user, Event $event, $betType);

    /**
     * Find all gambles not fully processed having at least one bet with a known result
     *
     * @return array
     */
    public function findAllGambleWithProcessedBets();

    /**
     * Get all gamble of a specific user
     *
     * @param \FreeBet\Bundle\UserBundle\Document\User $user
     * @param bool $onlyWinner
     *
     * @return \Doctrine\ODM\MongoDB\Query\Builder
     */
    public function getAllGambleForUserQb(User $user, $onlyWinner = null);

    /**
     * Get stats of gamble
     *
     * @param \FreeBet\Bundle\UserBundle\Document\User $user
     *
     * @return array(
     *   "unprocessed" => 0,
     *   "winner" => 0,
     *   "loser" => 0
     * )
     */
    public function getGambleProcessedStats(User $user);
}
