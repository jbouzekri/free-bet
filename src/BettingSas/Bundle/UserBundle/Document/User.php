<?php

namespace BettingSas\Bundle\UserBundle\Document;

use BettingSas\Bundle\UserBundle\Model\User as BaseUser;

/**
 * Description of User
 *
 * @author jobou
 */
class User extends BaseUser
{
    /**
     * @var \MongoId $id
     */
    protected $id;

    /**
     * @var string $slug
     */
    protected $slug;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return self
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Get slug
     *
     * @return string $slug
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
