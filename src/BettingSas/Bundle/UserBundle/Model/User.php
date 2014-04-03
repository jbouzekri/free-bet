<?php

namespace BettingSas\Bundle\UserBundle\Model;

use FOS\UserBundle\Document\User as BaseUser;

/**
 * Description of BaseUser
 *
 * @author jobou
 */
abstract class User extends BaseUser
{
    /**
     * @var Organization $organization
     */
    protected $organization;

    /**
     * Set Organization
     *
     * @param \BettingSas\Bundle\UserBundle\Model\Organization $organization
     * @return self
     */
    public function setOrganization(Organization $organization = null)
    {
        $this->organization = $organization;
        return $this;
    }

    /**
     * Get Organization
     *
     * @return \BettingSas\Bundle\UserBundle\Model\Organization $organization
     */
    public function getOrganization()
    {
        return $this->organization;
    }
}
