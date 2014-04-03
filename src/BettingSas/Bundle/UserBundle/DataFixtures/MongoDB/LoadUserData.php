<?php

namespace BettingSas\Bundle\UserBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use BettingSas\Bundle\UserBundle\Document\User;

/**
 * Description of LoadCompetitionData
 *
 * @author jobou
 */
class LoadUserData extends AbstractFixture implements
    FixtureInterface,
    OrderedFixtureInterface,
    ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

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
    public function load(ObjectManager $manager)
    {
        $users = array(
            array(
                'username' => 'jobou',
                'email' => 'jobou@smile.fr',
                'password' => 'azerty',
                'profil' => 'ROLE_ADMIN',
                'organization' => 'bu-helios'
            ),
            array(
                'username' => 'jobou2',
                'email' => 'jobou2@smile.fr',
                'password' => 'azerty'
            ),
            array(
                'username' => 'manager',
                'email' => 'manager@smile.fr',
                'password' => 'azerty',
                'profil' => 'ROLE_MANAGER',
                'organization' => 'bu-helios'
            ),
        );

        foreach ($users as $user) {
            $entity = new User();
            $entity->setUsername($user['username']);
            $entity->setEmail($user['email']);
            $entity->setEnabled(true);

            if (isset($user['profil'])) {
                $entity->setRoles(array($user['profil']));
            }

            if (isset($user['organization'])) {
                $entity->setOrganization($this->getReference('organization-'.$user['organization']));
            }

            $encoder = $this->container
                ->get('security.encoder_factory')
                ->getEncoder($entity)
            ;
            $entity->setPassword($encoder->encodePassword($user['password'], $entity->getSalt()));

            $manager->persist($entity);

            $this->addReference('user-'.$entity->getUsername(), $entity);
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 20;
    }
}
