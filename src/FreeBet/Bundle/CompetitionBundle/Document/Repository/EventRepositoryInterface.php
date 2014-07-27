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
     * Find all past events which has ended (the end score is known and
     * have not been processed yet)
     *
     * @param \DateTime $date
     *
     * @return array
     */
    public function findAllPastNotProcessedEvent(\DateTime $date);

    /**
     * Find all events on a competition ordered by date
     *
     * @param \FreeBet\Bundle\CompetitionBundle\Document\Competition $competition
     *
     * @return array
     */
    public function findAllOrderedEvent(Competition $competition);

    /**
     * Return the next events of a competition
     * Ordered by date and not yet processed
     *
     * @param \DateTime $date
     * @param int $limit
     *
     * @return array
     */
    public function findNextEvents(\DateTime $date, $limit);

    /**
     * Get all team names for choices field
     *
     * @param \FreeBet\Bundle\CompetitionBundle\Document\Competition $competition
     *
     * @return array
     */
    public function getEventTeamNameChoices(Competition $competition);
}
