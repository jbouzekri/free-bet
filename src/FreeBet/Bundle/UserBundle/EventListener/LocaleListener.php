<?php

namespace FreeBet\Bundle\UserBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Routing\RequestContextAwareInterface;
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
     * @var \Symfony\Component\Routing\RequestContextAwareInterface
     */
    private $router;

    /**
     *
     * @param \FreeBet\Bundle\UserBundle\Services\LoggedInUser $securityContext
     */
    public function __construct(LoggedInUser $securityContext, RequestContextAwareInterface $router)
    {
        $this->securityContext = $securityContext;
        $this->router = $router;
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
            $this->router->getContext()->setParameter('_locale', $user->getLanguage());
        }
    }
}
