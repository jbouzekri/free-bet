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
     * @var string $profil
     */
    protected $profil;

    /**
     * @var Organization $organization
     */
    protected $organization;

    /**
     * Set profil
     *
     * @param string $profil
     * @return self
     */
    public function setProfil($profil)
    {
        $this->profil = $profil;
        return $this;
    }

    /**
     * Get profil
     *
     * @return string $profil
     */
    public function getProfil()
    {
        return $this->profil;
    }

    /**
     * Set Organization
     *
     * @param Organization $organization
     * @return self
     */
    public function setOrganization(Organization $organization)
    {
        $this->organization = $organization;
        return $this;
    }

    /**
     * Get Organization
     *
     * @return Organization $organization
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * Get the roles
     *
     * @return array
     */
    public function getRoles()
    {
        return array_unique(array(static::ROLE_DEFAULT, $this->getProfil()));
    }
}
