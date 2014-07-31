<?php

namespace FreeBet\Bundle\UserBundle\Document;

use FreeBet\Bundle\UserBundle\Model\User as BaseUser;

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
     * @var date $created
     */
    protected $created;

    /**
     * @var date $updated
     */
    protected $updated;

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
     * @return \MongoId $id
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

    /**
     * Set created
     *
     * @param date $created
     * @return self
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * Get created
     *
     * @return date $created
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param date $updated
     * @return self
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

    /**
     * Get updated
     *
     * @return date $updated
     */
    public function getUpdated()
    {
        return $this->updated;
    }
}
