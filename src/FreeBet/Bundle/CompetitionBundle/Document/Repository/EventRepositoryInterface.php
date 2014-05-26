<?php

namespace FreeBet\Bundle\CompetitionBundle\Document\Repository;

use FreeBet\Bundle\CompetitionBundle\Document\Competition;

/**
 * Description of EventRepositoryInterface
 *
 * @author jobou
 */
interface EventRepositoryInterface
{
    /**
     * Find all events which has ended (the end score is known and
     * have not been processed yet)
     *
     * @return array
     */
    public function findAllEndedAndNotProcessedEvent();

    /**
     * Return the next events of a competition
     * Ordered by date and not yet processed
     *
     * @param int $limit
     *
     * @return array
     */
    public function findNextEvents($limit);

    /**
     * Get all team names for choices field
     * 
     * @param \FreeBet\Bundle\CompetitionBundle\Document\Competition $competition
     *
     * @return array
     */
    public function getEventTeamNameChoices(Competition $competition);
}
