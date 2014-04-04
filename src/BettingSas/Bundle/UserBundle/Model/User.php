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
     * @return \BettingSas\Bundle\UserBundle\Model\User
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
     * @return \BettingSas\Bundle\UserBundle\Model\User
     */
    public function addWidget($widget)
    {
        $this->widgets[] = $widget;

        return $this;
    }
}
