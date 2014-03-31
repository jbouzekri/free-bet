<?php

namespace BettingSas\Bundle\UserBundle\Document\Repository;

/**
 *
 * @author jobou
 */
interface OrganizationRepositoryInterface
{
    /**
     * Find all sorted By name
     * You can filter by slug
     *
     * @param string $slug
     *
     * @return \Doctrine\ODM\MongoDB\Query\Builder
     */
    public function findAllFilteredQb($slug = null);
}
