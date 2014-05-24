<?php

namespace FreeBet\Bundle\UserBundle\DataFixtures\Additionnal;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use FreeBet\Bundle\UserBundle\DataFixtures\MongoDB\LoadUserData as BaseLoadUserData;

/**
 * Description of LoadCompetitionData
 *
 * @author jobou
 */
class LoadUserData extends BaseLoadUserData implements
    OrderedFixtureInterface,
    ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 110;
    }

    /**
     * {@inheritDoc}
     */
    public function getData()
    {
        return array(
            array(
                'username' => 'jobou2',
                'email' => 'jobou2@smile.fr',
                'password' => 'azerty',
                'reference' => 'user-jobou2'
            ),
            array(
                'username' => 'manager',
                'email' => 'manager@smile.fr',
                'password' => 'azerty',
                'profil' => 'ROLE_MANAGER',
                'organization' => 'bu-helios',
                'reference' => 'user-manager'
            ),
        );
    }
}
