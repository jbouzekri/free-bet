<?php

namespace BettingSas\Bundle\UserBundle\Model;

abstract class Organization
{
    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $slug;

    /**
     * get id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return \BettingSas\Bundle\UserBundle\Model\Organization
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return \BettingSas\Bundle\UserBundle\Model\Organization
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }
}
