<?php

namespace BettingSas\Bundle\UserBundle\Document;

use Symfony\Component\Security\Core\User\UserInterface;
use BettingSas\Bundle\UserBundle\Component\AbstractUser;

/**
 * Description of User
 *
 * @author jobou
 */
class User extends AbstractUser implements UserInterface
{
    /**
     * @var MongoId $id
     */
    protected $id;

    /**
     * @var string $email
     */
    protected $email;

    /**
     * @var boolean $active
     */
    protected $active;

    /**
     * @var string $password
     */
    protected $password;

    /**
     * @var string $salt
     */
    protected $salt;

    /**
     * @var string $profil
     */
    protected $profil;

    /**
     * @var string $slug
     */
    protected $slug;

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
     * Set email
     *
     * @param string $email
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return self
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * Get active
     *
     * @return boolean $active
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get password
     *
     * @return string $password
     */
    public function getPassword()
    {
        return $this->password;
    }

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
     * Set salt
     *
     * @param string $salt
     * @return self
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
        return $this;
    }

    /**
     * Get salt
     *
     * @return string $salt
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * {@inheritDoc}
     */
    public function eraseCredentials()
    {
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function getRoles()
    {
        return array($this->getProfil());
    }

    /**
     * {@inheritDoc}
     */
    public function getUsername()
    {
        return $this->getEmail();
    }
}
