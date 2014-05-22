<?php

namespace FreeBet\Bundle\CompetitionBundle\Document\Repository;

/**
 *
 * @author jobou
 */
interface CompetitionRepositoryInterface
{
    /**
     * Return all competition ordered by date
     *
     * @return array
     */
    public function findAllOrderedByDate();
}
