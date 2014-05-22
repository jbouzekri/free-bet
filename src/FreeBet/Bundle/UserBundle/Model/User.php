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
    /**
     * @var array
     */
    protected $widgets = array();

    /**
     * @var Organization $organization
     */
    protected $organization;

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
}
