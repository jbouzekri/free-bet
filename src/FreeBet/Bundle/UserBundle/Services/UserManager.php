<?php

namespace FreeBet\Bundle\UserBundle\Services;

use FOS\UserBundle\Doctrine\UserManager as BaseUserManager;
use Doctrine\Common\Persistence\ObjectManager;
use FOS\UserBundle\Util\CanonicalizerInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Description of UserManager
 *
 * @author jobou
 */
class UserManager extends BaseUserManager
{
    /**
     * @var \Symfony\Component\HttpFoundation\RequestStack
     */
    protected $request;

    /**
     * Constructor.
     *
     * @param \Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface $encoderFactory
     * @param \FOS\UserBundle\Util\CanonicalizerInterface  $usernameCanonicalizer
     * @param \FOS\UserBundle\Util\CanonicalizerInterface  $emailCanonicalizer
     * @param \Doctrine\Common\Persistence\ObjectManager  $om
     * @param string $class
     * @param \Symfony\Component\HttpFoundation\RequestStack $request
     */
    public function __construct(
        EncoderFactoryInterface $encoderFactory,
        CanonicalizerInterface $usernameCanonicalizer,
        CanonicalizerInterface $emailCanonicalizer,
        ObjectManager $om,
        $class,
        RequestStack $request
    ) {
        parent::__construct($encoderFactory, $usernameCanonicalizer, $emailCanonicalizer, $om, $class);

        $this->request = $request;
    }

    /**
     * Returns an empty user instance
     *
     * @return UserInterface
     */
    public function createUser()
    {
        $class = $this->getClass();
        $user = new $class;

        // Set current locale when registering
        $user->setLanguage($this->request->getMasterRequest()->getLocale());

        return $user;
    }
}
