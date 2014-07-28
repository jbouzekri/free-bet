<?php

namespace FreeBet\Bundle\CompetitionBundle\Document\Repository;

/**
 *
 * @author jobou
 */
interface CompetitionRepositoryInterface
{
    /**
     * Return all competition ordered by name
     *
     * @return array
     */
    public function findCurrentOrderedByName();

    /**
     * Return all ended competition ordered by data
     *
     * @return array
     */
    public function findEndedOrderedByEndDate();
}
