<?php

namespace BettingSas\Bundle\UserBundle\Document\Repository;

use BettingSas\Bundle\UserBundle\Model\Organization;

/**
 *
 * @author jobou
 */
interface UserRepositoryInterface
{
    /**
     * Find all sorted By name being in a specific organization
     *
     * @param \BettingSas\Bundle\UserBundle\Model\Organization $organization
     *
     * @return \Doctrine\ODM\MongoDB\Query\Builder
     */
    public function findAllInOrganizationQb(Organization $organization);
}
