<?php

namespace BettingSas\Bundle\UserBundle\Component;

/**
 * Description of BaseUser
 *
 * @author jobou
 */
abstract class AbstractUser
{
    /**
     * @var string
     */
    protected $pseudo;

    /**
     * @var string
     */
    protected $group;

    /**
     * Set pseudo
     *
     * @param string $pseudo
     * @return self
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string $pseudo
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set group
     *
     * @param string $group
     * @return self
     */
    public function setGroup($group)
    {
        $this->group = $group;
        return $this;
    }

    /**
     * Get group
     *
     * @return string $group
     */
    public function getGroup()
    {
        return $this->group;
    }
}
