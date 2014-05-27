<?php

namespace FreeBet\Bundle\UserBundle\Services;

use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * Description of LoggedInUser
 *
 * @author jobou
 */
class LoggedInUser
{
    /**
     * @var \Symfony\Component\Security\Core\SecurityContextInterface
     */
    private $securityContext;

    /**
     *
     * @param \Symfony\Component\Security\Core\SecurityContextInterface $securityContext
     */
    public function __construct(SecurityContextInterface $securityContext)
    {
        $this->securityContext = $securityContext;
    }

    /**
     * Get the user from the context
     *
     * @return \FreeBet\Bundle\UserBundle\Model
     */
    public function getUser()
    {
        if (null === $token = $this->securityContext->getToken()) {
            return;
        }

        if (!is_object($user = $token->getUser())) {
            return;
        }

        return $user;
    }
}
