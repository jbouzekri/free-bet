<?php

namespace FreeBet\Bundle\UserBundle\Model;

use FOS\UserBundle\Document\User as BaseUser;

/**
 * Description of BaseUser
 *
 * @author jobou
 */
abstract class User extends BaseUser
{
    const ROLE_ADMIN = 'ROLE_ADMIN';

    /**
     * @var array
     */
    protected $widgets = array();

    /**
     * @var Organization $organization
     */
    protected $organization;

    /**
     * @var string
     */
    protected $language;

    /**
     * Set Organization
     *
     * @param \FreeBet\Bundle\UserBundle\Model\Organization $organization
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
     * @return \FreeBet\Bundle\UserBundle\Model\Organization $organization
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * Set Language
     *
     * @param string $language
     * @return self
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * Get Language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Get widgets
     *
     * @return array
     */
    public function getWidgets()
    {
        return $this->widgets;
    }

    /**
     * Set widgets
     *
     * @param array $widgets
     *
     * @return \FreeBet\Bundle\UserBundle\Model\User
     */
    public function setWidgets($widgets)
    {
        $this->widgets = $widgets;

        return $this;
    }

    /**
     * Add a widget
     *
     * @param mixed $widget
     *
     * @return \FreeBet\Bundle\UserBundle\Model\User
     */
    public function addWidget($widget)
    {
        $this->widgets[] = $widget;

        return $this;
    }

    /**
     * Check if a user is the manager of its organization
     *
     * @return true
     */
    public function isManager()
    {
        return $this->hasRole('ROLE_MANAGER') && $this->getOrganization();
    }

    /**
     * Check if a user has the same organization than another one
     *
     * @param \FreeBet\Bundle\UserBundle\Model\User $user
     *
     * @return bool
     */
    public function hasSameOrganization(User $user)
    {
        return $this->getOrganization()
            && $user->getOrganization()
            && $this->getOrganization()->getId() === $user->getOrganization()->getId();
    }

    /**
     * Check if the user is an admin
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->hasRole(static::ROLE_SUPER_ADMIN) || $this->hasRole(static::ROLE_ADMIN);
    }
}
