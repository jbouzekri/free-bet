<?php

namespace FreeBet\Bundle\UserBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use FreeBet\Bundle\UserBundle\Services\LoggedInUser;

/**
 * Description of LocaleListener
 *
 * @author jobou
 */
class LocaleListener
{
    /**
     * @var \FreeBet\Bundle\UserBundle\Services\LoggedInUser
     */
    private $securityContext;

    /**
     *
     * @param \FreeBet\Bundle\UserBundle\Services\LoggedInUser $securityContext
     */
    public function __construct(LoggedInUser $securityContext)
    {
        $this->securityContext = $securityContext;
    }

    /**
     * On kernel.request event listener
     * Set locale according to logged in user
     *
     * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
     * @return void
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            // don't do anything if it's not the master request
            return;
        }

        $user = $this->securityContext->getUser();
        if (!is_object($user)) {
            return;
        }

        if ($user->getLanguage() !== null) {
            $event->getRequest()->setLocale($user->getLanguage());
        }
    }
}