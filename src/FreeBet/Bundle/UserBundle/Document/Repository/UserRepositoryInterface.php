<?php

namespace FreeBet\Bundle\UserBundle\Document\Repository;

use FreeBet\Bundle\UserBundle\Model\Organization;

/**
 *
 * @author jobou
 */
interface UserRepositoryInterface
{
    /**
     * Find all sorted By name being in a specific organization
     *
     * @param \FreeBet\Bundle\UserBundle\Model\Organization $organization
     *
     * @return \Doctrine\ODM\MongoDB\Query\Builder
     */
    public function findAllInOrganizationQb(Organization $organization);
}
